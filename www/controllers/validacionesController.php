<?php 
class validacionesController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$validaciones = $this->Validaciones->listarValidaciones();
		$this->_view->validaciones = validaciones;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["validaciones"]) > 0)
		{
			$this->mensaje(Validaciones::agregarValidaciones($this->data["validaciones"]) , "A" , "El validaciones", "El validaciones que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->validaciones = Validaciones::consultarValidaciones($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["validaciones"]) > 0)
		{
			$this->data["validaciones"]["id_val"] = $id;$this->mensaje(Validaciones::modificarValidaciones($this->data["validaciones"]) , "A" , "El validaciones", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->validaciones = validaciones;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Validaciones::eliminarValidaciones($id), "E", "validaciones");
		$this->_view->validaciones = Validaciones::listarValidaciones();
		$this->_view->render('lista');
	}


}
?>