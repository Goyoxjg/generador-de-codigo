<?php 
class OrigenCampos extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'origen_campos';

	public function listarOrigenCampos()
	{
		try
		{
			return OrigenCampos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarOrigenCampos($id)
	{
		try
		{
			return OrigenCampos::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarOrigenCampos($data)
	{
		try
		{
			return OrigenCampos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarOrigenCampos($data)
	{
		try
		{
			$objeto = OrigenCampos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarOrigenCampos($id)
	{
		try
		{
			$objeto = OrigenCampos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>