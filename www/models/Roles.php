<?php 
class Roles extends ActiveRecord\Model
{
	static $table_name = 'roles';

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

	public function modificarRoles($id)
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