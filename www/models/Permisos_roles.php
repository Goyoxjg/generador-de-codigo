<?php 
class Permisos_roles extends ActiveRecord\Model
{
	static $table_name = 'permisos_roles';

	public function listarPermisos_roles()
	{
		try
		{
			return Permisos_roles::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_roles($data)
	{
		try
		{
			$objeto = Permisos_roles::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarPermisos_roles($data)
	{
		try
		{
			return Permisos_roles::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_roles($data)
	{
		try
		{
			$objeto = Permisos_roles::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos_roles($id)
	{
		try
		{
			$objeto = Permisos_roles::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>