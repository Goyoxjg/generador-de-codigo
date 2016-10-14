#!/usr/bin/python
# -*- coding: utf-8 -*-


# aptitude install python-psycopg2
from modulos.GestorBD.gestorBaseDatos import*
from modulos.htmlBoostrap.htmlBoostrap import*
import os, re, shutil, os.path

def crearCarpeta(dir):	
	if not os.path.exists(dir):
		os.makedirs(dir)
		
def recorrerEstrucutra(base,nodos):
	for nodo in nodos:						
		if(nodos[nodo] != None):								
			if(isinstance(nodos[nodo], list)):
				for n in nodos[nodo]:
					print "creando carpeta "+base+"/"+nodo+"/"+n
					crearCarpeta(base+"/"+nodo+"/"+n)
					#recorrerEstrucutra(base+"/"+nodo , nodos[nodo])
			else:
				print "creando carpeta "+base+"/"+nodo
				crearCarpeta(base+"/"+nodo)
				recorrerEstrucutra(base+"/"+nodo , nodos[nodo])
				
			
		else:			
			crearCarpeta(base+"/"+nodo)
			print "creando carpeta "+base+"/"+nodo+"/"		

	

def crearEstructura():	
	nodos = {"www":{"app" : None,"controllers":None,"libs":None,"models":None,"public":["css","js","img"],"views":{"layout":{"default":["css","js","img"]}}}}	
	for nodo in nodos:				
		recorrerEstrucutra(nodo,nodos[nodo])				
		
		
nl = '\n'
tab = '\t'			

def metodoListar(modelo):		
	cadena = ''
	cadena += tab+'public function listar'+modelo+'()'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += 'return '+modelo+'::find(\'all\');'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena
	
def metodoAgregar(modelo):
	cadena = ''
	cadena += tab+'public function agregar'+modelo+'($data)'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += 'return '+modelo+'::create($data);'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena
	
def metodoConsultar(modelo):
	cadena = ''
	cadena += tab+'public function consultar'+modelo+'($id)'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += 'return '+modelo+'::find($id);'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena
		
def metodoModificar(modelo):
	cadena = ''
	cadena += tab+'public function modificar'+modelo+'($data)'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += '$objeto = '+modelo+'::find($data[\'id\']);'+nl+tab*3+'return $objeto->update_attributes($data);'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena	
	
def metodoEliminar(modelo):	
	cadena = ''
	cadena += tab+'public function eliminar'+modelo+'($id)'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += '$objeto = '+modelo+'::find($id]);'+nl+tab*3+'return $objeto->delete();'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena			
	
def metodoConsultarUltimo(modelo):
	cadena = ''
	cadena += tab+'public function consultarUltimo'+modelo+'()'+nl+tab
	cadena += '{'+nl+tab*2+'try'+nl+tab*2+'{'+nl+tab*3	
	cadena += 'return '+modelo+'::last();'+nl+tab*2+'}'+nl+tab*2+'catch (Exception $exc)'+nl+tab*2+'{'+nl
	cadena += tab*3+'$this->fatalError($exc->getMessage());'+nl+tab*2+'}'+nl+tab*1+'}'+nl*2	
	return cadena
	
	
def obtenerRutas(tmp):
	if os.path.isdir(tmp):
		return os.listdir(tmp)
		
	return false
	

try:
	"""
	print "Bienvenido al asistente de generador de código"
	opcion = int(raw_input("ingrese que tipo de Base de Datos desea trabajar: \n1)PostgreSQL\n2)MySQL\nopción: "))
	if (opcion == 1):		
		host = raw_input("Ingrese el Host:\n")
		dbname = raw_input("Ingrese el nombre de la base de datos existente:\n")
		user = raw_input("Ingrese el usuario:\n")
		passwd = raw_input("Ingrese la contraseña:\n")
				
		conectarBDpostgres(host,dbname,user,passwd)		

	#elif (opcion == 2):		
	"""
	
	ruta_core = "core/"	
	ruta_destino = "www/"
	print "Copiando librerias existentes..."
	for elemento in os.listdir(ruta_core):
		
		ori = ruta_core+elemento+"/"
		des = ruta_destino+elemento+"/"
		
		
		if os.path.exists(des):			
			shutil.rmtree(des)
			
		shutil.copytree(ori,des)		
	
	host = "localhost"
	dbname = "framework"
	user = "postgres"
	passwd = "postgres"
		
	connBD = baseDatos(host,dbname,user,passwd)	
	
	
	crearEstructura()
	tablas = connBD.leerTablas()
	
	
	
	for tabla in tablas:				
		
		#print tabla
		nl = '\n'
		tab = '\t'			
		
		nombre_modelo = tabla[0].capitalize()
				
		archivo = open("www/models/"+nombre_modelo+'.php','w')	
					
		campos = []		
		
		model = '<?php \nclass '+nombre_modelo+' extends ActiveRecord\Model\n{\n'
		
		model += tab+'static $db = \''+tabla[1]+'\';'+nl*2
			
		model += tab+'static $table_name = \''+tabla[0]+'\';'+nl*2    					
				
		
		constraint = connBD.consultarConstraint(tabla[0])
		
		has_many = False		
		if len(constraint):			
			model += tab+"static $has_many = array("+nl
			
			c = len(constraint)
			for value in constraint:				
				#nombre_constraint = value[1]
				tabla_constraint = value[3]
				tabla_foreign = value[5]
				
				model += tab*2+"array('"+tabla_constraint+"'),"+nl
				model += tab*2+"array('"+tabla_foreign+"','through' => '"+tabla_constraint+"')"
				c = c-1
				if c != 0:
					model += ","+nl
				else:
					model += nl+tab+");"+nl*2
		
		#http://recursospython.com/guias-y-manuales/os-shutil-archivos-carpetas/
		
		for res in connBD.leerCamposTablas(tabla[0]):		
					
			column_name = res[3]
			column_default = res[5],
			is_nullable = res[6],
			data_type = res[7]
			character_maximun = res[8]
			#data_type = res[7]
			
			
			patron = re.compile('nextval')
			
			if column_default[0]:				
				if (patron.match(column_default[0]) != None) and (column_name != "id"):					
					model += tab+'static $primary_key = \''+column_name+'\';'+nl*2
								
			#tmp = {'column_name':res[3],'column_default':res[5],'is_nullable':res[6],'data_type':res[7]}
			#print res
			#campos.append(tmp)			
		
		
		model += metodoListar(nombre_modelo)
		model += metodoConsultar(nombre_modelo)
		model += metodoAgregar(nombre_modelo)
		model += metodoModificar(nombre_modelo)
		model += metodoEliminar(nombre_modelo)
		
		model += nl+'}'+nl+'?>'
		
		archivo.write(model)
		#print campos
		
	
except ValueError:
	print "opción no válida, ingrese valores númericos(1-2)"

	
