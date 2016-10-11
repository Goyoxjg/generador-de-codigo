<?php 
class Origen_campos extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'origen_campos';

	public function listarOrigen_campos()
	{
		try
		{
			return Origen_campos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarOrigen_campos($id)
	{
		try
		{
			return Origen_campos::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarOrigen_campos($data)
	{
		try
		{
			return Origen_campos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarOrigen_campos($data)
	{
		try
		{
			$objeto = Origen_campos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarOrigen_campos($id)
	{
		try
		{
			$objeto = Origen_campos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>