<?php 
class permisosrolesController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$permisos_roles = $this->Permisos_roles->listarPermisos_roles();
		$this->_view->permisos_roles = permisos_roles;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["permisos_roles"]) > 0)
		{
			$this->mensaje(Permisos_roles::agregarPermisos_roles($this->data["permisos_roles"]) , "A" , "El permisos_roles", "El permisos_roles que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->permisos_roles = Permisos_roles::consultarPermisos_roles($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["permisos_roles"]) > 0)
		{
			$this->data["permisos_roles"]["id"] = $id;$this->mensaje(Permisos_roles::modificarPermisos_roles($this->data["permisos_roles"]) , "A" , "El permisos_roles", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->permisos_roles = permisos_roles;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Permisos_roles::eliminarPermisos_roles($id), "E", "permisos_roles");
		$this->_view->permisos_roles = Permisos_roles::listarPermisos_roles();
		$this->_view->render('lista');
	}


}
?>