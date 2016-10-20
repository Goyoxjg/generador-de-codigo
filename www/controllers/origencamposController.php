<?php 
class origencamposController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$origen_campos = $this->Origen_campos->listarOrigen_campos();
		$this->_view->origen_campos = origen_campos;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["origen_campos"]) > 0)
		{
			$this->mensaje(Origen_campos::agregarOrigen_campos($this->data["origen_campos"]) , "A" , "El origen_campos", "El origen_campos que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->origen_campos = Origen_campos::consultarOrigen_campos($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["origen_campos"]) > 0)
		{
			$this->data["origen_campos"]["id"] = $id;$this->mensaje(Origen_campos::modificarOrigen_campos($this->data["origen_campos"]) , "A" , "El origen_campos", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->origen_campos = origen_campos;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Origen_campos::eliminarOrigen_campos($id), "E", "origen_campos");
		$this->_view->origen_campos = Origen_campos::listarOrigen_campos();
		$this->_view->render('lista');
	}


}
?>