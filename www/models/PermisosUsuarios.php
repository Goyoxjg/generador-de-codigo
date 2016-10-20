<?php 
class PermisosUsuarios extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'permisos_usuarios';

	static $has_many = array(
		array('permisos_usuarios'),
		array('usuarios','through' => 'permisos_usuarios'),
		array('permisos_usuarios'),
		array('permisos','through' => 'permisos_usuarios')
	);

	public function listarPermisosUsuarios()
	{
		try
		{
			return PermisosUsuarios::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarPermisosUsuarios($id)
	{
		try
		{
			return PermisosUsuarios::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarPermisosUsuarios($data)
	{
		try
		{
			return PermisosUsuarios::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisosUsuarios($data)
	{
		try
		{
			$objeto = PermisosUsuarios::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarPermisosUsuarios($id)
	{
		try
		{
			$objeto = PermisosUsuarios::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>