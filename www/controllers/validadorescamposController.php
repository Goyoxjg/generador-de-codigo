<?php 
class validadorescamposController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$validadores_campos = $this->Validadores_campos->listarValidadores_campos();
		$this->_view->validadores_campos = validadores_campos;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["validadores_campos"]) > 0)
		{
			$this->mensaje(Validadores_campos::agregarValidadores_campos($this->data["validadores_campos"]) , "A" , "El validadores_campos", "El validadores_campos que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->validadores_campos = Validadores_campos::consultarValidadores_campos($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["validadores_campos"]) > 0)
		{
			$this->data["validadores_campos"]["id"] = $id;$this->mensaje(Validadores_campos::modificarValidadores_campos($this->data["validadores_campos"]) , "A" , "El validadores_campos", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->validadores_campos = validadores_campos;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Validadores_campos::eliminarValidadores_campos($id), "E", "validadores_campos");
		$this->_view->validadores_campos = Validadores_campos::listarValidadores_campos();
		$this->_view->render('lista');
	}


}
?>