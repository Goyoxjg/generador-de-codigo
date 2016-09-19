<?php 
class permisos_roles extends ActiveRecord\Model
{
	public function listarpermisos_roles()
	{
		return permisos_roles::find('all');
	}

	public function consultarpermisos_roles($id)
	{
		return permisos_roles::find($id);
	}

	tpublic function agregarpermisos_roles($data)
	{
		return permisos_roles::create($data);
	}

	public function modificarpermisos_roles($data)
	{
		$objeto = permisos_roles::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarpermisos_roles($id)
	{
		$objeto = permisos_roles::find($data['id']);
		return $objeto->delete();
	}


}
?>