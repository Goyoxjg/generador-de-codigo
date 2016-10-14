<?php

class contrasenaController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
        
    public function restablecer()        
    {
        if(count($this->data["usuario"]))
        {
            switch (Login::restablecer_contrasena((object)$this->data["usuario"])) 
            {
                case 1:
                    
                    $msg = "Se ha enviado un correo como respuesta su solicitud de la contraseña del sistema.";
                    $class = "alert-success";
                    break;
                case 0:
                    $msg = "Error al cambiar la contraseña.";
                    $class = "alert-danger";                    
                    break;
                case -1:
                    $msg = "El usuario ingresado no existe.";
                    $class = "alert-warning";
                    break;
                case -2:
                    $msg = "Error al enviar el correo, intente más tarde.";
                    $class = "alert-warning";
                    break;                
            }  
            $this->setear_mensaje($msg, $class);
        }
        $this->_view->render('restablecer');
    }
    
    public function index()        
    {        
        if(count($this->data["contrasena"]) > 0)
        {                        
            switch (Login::cambiar_contrasena((object)$this->data["contrasena"])) 
            {
                case 1:
                    $msg = "Se realizo el cambio de contraseña exitosamente.";
                    $class = "alert-success";
                    break;
                case 0:
                    $msg = "Error al cambiar la contraseña.";
                    $class = "alert-danger";                    
                    break;
                case -1:
                    $msg = "La contraseña actual es incorrecta.";
                    $class = "alert-warning";
                    break;
                case -2:
                    $msg = "La nueva contraseña y la confirmación no coinciden.";
                    $class = "alert-warning";
                    break;                
            }         
            $this->setear_mensaje($msg, $class);
        }        
        $this->_view->render('cambiar');
    }
}