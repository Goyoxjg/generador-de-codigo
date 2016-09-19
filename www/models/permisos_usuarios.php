<?php 
class permisos_usuarios extends ActiveRecord\Model
{
	public function listarpermisos_usuarios()
	{
		return permisos_usuarios::find('all');
	}

	public function consultarpermisos_usuarios($id)
	{
		return permisos_usuarios::find($id);
	}

	tpublic function agregarpermisos_usuarios($data)
	{
		return permisos_usuarios::create($data);
	}

	public function modificarpermisos_usuarios($data)
	{
		$objeto = permisos_usuarios::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarpermisos_usuarios($id)
	{
		$objeto = permisos_usuarios::find($data['id']);
		return $objeto->delete();
	}


}
?>