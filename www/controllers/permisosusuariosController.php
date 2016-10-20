<?php 
class permisosusuariosController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$permisos_usuarios = $this->Permisos_usuarios->listarPermisos_usuarios();
		$this->_view->permisos_usuarios = permisos_usuarios;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["permisos_usuarios"]) > 0)
		{
			$this->mensaje(Permisos_usuarios::agregarPermisos_usuarios($this->data["permisos_usuarios"]) , "A" , "El permisos_usuarios", "El permisos_usuarios que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->permisos_usuarios = Permisos_usuarios::consultarPermisos_usuarios($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["permisos_usuarios"]) > 0)
		{
			$this->data["permisos_usuarios"]["id"] = $id;$this->mensaje(Permisos_usuarios::modificarPermisos_usuarios($this->data["permisos_usuarios"]) , "A" , "El permisos_usuarios", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->permisos_usuarios = permisos_usuarios;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Permisos_usuarios::eliminarPermisos_usuarios($id), "E", "permisos_usuarios");
		$this->_view->permisos_usuarios = Permisos_usuarios::listarPermisos_usuarios();
		$this->_view->render('lista');
	}


}
?>