<?php 
class Usuarios extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'usuarios';

	static $has_many = array(
		array('permisos_usuarios'),
		array('permisos','through' => 'permisos_usuarios'),
		array('roles_usuarios'),
		array('roles','through' => 'roles_usuarios')
	);

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

	public function consultarUsuarios($id)
	{
		try
		{
			return Usuarios::find($id);
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

	public function eliminarUsuarios($id)
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