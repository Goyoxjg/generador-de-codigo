#!/usr/bin/python
# -*- coding: utf-8 -*-

#import psycopg2, psycopg2.extras

class Boostrap:


	def __init__(self):
		self.tab = ''
		self.numTab = 0
		self.tipoFormulario = ''

	def Tab(self, accion=None):				
		#print "Accion: %s"% accion
		if accion == "+":						
			#print "+"	
			self.numTab = self.numTab + 1		
		elif accion == "-":
			#print "-"	
			self.numTab = self.numTab - 1						
		
		
		if self.numTab:
			self.tab = str(self.numTab * '\t')
		else:				
			self.tab = ''
			
		#print "self.numTab: %s "% self.numTab
		#print str(self.tab)+"|"
		return str(self.tab)
		
	def getTab(self):
		return self.numTab
		
	def setTab(self, cursor):
		self.numTab = cursor 

	def nuevaLinea(self,multiplicador = 1):
		return str(multiplicador*'\n')

	def agregarFila(self):		
		html = '<div class="row">'+self.nuevaLinea()+self.Tab('+')
		html +='<div class="col-md-12">&nbsp;</div>'+self.nuevaLinea()+self.Tab('-')
		html +='</div>'
		html +=self.nuevaLinea()
		##print html
		return html

	def agregarInput(self, tipo, id, controlador, cel , options = {}):
		if tipo == "character varying":
			tipoCampo = "text"
		elif tipo == "integer":
			tipoCampo = "number"
		elif tipo == "time without time zone":
			tipoCampo = "date"
		elif tipo == "boolean":
			tipoCampo = "checkbox"

		html = ''
		if tipoCampo == "text" or tipoCampo == "number" or tipoCampo == "date":			
			#self.setTab((self.getTab()-self.getTab()))
			html +=self.Tab()
			html+=str(self.getTab())
			html +='<div class="form-group control-group col-md-'+str(cel)+'">'+self.nuevaLinea()+self.Tab('+')
			html +='<label for="'+id+'" class="control-label">'+id+'</label>'+self.nuevaLinea()+self.Tab()
			html +='<div class="controls">'+self.nuevaLinea()+self.Tab('+')
			html +='<input type="'+tipoCampo+'" class="form-control" name="'+controlador+'['+id+']" id="'+id+'" placeholder="'+id+'">'+self.nuevaLinea()+self.Tab('-')
			html +='</div>'+self.nuevaLinea()+self.Tab('-')
			html +='</div>'+self.nuevaLinea()
			#html +=self.Tab()
		elif tipoCampo == "checkbox":
			html +=''
		#elif tipo == "radio":
		#print "\n\n %s \n\n" % html
		return html

	def agregarSelect(self, id, controlador, cel , values={}, options = {}):
		html=''
		return html

	def agregarTextArea(self, id, controlador, cel , options = {}):
		html=''
		return html

	def abrirCol(self, celdas='4' , offset='4'):		
		html='<div class="col-md-'+celdas+' col-md-offset-'+offset+'" >'+self.nuevaLinea()+self.Tab('+')
		#print html
		return html

	def abrirFila(self):
		html='<div class="row" >'+self.nuevaLinea()
		#print html
		return html

	def cerrarFila(self):
		#print "self.getTab(): %s" % self.getTab()
		#self.setTab((self.getTab()-3))
		self.Tab('-')
		html=self.Tab('-')+'</div>'+self.nuevaLinea()
		return html
	
	def cerrarCol(self):
		html=+self.Tab('-')+'</div>'+self.nuevaLinea()+"cerrarCol"
		#print html
		return html

	def abrirFormulario(self, controlador, metodo, arg=None):
		if arg != None:
			argumentos = '<?= $this->'+controlador+'->'+arg+';?>'
		else:
			argumentos = ''
	
		html= '<form id="form" role="form" action="<?= BASE_URL;?>'+controlador+'/action'+metodo+'/'+argumentos+'" method="POST">'+self.nuevaLinea()+self.Tab('+')
		#print html
		return html

	def cerrarFormulario(self):		
		html= '</form>'+self.nuevaLinea()
		#html += self.Tab(0)
		return html

	def agregarTituloFormulario(self, metodo, controlador):
		#print "\n\n Tab: %s \n\n"% self.tab
		
		html='<legend>'+metodo+' '+controlador+'</legend>'+self.nuevaLinea()
		html+=self.Tab()
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
