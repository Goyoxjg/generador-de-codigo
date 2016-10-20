<?php 
class rolesController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$roles = $this->Roles->listarRoles();
		$this->_view->roles = roles;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["roles"]) > 0)
		{
			$this->mensaje(Roles::agregarRoles($this->data["roles"]) , "A" , "El roles", "El roles que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->roles = Roles::consultarRoles($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["roles"]) > 0)
		{
			$this->data["roles"]["id"] = $id;$this->mensaje(Roles::modificarRoles($this->data["roles"]) , "A" , "El roles", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->roles = roles;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Roles::eliminarRoles($id), "E", "roles");
		$this->_view->roles = Roles::listarRoles();
		$this->_view->render('lista');
	}


}
?>