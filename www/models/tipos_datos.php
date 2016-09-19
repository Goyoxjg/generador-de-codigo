<?php 
class tipos_datos extends ActiveRecord\Model
{
	public function listartipos_datos()
	{
		return tipos_datos::find('all');
	}

	public function consultartipos_datos($id)
	{
		return tipos_datos::find($id);
	}

	tpublic function agregartipos_datos($data)
	{
		return tipos_datos::create($data);
	}

	public function modificartipos_datos($data)
	{
		$objeto = tipos_datos::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminartipos_datos($id)
	{
		$objeto = tipos_datos::find($data['id']);
		return $objeto->delete();
	}


}
?>