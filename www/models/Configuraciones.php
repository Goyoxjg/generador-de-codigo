<?php 
class Configuraciones extends ActiveRecord\Model
{
	static $table_name = 'configuraciones';

	public function listarConfiguraciones()
	{
		try
		{
			return Configuraciones::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarConfiguraciones($data)
	{
		try
		{
			$objeto = Configuraciones::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarConfiguraciones($data)
	{
		try
		{
			return Configuraciones::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarConfiguraciones($data)
	{
		try
		{
			$objeto = Configuraciones::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarConfiguraciones($id)
	{
		try
		{
			$objeto = Configuraciones::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>