<?php 
class Validaciones extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'validaciones';

	static $primary_key = 'id_val';

	public function listarValidaciones()
	{
		try
		{
			return Validaciones::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarValidaciones($id)
	{
		try
		{
			return Validaciones::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarValidaciones($data)
	{
		try
		{
			return Validaciones::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarValidaciones($data)
	{
		try
		{
			$objeto = Validaciones::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarValidaciones($id)
	{
		try
		{
			$objeto = Validaciones::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>