#!/usr/bin/python
# -*- coding: utf-8 -*-

#import psycopg2, psycopg2.extras
from modulos.GestorBD.gestorBaseDatos import*
import re

class Boostrap:


	def __init__(self):
		self.tab = ''
		self.numTab = 0
		self.tipoFormulario = ''

	def Tab(self, accion=None):				
		if accion == "+":						
			self.numTab = self.numTab + 1		
		elif accion == "-":
			self.numTab = self.numTab - 1						
		
		
		if self.numTab:
			self.tab = str(self.numTab * '\t')
		else:				
			self.tab = ''
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
			html+=self.Tab()			
			html +='<div class="form-group control-group col-md-'+str(cel)+'">'+self.nuevaLinea()+self.Tab('+')
			html +='<label for="'+id+'" class="control-label">'+id+'</label>'+self.nuevaLinea()+self.Tab()
			html +='<div class="controls">'+self.nuevaLinea()+self.Tab('+')
			html +='<input type="'+tipoCampo+'" class="form-control" name="'+controlador+'['+id+']" id="'+id+'" placeholder="'+id+'">'+self.nuevaLinea()+self.Tab('-')
			html +='</div>'+self.nuevaLinea()+self.Tab('-')
			html +='</div>'+self.nuevaLinea()			
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

	def crearCol(self, contenido, celdas='4' , offset='4', tab=1):		
		tmp = (tab-1)	
		tab = (tab * '\t')		
		tabF= (tmp * '\t')
		
		if offset == '0':		
			html='<div class="col-md-'+celdas+'" >'+self.nuevaLinea()+tab
		else:
			html='<div class="col-md-'+celdas+' col-md-offset-'+offset+'" >'+self.nuevaLinea()+tab
			
		html+=contenido
		html+=tabF
		html+='</div>\n'+tab
		#print html
		return html

	def crearFila(self, contenido, tab=1):			
		tmp = (tab-1)	
		tab = (tab * '\t')		
		tabF= (tmp * '\t')
		
		html= '<div class="row" >\n'+tab
		html+=contenido
		#html+=tabF
		html+='</div>\n'+tab
		#print html
		return html
	
	def crearFormulario(self,contenido, tab, controlador, metodo, arg=None):
		if arg != None:
			argumentos = '<?= $this->'+controlador+'->'+arg+';?>'
		else:
			argumentos = ''				
		
		
		tmp = (tab-1)	
		tab = (tab * '\t')		
		tabF= (tmp * '\t')
		contenido = re.sub('[<]', tab+'<', contenido)
		contenido = re.sub('\t\t\t</label>', '</label>', contenido)
		contenido = re.sub('\t\t\t</legend>', '</legend>', contenido)
		contenido = re.sub('\t\t\t</button>', '</button>', contenido)		
		contenido = re.sub('"\t\t\t<?=', '"<?=', contenido)		
		contenido = re.sub('\t\t\t</a>', '</a>', contenido)		
		
		
		t = self.getTab()
		html= '<form id="form" role="form" action="<?= BASE_URL;?>'+controlador+'/action'+metodo+'/'+argumentos+'" method="POST">'+self.nuevaLinea()
		html+=contenido		
		#self.setTab(t)
		
		html+=tabF
		html+='</form>'+self.nuevaLinea()
		#print html
		return html
	

	def agregarTituloFormulario(self, metodo, controlador):
		#print "\n\n Tab: %s \n\n"% self.tab		
		html='<legend>'+metodo+' '+controlador+'</legend>'+self.nuevaLinea()
		#html+=self.Tab('+')
		return html

	def agregarBotonera(self,controlador, metodo, clase="primary"):
		html = '<div class="row">\n\t'
		html +='<div class="col-md-12" >\n\t\t'
		html +='<button type="submit" class="btn btn-'+clase+'" role="button">'+metodo+'</button>\n\t\t'
		html +='<a href="<?= BASE_URL;?>'+controlador+'/action'+metodo+'/" class="btn btn-'+clase+' col-md-offset-1"  role="button">Volver</a>\n\t'
		html += '</div>\n'
		html += '</div>\n'
		return html
		
	def agregarBotonAgregar(self,controlador, clase="primary"):
		html = '\n<div class="row">\n\t'
		html +='<div class="col-md-12" >\n\t\t'		
		html +='<a href="<?= BASE_URL;?>'+controlador+'/actionAgregar/" class="btn btn-'+clase+' col-md-offset-1"  role="button">Agregar</a>\n\t'		
		html += '</div>\n'
		html += '</div>\n'
		return html
		
	
	def agregarVolver(self,controlador, metodo, text="Volver", clase="primary"):
		html = '<div class="row">\n\t'
		html +='<div class="col-md-12 col-md-offset-0" >\n\t\t'		
		html +='<a href="<?= BASE_URL;?>'+controlador+'/action'+metodo+'/" class="btn btn-'+clase+' col-md-offset-1"  role="button">Volver</a>\n\t'
		html += '</div>\n'
		html += '</div>\n'
		return html
		
	def agregarTablaLista(self, controlador , connBD, tab):			
		#~ print controlador
		
		tab = str(tab * '\t')
						
		resultado = connBD.consultarPkTabla(controlador)		
		campoPK = resultado[0][0]
			
		html = tab+'<table class="table table-condensed">\n\t\t\t<thead>\n\t\t'+tab		
		thead = ''
		for res in connBD.leerCamposTablas(controlador):
			column_name = res[3]
			thead += '<th class="text-center">'+column_name+'</th>\n\t\t'+tab
			
		thead += '<th class="text-center">Opciones</th>\n\t'+tab
		
		html += thead+'</thead>\n\t\t\t<tbody>\n\t'+tab
		html += '<?php\n\t\t\t\tforeach ($this->'+controlador+' as $key => $value)\n\t\t\t\t{?>\n\t\t'+tab
		html += '<tr>\n\t\t\t'+tab
		tbody = ''

		for res in connBD.leerCamposTablas(controlador):
			column_name = res[3]
			tbody += '<td class="text-center"><?= $value->'+column_name+';?></td>\n\t\t\t'+tab
						
		
		html += tbody
		
		html += '<td class="text-center">\n\t\t\t\t'+tab
		html += '<a href="<?= BASE_URL.\''+controlador+'/actionConsultar/\'.$value->'+campoPK+';?>" class="btn btn-primary"  role="button">\n\t\t\t\t\t'+tab
		html += '<span class="glyphicon glyphicon-search"></span>\n\t\t\t\t\t\t</a>\n\t\t\t\t'+tab
		html += '<a href="<? BASE_URL.\''+controlador+'/actionEditar/\'.$value->'+campoPK+';?>" class="btn btn-primary"  role="button">\n\t\t\t\t\t'+tab
		html += '<span class="glyphicon glyphicon-edit"></span>\n\t\t\t\t\t\t</a>\n\t\t\t\t'+tab
		html += '<a href="<? BASE_URL.\''+controlador+'/actionEliminar/\'.$value->'+campoPK+';?>" class="btn btn-primary"  role="button">\n\t\t\t\t\t'+tab
		html += '<span class="glyphicon glyphicon-trash"></span>\n\t\t\t\t\t\t</a>\n\t\t\t'+tab
		html += '</td>\n\t\t'+tab
		html += '</tr>\n\t'+tab
		html += '<?php\n\t\t\t\t}?>\n\t\t\t</tbody>\n\t\t</table>\n\t'
		return html
		
	def agregarFuncionMensaje(self, controlador , metodo=""):			
		controlador = controlador.capitalize()
		html = ''
		html += '<?php\nif(isset($this->msg))\n{?>\n\t<script id="msgModal">\n\t\t'
		html += 'ejecutarModal("<?= $this->msg;?>","'+metodo+' '+controlador+'",{label: "Ok"});\n\t'
		html += '</script>\n<?php\n}\n?>'			
		return html

	

