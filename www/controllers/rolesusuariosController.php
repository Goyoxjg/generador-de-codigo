<?php 
class rolesusuariosController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$roles_usuarios = $this->Roles_usuarios->listarRoles_usuarios();
		$this->_view->roles_usuarios = roles_usuarios;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["roles_usuarios"]) > 0)
		{
			$this->mensaje(Roles_usuarios::agregarRoles_usuarios($this->data["roles_usuarios"]) , "A" , "El roles_usuarios", "El roles_usuarios que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->roles_usuarios = Roles_usuarios::consultarRoles_usuarios($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["roles_usuarios"]) > 0)
		{
			$this->data["roles_usuarios"]["id"] = $id;$this->mensaje(Roles_usuarios::modificarRoles_usuarios($this->data["roles_usuarios"]) , "A" , "El roles_usuarios", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->roles_usuarios = roles_usuarios;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Roles_usuarios::eliminarRoles_usuarios($id), "E", "roles_usuarios");
		$this->_view->roles_usuarios = Roles_usuarios::listarRoles_usuarios();
		$this->_view->render('lista');
	}


}
?>