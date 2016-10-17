<?php
abstract class Controller
{
    protected $_view;

    public function __construct()
    {
        $this->_view = new View(new Request);
        $this->loadDefaultModel();
    }
    
    //abstract public function index();
    
    protected function loadDefaultModel()
    {
        $controller_name = get_class($this);
        $controller_name = explode("Controller",$controller_name);
        $model_name = rtrim($controller_name[0] , "s");
        $model_name = lcfirst($model_name);

        $rutaModelo = ROOT . 'models' . DS . ucfirst($model_name) . '.php';
        if (is_readable($rutaModelo)) 
        {
            require_once $rutaModelo;
            $modelo = new $model_name();
            $model_name = ucfirst($model_name);
            $this->$model_name = $modelo;
        } 
        else 
        {
            //throw new Exception('Error al cargar modelo');
        }
    }

    protected function loadModel($modelo)
    {
        //$modelo = $modelo . 'Model';
		     
        $rutaModelo = ROOT . 'models' . DS . ucfirst($modelo) . '.php';
        if (is_readable($rutaModelo)) 
        {
            require_once $rutaModelo;
            $modelo = new $modelo();            
            return $modelo;
        } 
        else 
        {
            throw new Exception('Error al cargar modelo');
        }
    }
    
    protected function redireccionar($ruta = false)
    {
        if($ruta)
        {
            header('location:' . BASE_URL . $ruta);
            exit;
        }
        else
        {
            header('location:' . BASE_URL);
            exit;
        }
    }
    
    public function mensaje ($valor , $accion , $elemento , $msg = FALSE , $class = FALSE)
    {
        switch (strtoupper($accion)) 
        {
            case "A"://Agregar
                $accion = "agregó";
                break;
            case "M"://Modificar
                $accion = "modificó";
                break;
            //case "C"://Consultar
                //$accion = "consultó";
                break;
            case "E"://Eliminar
                $accion = "eliminó";
                break;
            case "H"://Habilitar
                $accion = "habilitó";
                break;
            case "D"://Deshabilitar
                $accion = "deshabilitó";
                break;
            case "U"://Cargar archivo
                $accion = "cargó";
                break;
            case "AS"://Asignó
                $accion = "asignó";
                break;
        }
        
        if(is_array($valor))
        {
            if(!$msg || !$class)
            {
                throw new Exception('Error debe setear un mensaje y un tipo de alerta.');
            }
            else 
            {
                $this->_view->msg = join("<br>", $valor);
                $this->_view->class = $class;
            }
        }
        else if($valor > 0)
        {
            $this->_view->class = "alert-success";
            
            if(strtoupper($accion) == "H" || strtoupper($accion) == "D")
            {
                $this->_view->msg = "Se $accion $elemento satisfactoriamente.";
            }
            else
            {
                $this->_view->msg = "$elemento se $accion satisfactoriamente.";
            }
        }
        else if($valor == 0)
        {
            $this->_view->class = "alert-danger";
            if(strtoupper($accion) == "H" || strtoupper($accion) == "D")
            {
                $this->_view->msg = "Error, No se $accion $elemento satisfactoriamente.";
            }
            else
            {
                $this->_view->msg = "Error, $elemento no se logró $accion satisfactoriamente";
            }
        }
        else if($valor < 0)
        {            
            if(!$msg || !$class)
            {
                throw new Exception('Error debe setear un mensaje y un tipo de alerta.');
            }
            else 
            {
                $this->_view->msg = $msg;
                $this->_view->class = $class;
            }
        }
    }
    
    public function setear_mensaje ($msg , $class)
    {
        if(!$msg || !$class)
        {
            throw new Exception('Error debe setear un mensaje y un tipo de alerta.');
        }
        else 
        {
            $this->_view->msg = $msg;
            $this->_view->class = $class;
        }
    }
    
    public function fatalError($msg)
    {
        if(!$msg)
        {
            throw new Exception('Error debe setear un mensaje y un tipo de alerta.');
        }
        else 
        {
            echo '<div class="row"><div class="col-md-8 col-md-offset-2"><a class="close" data-dismiss="alert">×</a>';
            echo '<div class="alert alert-error">';
            echo '<meta charset="utf-8">' ;
            print $msg;
            echo '</div></div></div>';
        }
    }
}
?>
