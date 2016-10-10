<?php 
class Usuarios extends ActiveRecord\Model
{
	static $table_name = 'usuarios';

	public function listarUsuarios()
	{
		try
		{
			return Usuarios::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarUsuarios($data)
	{
		try
		{
			$objeto = Usuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarUsuarios($data)
	{
		try
		{
			return Usuarios::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarUsuarios($data)
	{
		try
		{
			$objeto = Usuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarUsuarios($id)
	{
		try
		{
			$objeto = Usuarios::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>