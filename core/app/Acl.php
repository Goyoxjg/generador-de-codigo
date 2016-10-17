<?php

class acl {

    var $perms = array();  //Array : Stores the permissions for the user    
    var $userID;   //Integer : Stores the ID of the current user
    var $userRoles = array(); //Array : Stores the roles of the current user
    var $bd;
    public $h;

    function __construct($userid) {                
        $this->h = rand(time(), 6);
        var_dump($this);
        die();
        $this->bd = new Database();
        $this->userID = floatval($userid);
        $this->userRoles = $this->getUserRoles();                
        $this->buildACL();
    }
    
    public function __sleep() {
        $this->bd=NULL;
        return array('perms', 'userID', 'userRoles', 'ci', 'h');
    }

    public function __wakeup() {}
    
    function buildACL() {
        //first, get the rules for the user's role        
        if (count($this->userRoles) > 0) 
        {            
            $this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
        }                
        //then, get the individual user permissions
        $this->perms = array_merge($this->perms, $this->getUserPerms($this->userID));
    }

    function getPermKeyFromID($permID) {
        $strSQL = "SELECT fk_per FROM " . DB_PREFIX . "permisos WHERE id_per = " . floatval($permID) . " AND nom_per <> 'index' LIMIT 1";
        /* $this->bd->db->select('permKey');
          $this->bd->db->where('id', floatval($permID));
          $sql = $this->bd->db->get('perm_data', 1);
          $data = $sql->result(); */        
        $data = $this->bd->query($strSQL)->fetchObject();               
        return $data->fk_per;
    }

    function getPermNameFromID($permID) {
        $strSQL = "SELECT nom_per FROM " . DB_PREFIX . "permisos WHERE id_per = " . floatval($permID) . " LIMIT 1";
        /* $this->bd->db->select('permName');
          $this->bd->db->where('id', floatval($permID));
          $sql = $this->bd->db->get('perm_data', 1);
          $data = $sql->result(); */

        $data = $this->bd->query($strSQL)->fetchObject();
        return $data->nom_per;
    }

    function getRoleNameFromID($roleID) {
        //$strSQL = "SELECT roleName FROM ".DB_PREFIX."roles WHERE ID = " . floatval($roleID) . " LIMIT 1";
        $this->bd->db->select('nom_rol');
        $this->bd->db->where('id_rol', floatval($roleID), 1);
        $sql = $this->bd->db->get('role_data');
        $data = $sql->result();
        return $data[0]->nom_rol;
    }

    function getUserRoles() {
        $strSQL = "SELECT * FROM " . DB_PREFIX . "roles_usuarios WHERE usuario_id = " . floatval($this->userID) . " ORDER BY fec_usu_rol ASC";
        $data = $this->bd->query($strSQL)->fetchAll();
        /* $this->bd->db->where(array('userID'=>floatval($this->userID)));
          $this->bd->db->order_by('addDate','asc');
          $sql = $this->bd->db->get('user_roles');
          $data = $sql->result();
         */
        $resp = array();
        foreach ($data as $row) 
        {            
            $row = (object) $row;            
            $resp[] = $row->role_id;
        }
        
        return $resp;
    }

    function getAllRoles($format = 'ids') {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM ".DB_PREFIX."roles ORDER BY roleName ASC";
        $this->bd->db->order_by('nom_rol', 'asc');
        $sql = $this->bd->db->get('roles');
        $data = $sql->result();

        $resp = array();
        foreach ($data as $row) 
        {
            if ($format == 'full') 
            {
                $resp[] = array("id" => $row->id_rol, "name" => $row->nom_rol);
            } 
            else 
            {
                $resp[] = $row->id_rol;
            }
        }
        return $resp;
    }

    function getAllPerms($format = 'ids') {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM ".DB_PREFIX."permissions ORDER BY permKey ASC";

        $this->bd->db->order_by('fk_per', 'asc');
        $sql = $this->bd->db->get('permisos');
        $data = $sql->result();

        $resp = array();
        foreach ($data as $row) 
        {
            if ($format == 'full') 
            {
                $resp[$row->fk_per] = array('id' => $row->id_per, 'name' => $row->nom_per, 'key' => $row->fk_per);
            } 
            else 
            {
                $resp[] = $row->id_per;
            }
        }
        return $resp;
    }

