<?php 
class Permisos_roles extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'permisos_roles';

	static $has_many = array(
		array('permisos_roles'),
		array('roles','through' => 'permisos_roles'),
		array('permisos_roles'),
		array('permisos','through' => 'permisos_roles')
	);

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

	public function consultarPermisos_roles($id)
	{
		try
		{
			return Permisos_roles::find($id);
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

	public function eliminarPermisos_roles($id)
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