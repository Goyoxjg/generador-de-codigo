<?php 
class validaciones extends ActiveRecord\Model
{
	public function listarvalidaciones()
	{
		return validaciones::find('all');
	}

	public function consultarvalidaciones($id)
	{
		return validaciones::find($id);
	}

	tpublic function agregarvalidaciones($data)
	{
		return validaciones::create($data);
	}

	public function modificarvalidaciones($data)
	{
		$objeto = validaciones::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarvalidaciones($id)
	{
		$objeto = validaciones::find($data['id']);
		return $objeto->delete();
	}


}
?>