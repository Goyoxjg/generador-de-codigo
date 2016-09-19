<?php 
class validadores_campos extends ActiveRecord\Model
{
	public function listarvalidadores_campos()
	{
		return validadores_campos::find('all');
	}

	public function consultarvalidadores_campos($id)
	{
		return validadores_campos::find($id);
	}

	tpublic function agregarvalidadores_campos($data)
	{
		return validadores_campos::create($data);
	}

	public function modificarvalidadores_campos($data)
	{
		$objeto = validadores_campos::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarvalidadores_campos($id)
	{
		$objeto = validadores_campos::find($data['id']);
		return $objeto->delete();
	}


}
?>