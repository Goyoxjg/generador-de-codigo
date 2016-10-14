#!/usr/bin/python
# -*- coding: utf-8 -*-

#import psycopg2, psycopg2.extras

class Boostrap:
	
	"""
	def __init__(self,host,dbname,user,passwd):
		self.host = host
		self.dbname = dbname
		self.user = user
		self.passwd = passwd					
				
		self.conexion = self.conectarBDpostgres()		
		#return self.conexion
	"""	
	
	def agregarFila():
		html = '<div class="row">\n\t<div class="col-md-12">&nbsp;</div>\n\t</div>'
		return html
		
	def agregarInput(tipo, id, controlador, cel , options = {}):
		if tipo == "text":
			html = '<div class="form-group control-group col-md-12">\n\t'
			html +='<label for="'+id+'" class="control-label">'+id+'</label>\n\t\t'
			html +='	<div class="controls">\n\t\t\ct'
			html +='		<input type="text" class="form-control" name="'+controlador+'['+id+']" id="'+id+'" placeholder="Grado" autofocus>\n\t\t'
			html +='	</div>\n\t'
			html +='</div>'
			
		"""
		elif tipo == "number":		
		elif tipo == "date":		
		elif tipo == "radio":		
		elif tipo == "checkbox":
		"""
		return html
		
	def agregarSelect(id, controlador, cel , values={}, options = {}):
		html=''
		return html
		
	def agregarTextArea(id, controlador, cel , options = {}):
		html=''
		return html
		
	
		
	"""
	
	
	
	<form role="form" method="POST" action="<?= BASE_URL;?>grados/actionEditar/<?= $this->grado->id_gra;?>">
	<form id="form" role="form" action="<?= BASE_URL;?>grados/actionAgregar" method="POST">
	
	</form>
		
	
	
	
	<div class="row">
		<div class="form-group col-md-12 col-md-offset-3 form-actions">
			<button type="submit" class="btn btn-primary" role="button">Agregar</button>                   
			<a href="<?= BASE_URL;?>grados" class="btn btn-primary col-md-offset-1"  role="button">Volver</a>            
		</div>
	</div>
	
	
	<?php 
	if(isset($this->msg))
	{?>
		<script id="msgModal">
			ejecutarModal("<?= $this->msg;?>","Agregar Grado",{label: "Ok"});
		</script>
	<?php
	}
	?>	
	"""
