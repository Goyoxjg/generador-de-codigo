<?php 
class Tipos_datos extends ActiveRecord\Model
{
	static $table_name = 'tipos_datos';

	public function listarTipos_datos()
	{
		try
		{
			return Tipos_datos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarTipos_datos($data)
	{
		try
		{
			$objeto = Tipos_datos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarTipos_datos($data)
	{
		try
		{
			return Tipos_datos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarTipos_datos($data)
	{
		try
		{
			$objeto = Tipos_datos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarTipos_datos($id)
	{
		try
		{
			$objeto = Tipos_datos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>