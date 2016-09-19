<?php 
class configuraciones extends ActiveRecord\Model
{
	public function listarconfiguraciones()
	{
		return configuraciones::find('all');
	}

	public function consultarconfiguraciones($id)
	{
		return configuraciones::find($id);
	}

	tpublic function agregarconfiguraciones($data)
	{
		return configuraciones::create($data);
	}

	public function modificarconfiguraciones($data)
	{
		$objeto = configuraciones::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarconfiguraciones($id)
	{
		$objeto = configuraciones::find($data['id']);
		return $objeto->delete();
	}


}
?>