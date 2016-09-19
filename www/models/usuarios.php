<?php 
class usuarios extends ActiveRecord\Model
{
	public function listarusuarios()
	{
		return usuarios::find('all');
	}

	public function consultarusuarios($id)
	{
		return usuarios::find($id);
	}

	tpublic function agregarusuarios($data)
	{
		return usuarios::create($data);
	}

	public function modificarusuarios($data)
	{
		$objeto = usuarios::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarusuarios($id)
	{
		$objeto = usuarios::find($data['id']);
		return $objeto->delete();
	}


}
?>