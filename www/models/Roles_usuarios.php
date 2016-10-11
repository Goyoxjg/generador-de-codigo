<?php 
class Roles_usuarios extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'roles_usuarios';

	public function listarRoles_usuarios()
	{
		try
		{
			return Roles_usuarios::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarRoles_usuarios($id)
	{
		try
		{
			return Roles_usuarios::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarRoles_usuarios($data)
	{
		try
		{
			return Roles_usuarios::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarRoles_usuarios($data)
	{
		try
		{
			$objeto = Roles_usuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarRoles_usuarios($id)
	{
		try
		{
			$objeto = Roles_usuarios::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>