    function getRolePerms($role) {
        if (is_array($role)) 
        {
            $roleSQL = "SELECT * FROM " . DB_PREFIX . "permisos_roles WHERE id_rol IN (" . implode(",", $role) . ") ORDER BY id_rol ASC";
        } 
        else 
        {
            $roleSQL = "SELECT * FROM " . DB_PREFIX . "permisos_roles WHERE id_rol = " . floatval($role) . " ORDER BY id_rol ASC";
        }
        
        /* $this->bd->db->order_by('id', 'asc');
          $sql = $this->bd->db->get('role_perms'); //$this->db->select($roleSQL); */

        $data = $sql = $this->bd->query($roleSQL)->fetchAll();
        $perms = array();
        foreach ($data as $row) 
        {
            $row = (object) $row;
            $pK = strtolower($this->getPermKeyFromID($row->id_per));
            if ($pK == '') 
            {
                continue;
            }
            
            if ($row->val_per_rol === '1') 
            {
                $hP = true;
            } 
            else 
            {
                $hP = false;
            }
            
                $perms[$pK] = array('perm' => $pK, 'inheritted' => true, 'value' => $hP, 'name' => $this->getPermNameFromID($row->id_per), 'id' => $row->id_per);
        }
        return $perms;
    }

    function getUserPerms($userID) {
        $strSQL = "SELECT * FROM " . DB_PREFIX . "permisos_usuarios WHERE id_usu = " . floatval($userID) . " ORDER BY fec_per_usu ASC";

        /*   $this->bd->db->where('userID', floatval($userID));
          $this->bd->db->order_by('addDate', 'asc');
          $sql = $this->bd->db->get('user_perms');
          $data = $sql->result(); */

        $data = $this->bd->query($strSQL)->fetchAll();

        $perms = array();
        foreach ($data as $row) 
        {
            $row = (object) $row;
            $pK = strtolower($this->getPermKeyFromID($row->id_per));

            if ($pK == '') 
            {
                continue;
            }
            
            if ($row->val_per_usu == '1') 
            {
                $hP = true;
            } 
            else 
            {
                $hP = false;
            }
            
            $perms[$pK] = array('perm' => $pK, 'inheritted' => false, 'value' => $hP, 'name' => $this->getPermNameFromID($row->c), 'id' => $row->id_per);
        }

        return $perms;
    }

    function hasRole($roleID) {
        foreach ($this->userRoles as $k => $v) 
        {
            if (floatval($v) === floatval($roleID)) 
            {
                return true;
            }
        }
        return false;
    }

    function hasPermission($permKey) {    
        if (substr(end(explode("_", $permKey)) , 0, 6) == "action") 
        {
            $permKey = str_replace("action", "", $permKey); //substr($permKey, 6);
        }
        
        $permKey = strtolower($permKey);                
        /******************************************************
         * Se modifica para que no compare contra los nuevos index creados 
         *if (array_key_exists($permKey, $this->perms)) 
        *******************************************************/
        if (array_key_exists($permKey, $this->perms) || 
            end(explode("_", $permKey)) == 'index' ||
            substr(end(explode("_", $permKey)) , 0, 4) == "ajax")
        {        
            if ($this->perms[$permKey]['value'] === '1' || 
                $this->perms[$permKey]['value'] === true || 
                end(explode("_", $permKey)) == 'index' ||
                substr(end(explode("_", $permKey)) , 0, 4) == "ajax") 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }
    
    function hasPermissionMod($permKey) {                        
        $mods = Array();
        $permKey = strtolower($permKey);         
        foreach ($this->perms as $key => $value) 
        {
            $mod = explode("_", $key);
            if(!in_array($mod[0], $mods))
            {
                array_push($mods, $mod[0]);
            }
        }
        
        if (in_array($permKey, $mods) || $permKey == '#') 
        {        
            return true;
        } 
        else 
        {
            return false;
        }
    }

}

?>