<?php 
class Validadores_campos extends ActiveRecord\Model
{
	static $table_name = 'validadores_campos';

	static $primary_key = 'id';

	public function listarValidadores_campos()
	{
		try
		{
			return Validadores_campos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarValidadores_campos($data)
	{
		try
		{
			$objeto = Validadores_campos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarValidadores_campos($data)
	{
		try
		{
			return Validadores_campos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarValidadores_campos($data)
	{
		try
		{
			$objeto = Validadores_campos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarValidadores_campos($id)
	{
		try
		{
			$objeto = Validadores_campos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>