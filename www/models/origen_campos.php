<?php 
class origen_campos extends ActiveRecord\Model
{
	public function listarorigen_campos()
	{
		return origen_campos::find('all');
	}

	public function consultarorigen_campos($id)
	{
		return origen_campos::find($id);
	}

	tpublic function agregarorigen_campos($data)
	{
		return origen_campos::create($data);
	}

	public function modificarorigen_campos($data)
	{
		$objeto = origen_campos::find($data['id']);
		return $objeto->update_attributes($data);
	}

	public function eliminarorigen_campos($id)
	{
		$objeto = origen_campos::find($data['id']);
		return $objeto->delete();
	}


}
?>