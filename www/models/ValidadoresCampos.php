<?php 
class ValidadoresCampos extends ActiveRecord\Model
{
	static $db = 'public';

	static $table_name = 'validadores_campos';

	static $has_many = array(
		array('validadores_campos'),
		array('origen_campos','through' => 'validadores_campos'),
		array('validadores_campos'),
		array('validaciones','through' => 'validadores_campos')
	);

	public function listarValidadoresCampos()
	{
		try
		{
			return ValidadoresCampos::find('all');
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function consultarValidadoresCampos($id)
	{
		try
		{
			return ValidadoresCampos::find($id);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function agregarValidadoresCampos($data)
	{
		try
		{
			return ValidadoresCampos::create($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function modificarValidadoresCampos($data)
	{
		try
		{
			$objeto = ValidadoresCampos::find($data['id']);
			return $objeto->update_attributes($data);
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}

	public function eliminarValidadoresCampos($id)
	{
		try
		{
			$objeto = ValidadoresCampos::find($id]);
			return $objeto->delete();
		}
		catch (Exception $exc)
		{
			$this->fatalError($exc->getMessage());
		}
	}


}
?>