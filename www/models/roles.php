<?php 
class roles extends ActiveRecord\Model
{
	public function listarroles()
	{
		return roles::find('all');
	}

	public function consultarroles($id)
	{
		return roles::find($id);
	}

	tpublic function agregarroles($data)
	{
		return roles::create($data);
	}

	public function modificarroles($data)
	{
		$objeto = roles::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarroles($id)
	{
		$objeto = roles::find($data['id']);
		return $objeto->delete();
	}


}
?>