<?php 
class Permisos_usuarios extends ActiveRecord\Model
{
	static $table_name = 'permisos_usuarios';

	public function listarPermisos_usuarios()
	{
		try
		{
			return Permisos_usuarios::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_usuarios($data)
	{
		try
		{
			$objeto = Permisos_usuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarPermisos_usuarios($data)
	{
		try
		{
			return Permisos_usuarios::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_usuarios($data)
	{
		try
		{
			$objeto = Permisos_usuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_usuarios($id)
	{
		try
		{
			$objeto = Permisos_usuarios::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>