#!/usr/bin/python
# -*- coding: utf-8 -*-


# aptitude install python-psycopg2
from modulos.GestorBD.gestorBaseDatos import*
import os

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
	
	host = "localhost"
	dbname = "framework"
	user = "postgres"
	passwd = "postgres"
		
	connBD = baseDatos(host,dbname,user,passwd)	
	
	
	crearEstructura()
	tablas = connBD.leerTablas()
	
	for tabla in tablas:				
		
		print tabla
		
		archivo = open("www/models/"+tabla[0]+'.php','w')	
		
		
		
		campos = []		
		for res in connBD.leerCamposTablas(tabla[0]):		
			
			nL = '\n'
			t1 = '\t'
			t2 = '\t\t'
			t3 = '\t\t\t'
			
			model = '<?php \nclass '+tabla[0]+' extends ActiveRecord\Model\n{\n'
			
			
			model += t1+'public function listar'+tabla[0]+'()'+nL+t1+'{'+nL+t2+'return '+tabla[0]+'::find(\'all\');'+nL+t1+'}\n\n'
			model += t1+'public function consultar'+tabla[0]+'($id)'+nL+t1+'{'+nL+t2+'return '+tabla[0]+'::find($id);'+nL+t1+'}\n\n'
			model += t1+'tpublic function agregar'+tabla[0]+'($data)'+nL+t1+'{'+nL+t2+'return '+tabla[0]+'::create($data);'+nL+t1+'}\n\n'
			model += t1+'public function modificar'+tabla[0]+'($data)'+nL+t1+'{'+nL+t2+'$objeto = '+tabla[0]+'::find($data[\'id\']);'+nL+t1+'\treturn $objeto->update_attributes($data);'+nL+t1+'}\n\n'
			model += t1+'public function eliminar'+tabla[0]+'($id)'+nL+t1+'{'+nL+t2+'$objeto = '+tabla[0]+'::find($data[\'id\']);'+nL+t1+'\treturn $objeto->delete();'+nL+t1+'}\n\n'
			
			
			
			
			
			
			
			model += '\n}\n?>'
							
			column_name = res[3]
			column_default = res[5],
			is_nullable = res[6],
			data_type = res[7]
			character_maximun = res[8]
			data_type = res[7]
			#tmp = {'column_name':res[3],'column_default':res[5],'is_nullable':res[6],'data_type':res[7]}
			#print res[3]
			#campos.append(tmp)			
		
		archivo.write(model)
		print campos
		
	
except ValueError:
	print "opción no válida, ingrese valores númericos(1-2)"

	
