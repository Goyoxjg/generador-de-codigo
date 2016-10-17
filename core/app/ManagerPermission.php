<?php

class ManagerPermission {

    private $_enumcontrollers;
    private $_enumactions;

    public function enumControllers() {
        if ($this->_enumcontrollers == null) 
        {
            $this->_enumcontrollers = array();

            $p = ROOT . 'controllers';
            foreach (scandir($p) as $f) 
            {
                if ($f == '.' || $f == '..') 
                {
                    continue;
                }
                
                if (strlen($f)) 
                {
                    if ($f[0] == '.') 
                    {
                        continue;
                    }
                }
                
                if ($pos = strpos(strtolower($f), "controller.php")) 
                {
                    $this->_enumcontrollers[] = substr($f, 0, $pos);
                }
            }
            return $this->_enumcontrollers;
        } 
        else 
        {
            return $this->_enumcontrollers;
        }
    }

    /**
     * enumActions
     *    devuelve un array con los nombres de los actions del controller
     * @param mixed $controllerName nombre del controller
     * @access public
     * @return array lista de actions.
     */
    public function enumActions($controllerName) {
        $this->_enumactions = array();
        $className = $controllerName . 'Controller';

        //  die($className);
        $rutaControlador = ROOT . 'controllers/' . $className . '.php';

        if (is_readable($rutaControlador)) 
        {

            require_once $rutaControlador;

            $refx = new ReflectionClass($className);
            foreach ($refx->getMethods() as $method) 
            {
                if ($method->name != '__construct') 
                {                    
                    if (substr($method->name, 0, 6) == "action") 
                    {
                        $this->_enumactions[] = substr($method->name, 6);
                    }
                }
            }
            return $this->_enumactions;
        }
    }

    /**
     * autoDetect
     *    lee todos los controllers y actions y los almacena si previamente
     *    no estaban registrados.
     * @access public
     * @return void
     */
    public function autoDetect() {
        $db = new Database();        
        // agrega cada actiond e cada controller detectado en codigo fuente
        foreach ($this->enumControllers() as $c) {

            // cada action
            foreach ($this->enumActions($c) as $action) 
            {
                $patrón = '/[A-Z]/';
                preg_match($patrón, $c, $coincidencias, PREG_OFFSET_CAPTURE);                                
                $c = str_replace($coincidencias[0], " ".lcfirst($coincidencias[0][0])."" , $c);                                                
                $itemName = strtolower($c) . "_" . strtolower($action);
               
                if (!$this->getAuthItem($itemName)) 
                {
                    $strQuery = "INSERT INTO permisos (fk_per, nom_per) VALUES (?,?);";                    
                    //$db = new Database();
                    $st = $db->prepare($strQuery);

                    try 
                    {
                        $db->beginTransaction();

                        $st->execute(array($itemName, $action));
              
                        $db->commit();
                        //print $db->lastInsertId();
                    } 
                    catch (PDOExecption $e) 
                    {
                        $db->rollback();
                        print "Error!: " . $e->getMessage() . "</br>";
                    }
                }
            }            
        }
    }

    public function getAuthItem($name) {

        $strQuery = "SELECT * FROM permisos where fk_per='$name';";

        $bd = new Database();
        $resultado = $bd->query($strQuery);


        if ($resultado->rowCount() > 0) 
        {
            return true;
        } 
        else 
        {
            return null;
        }
    }
}

$pers = new ManagerPermission();

$pers->autoDetect();
?>