<?php 
class Permisos extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'permisos';

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