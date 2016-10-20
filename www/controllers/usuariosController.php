<?php 
class usuariosController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$usuarios = $this->Usuarios->listarUsuarios();
		$this->_view->usuarios = usuarios;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["usuarios"]) > 0)
		{
			$this->mensaje(Usuarios::agregarUsuarios($this->data["usuarios"]) , "A" , "El usuarios", "El usuarios que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->usuarios = Usuarios::consultarUsuarios($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["usuarios"]) > 0)
		{
			$this->data["usuarios"]["id"] = $id;$this->mensaje(Usuarios::modificarUsuarios($this->data["usuarios"]) , "A" , "El usuarios", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->usuarios = usuarios;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Usuarios::eliminarUsuarios($id), "E", "usuarios");
		$this->_view->usuarios = Usuarios::listarUsuarios();
		$this->_view->render('lista');
	}


}
?>