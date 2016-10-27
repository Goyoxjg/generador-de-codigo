<?php 
class PermisosRoles extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'permisos_roles';

	static $has_many = array(
		array('permisos_roles'),
		array('roles','through' => 'permisos_roles'),
		array('permisos_roles'),
		array('permisos','through' => 'permisos_roles')
	);

	public function listarPermisosRoles()
	{
		try
		{
			return PermisosRoles::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarPermisosRoles($id)
	{
		try
		{
			return PermisosRoles::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarPermisosRoles($data)
	{
		try
		{
			return PermisosRoles::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisosRoles($data)
	{
		try
		{
			$objeto = PermisosRoles::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarPermisosRoles($id)
	{
		try
		{
			$objeto = PermisosRoles::find($id);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>