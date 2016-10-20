<?php 
class permisosController extends Controller
{
	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$permisos = $this->Permisos->listarPermisos();
		$this->_view->permisos = permisos;
		$this->_view->render('lista');
	}

	public function actionAgregar()
	{
		if(count($this->data["permisos"]) > 0)
		{
			$this->mensaje(Permisos::agregarPermisos($this->data["permisos"]) , "A" , "El permisos", "El permisos que intenta registrar ya existe." , "alert-warning") ;
		}
		$this->_view->render('agregar');
	}

	public function actionConsultar($id)
	{
		$this->_view->permisos = Permisos::consultarPermisos($id);
		$this->_view->render('consultar');
	}

	public function actionEditar($id)
	{
		if(count($this->data["permisos"]) > 0)
		{
			$this->data["permisos"]["id_per"] = $id;$this->mensaje(Permisos::modificarPermisos($this->data["permisos"]) , "A" , "El permisos", "Error al realizar la edición" , "alert-warning") ;
		}
		$this->_view->permisos = permisos;
		$this->_view->render('editar');
	}

	public function actionEliminar($id)
	{
		$this->mensaje(Permisos::eliminarPermisos($id), "E", "permisos");
		$this->_view->permisos = Permisos::listarPermisos();
		$this->_view->render('lista');
	}


}
?>