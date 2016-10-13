<?php
 
class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    private $_validaciones;    
    private $_data;    

    public function __construct()
    {   
        if(isset($_GET['url']))
        {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);                        
            $url = explode('/', $url);            
            $url = array_filter($url);
            
            $this->_controlador = strtolower(array_shift($url));            
            $this->_metodo = strtolower(array_shift($url));            
            $this->_argumentos = $url;            
        }
        
        if(!$this->_controlador)
        {
            $this->_controlador = DEFAULT_CONTROLLER;            
        }
 
        if(!$this->_metodo)
        {
            $this->_metodo = 'index';
        }
 
        if(!isset($this->_argumentos))
        {
            $this->_argumentos = array();
        }    
    }
 
    public function getControlador()
    {
        if(!Session::get('acl'))
        {
            $this->_controlador = DEFAULT_CONTROLLER;            
        }

        return $this->_controlador;
    }
 
    public function getMetodo()
    {        
        if(!Session::get('acl'))
        {
            $this->_metodo = 'index';
        }
        return $this->_metodo;
    }
 
    public function getArgumentos()
    {
        if(!Session::get('acl'))
        {
            $this->_argumentos = array();
        }    
        return $this->_argumentos;
    }
    
    public function limpiarData($datos)
    {
        if(is_array($v3))
        {
            $tmp = array_map('addslashes', $datos);
            $val = array_map('trim', $tmp);
        }
        else
        {
            $val = trim(addslashes($datos));
        }
        return $val;
    }
    
    public function getData($datos)
    {        
        if(is_array($datos))
        {
            foreach ($datos as $k1 => $v1) 
            {                
                if(is_array($v1))
                {                    
                    foreach ($v1 as $k2 => $v2) 
                    {      
                        if(is_array($v2))
                        {
                            foreach ($v2 as $k3 => $v3) 
                            {
                                if(is_array($v3))
                                {                                    
                                    foreach ($v3 as $k4 => $v4) 
                                    {
                                        if(is_array($v4))
                                        {
                                            foreach ($v4 as $k5 => $v5) 
                                            {                                                
                                                $r1[$k1][$k2][$k3][$k4][$k5] = array_map('limpiarData', $v5);                                        
                                            }
                                        }
                                        else
                                        {
                                            $r1[$k1][$k2][$k3][$k4] = $this->limpiarData($v4);
                                        }
                                    }
                                }
                                else
                                {
                                    $r1[$k1][$k2][$k3] = $this->limpiarData($v3);
                                }
                            }
                        }
                        else
                        {
                            $r1[$k1][$k2] = $this->limpiarData($v2);
                        }                        
                    }
                }
                else
                {                 
                    if($v1 != NULL)
                    {
                        $r1[$k1] = $this->limpiarData($v1);                    
                    }
                }                
            }
            $respuesta = $r1;
        }               
        return $respuesta;
    }
    
    public function getValidador()
    {        
        $explorador = new Explorador($this->_controlador, $this->_metodo);
        if($this->_validaciones = $explorador->_validaciones)
        {
            return $this->_validaciones;
        }
        else
        {
            return false;
        }
        
    }
}
?>