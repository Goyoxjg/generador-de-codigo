<?php 
class Roles extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'roles';

	static $has_many = array(
		array('permisos_roles'),
		array('permisos','through' => 'permisos_roles'),
		array('roles_usuarios'),
		array('usuarios','through' => 'roles_usuarios')
	);

	public function listarRoles()
	{
		try
		{
			return Roles::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarRoles($id)
	{
		try
		{
			return Roles::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarRoles($data)
	{
		try
		{
			return Roles::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarRoles($data)
	{
		try
		{
			$objeto = Roles::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarRoles($id)
	{
		try
		{
			$objeto = Roles::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>