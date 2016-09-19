<?php 
class roles_usuarios extends ActiveRecord\Model
{
	public function listarroles_usuarios()
	{
		return roles_usuarios::find('all');
	}

	public function consultarroles_usuarios($id)
	{
		return roles_usuarios::find($id);
	}

	tpublic function agregarroles_usuarios($data)
	{
		return roles_usuarios::create($data);
	}

	public function modificarroles_usuarios($data)
	{
		$objeto = roles_usuarios::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarroles_usuarios($id)
	{
		$objeto = roles_usuarios::find($data['id']);
		return $objeto->delete();
	}


}
?>