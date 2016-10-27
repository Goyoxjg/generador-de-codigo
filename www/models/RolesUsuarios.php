<?php 
class RolesUsuarios extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'roles_usuarios';

	static $has_many = array(
		array('roles_usuarios'),
		array('usuarios','through' => 'roles_usuarios'),
		array('roles_usuarios'),
		array('roles','through' => 'roles_usuarios')
	);

	public function listarRolesUsuarios()
	{
		try
		{
			return RolesUsuarios::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarRolesUsuarios($id)
	{
		try
		{
			return RolesUsuarios::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarRolesUsuarios($data)
	{
		try
		{
			return RolesUsuarios::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarRolesUsuarios($data)
	{
		try
		{
			$objeto = RolesUsuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarRolesUsuarios($id)
	{
		try
		{
			$objeto = RolesUsuarios::find($id);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>