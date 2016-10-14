<?php

class rolesController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
        

    public function index()
    {                
        $roles = Role::listarRoles();
        $this->_view->roles = (Array)$roles;
        $this->_view->render('lista');  
    }   
          
    public function actionEditar($id_rol , $id_per = FALSE , $accion = FALSE)        
    {        
        if($id_per && $accion)
        {
            switch (ucwords($accion)) 
            {
                case "A":
                    //$this->mensaje(PermisosRole::agregarRolPermiso($id_rol , $id_per), "H", "permisos");                    
                    PermisosRole::agregarRolPermiso($id_rol , $id_per);                    
                break;

                case "D":
                    //$this->mensaje(PermisosRole::eliminarRolPermiso($id_rol , $id_per), "D", "permisos");                                        
                    PermisosRole::eliminarRolPermiso($id_rol , $id_per);                                        
                break;
            }
        }
        
        $this->_view->permisosRoles = Role::consultarPermisosRoles($id_rol);        
                
        $this->_view->render('editar');
    }
    
    public function actionConsultar($id_rol)        
    {        
        $this->_view->permisosRoles = Role::consultarPermisosRoles($id_rol);        
        $this->_view->render('consultar');
    }
    
    public function actionEliminar($id_rol)        
    {      
        $respuesta = Role::eliminarRol($id_rol);
        if($respuesta > 0)
        {
            $this->setear_mensaje("Se elimino el rol satisfactoriamente.", "alert-success");            
        }
        else if ($respuesta == -1)
        {            
            $this->setear_mensaje("Existen usuarios asosciados al perfil.", "alert-danger");            
        }
        else
        {            
            $this->setear_mensaje("Error al eliminar el rol.", "alert-danger");            
        }
                
        $this->index();
    }
    
    public function actionAgregar()        
    {        
        if(isset($this->data) && !empty($this->data))
        {            
            if(count($this->data["id_per"]) == 0)
            {
                $this->setear_mensaje("Debe seleccionar al menos un permiso.", "alert-warning");            
            }
            else 
            {
                $id_rol = Role::agregarRol($this->data);        
                if($id_rol > 0 )
                {
                    foreach ($this->data["id_per"] as $value) 
                    {
                        $result = PermisosRole::agregarRolPermiso($id_rol , $value);
                    }                

                    $this->setear_mensaje("Se agrego el rol satisfactoriamente.", "alert-success");            
                }
                else if ($id_rol == -1)
                {            
                    $this->setear_mensaje("El pérfil ya existe.", "alert-danger");            
                }   
                else
                {            
                    $this->setear_mensaje("Error al agregar el rol.", "alert-danger");            
                }   
            }
        }
        
        $this->_view->permisosRoles = Permiso::listarPermisos();                
        $select_permisos = Permiso::selectPermisos();        
        $this->_view->select_permisos = $select_permisos;
        
        $this->_view->render('agregar');
        
    }
}

