<?php

class Bootstrap {

    public static function run(Request $peticion) {
        
        $controller = $peticion->getControlador() . 'Controller';
        $rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
        $metodo = $peticion->getMetodo();        
        $argumentos = $peticion->getArgumentos();        

        if (is_readable($rutaControlador)) 
        {            
            require_once $rutaControlador;

            $controller = new $controller;

            if (Session::get('acl')) 
            {
                $permKey = $peticion->getControlador() . '_' . $metodo;
                $acl = unserialize(Session::get('acl'));                

                if (!$acl->hasPermission($permKey))
                {
                    header ("location:".BASE_URL."denegado");                    
                    //throw new Exception('No permiso');
                    exit();
                }
            }

            if($_POST)
            {                                
                $controller->data = $peticion->getData($_REQUEST);
            }

            if (is_callable(array($controller, $metodo))) 
            {
                $metodo = $peticion->getMetodo();
            } 
            else 
            {
                $metodo = 'index';
            }

            if (!empty($argumentos)) 
            {

                call_user_func_array(array($controller, $metodo), $argumentos);
            } 
            else 
            {
                call_user_func(array($controller, $metodo));
            }
        } 
        else 
        {
            throw new Exception('Controlador no encontrado');
        }
    }
    
    protected function limpiar_datos($datos)
    {
        if(is_array($datos))
        {
            foreach ($datos as $key => $value) 
            {
                $respuesta[$key] = addslashes($value);
            }
        }
        else 
        {
            $respuesta = addslashes($datos);
        }       
        
        return $respuesta;
    }

}

?>
