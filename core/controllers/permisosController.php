<?php

class permisosController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
        
    public function index()
    {                
        $usuarios = Usuario::listarUsuarios();                
        $this->_view->usuarios = (Array)$usuarios;
        $this->_view->render('lista');  
    }   
          
    public function actionEditar($id_usu , $id_rol , $id_per = FALSE , $accion = FALSE)        
    {
        if($accion && $id_per)
        {
            switch (ucwords($accion)) 
            {
                case "A":
                    //$this->mensaje(PermisosUsuario::agregarUsuarioPermiso($id_usu , $id_per), "H", "permiso");
                    PermisosUsuario::agregarUsuarioPermiso($id_usu , $id_per);
                    break;
                
                case "D":
                    //$this->mensaje(PermisosUsuario::eliminarUsuarioPermiso($id_usu , $id_per), "D", "permiso");
                    PermisosUsuario::eliminarUsuarioPermiso($id_usu , $id_per);
                    break;
            }
        }
        
        $this->_view->usuarios = Usuario::consultarUsuario($id_usu);   
        $this->_view->permisosUsu = PermisosUsuario::consultarUsuarioPermisosTodos($id_usu , $id_rol);
        $this->_view->render('editar');
    }
}

