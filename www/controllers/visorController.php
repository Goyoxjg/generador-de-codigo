<?php
class visorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
        //$usuarios = $this->Usuario->listarUsuarios();        
        //$this->_view->usuarios = $usuarios;        
        $this->_view->render('index');
    }           
    
    public function actionVisualizar()
    {
        //$usuarios = $this->Usuario->listarUsuarios();        
        //$this->_view->usuarios = $usuarios;        
        $this->_view->render('index');
    }           
    /*
    public function actionAgregar()
    {                
        if(count($this->data) > 0)
        {            
            $this->mensaje(Usuario::agregarUsuario($this->data["usuario"]) , "A" , "usuario", "El usuario que intenta registrar ya existe." , "alert-warning") ;
        }        
        
        $this->_view->roles = Role::listarRoles();        
        $this->_view->render("agregar");
    }

    public function actionConsultar($id_usu , $btn_volver = FALSE)
    {
        $this->_view->roles = Role::listarRoles();
        $this->_view->usuario = $this->Usuario->consultarUsuario($id_usu);        
        $this->_view->volver = $btn_volver;        
        $this->_view->render("consultar");
    }  
    
    public function actionEditar($id_usu)
    {   
        if(count($this->data) > 0)
        {
            $this->data["usuario"]["id_usu"] = $id_usu;            
            $this->mensaje(Usuario::modificarUsuario($this->data["usuario"]) , "M", "usuario");
        }            
        $this->_view->roles = Role::listarRoles();
        $this->_view->usuario = $this->Usuario->consultarUsuario($id_usu);
        $this->_view->render("editar");
    }    
    
    public function actionEliminar($id_usu)
    {   
        $this->mensaje(Usuario::eliminarUsuario($id_usu), "E", "usuario");
        $this->_view->usuarios = Usuario::listarUsuarios();;
        $this->_view->render('lista');
    }    
    */
}
?>
