<?php 
class Permisos extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'permisos';

	static $has_many = array(
		array('permisos_roles'),
		array('roles','through' => 'permisos_roles'),
		array('permisos_usuarios'),
		array('usuarios','through' => 'permisos_usuarios')
	);

	static $primary_key = 'id_per';

	public function listarPermisos()
	{
		try
		{
			return Permisos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarPermisos($id)
	{
		try
		{
			return Permisos::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarPermisos($data)
	{
		try
		{
			return Permisos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarPermisos($data)
	{
		try
		{
			$objeto = Permisos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarPermisos($id)
	{
		try
		{
			$objeto = Permisos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>