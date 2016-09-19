<?php 
class permisos extends ActiveRecord\Model
{
	public function listarpermisos()
	{
		return permisos::find('all');
	}

	public function consultarpermisos($id)
	{
		return permisos::find($id);
	}

	tpublic function agregarpermisos($data)
	{
		return permisos::create($data);
	}

	public function modificarpermisos($data)
	{
		$objeto = permisos::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarpermisos($id)
	{
		$objeto = permisos::find($data['id']);
		return $objeto->delete();
	}


}
?>