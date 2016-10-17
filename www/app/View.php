<?php
class View
{
    private $_controlador;
    private $_validaciones;
 
    public function __construct(Request $peticion)
    {
        $this->_controlador = $peticion->getControlador();
        $this->_validaciones = $peticion->getValidador();
        $this->_metodo = $peticion->getMetodo();        
    }
 
    public function render($vista)
    {   
        $this->_recursos = $this->obtenerRecursos($this->_controlador);

        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js'  => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',            
            'ruta_lib' => BASE_URL . 'libs/'
        );

        if(file_exists(ROOT . 'public/js/'.$this->_controlador.'.js'))
        {
            $_layoutParams['ruta_js_controller'] = BASE_URL . 'public/js/'.$this->_controlador.'.js';
        }
                        
        //$this->_view->script = $this->cargar_validaciones($this->_validaciones);        
        if($this->_validaciones)
        {
            $this->_view->script = $this->cargar_validaciones($this->_validaciones);        
        }
        
        if(Session::get("id_usu") || $this->_controlador == "contrasena")
        {
            // Obtenemos la ruta de la vista a cargar        
            $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';        
        }
        else
        {
            $rutaView = ROOT . 'views/index/index.phtml';        
        }
        
        // Comprobamos que exista, en caso contrario creamos una Exception                
        //print "$rutaView<br>";  
        if(is_readable($rutaView))
        { 
            if(substr($this->_metodo, 0, 4) != "ajax")
            {
                require_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';            
                require_once $rutaView;            
                require_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
            }
            else 
            {
                require_once $rutaView;    
            }
        } 
        else 
        {
            throw new Exception('Error al cargar la vista.');
        }
    }
    
    public function cargar_validaciones($campos)
    {
        if($campos)
        {
            $script .= '<script>
            var elementos = '.  json_encode($campos) . ';
            $(document).ready(function(){        
                validarFormularios(elementos);                
            })
            </script>';
        }
        else
        {
            $script .= '<script></script>';
        }
        
        return $script;
    }
    
    private function obtenerRecursos($controlador)
    {
        $librerias = unserialize(LIBRERIAS);
        $modulos = unserialize(MODULOS_LIBRERIAS);
        $recursos = "";
        foreach ($modulos[$controlador] as $value) 
        {
            $recursos.= $librerias[$value];
        }
        return $recursos;        
    }
}
?>
