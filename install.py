#!/usr/bin/python
# -*- coding: utf-8 -*-


# aptitude install python-psycopg2
from modulos.GestorBD.gestorBaseDatos import*

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
		
	
	
	tablas = connBD.leerTablas()
	
	for tabla in tablas:
		archivo = open("www/models/"+tabla[0]+'.php','w')	
		linea = "Esta es mi primera línea\n"	
		archivo.write(linea)
		
		print connBD.leerCamposTablas(tabla[0])
	
	
	
	
except ValueError:
	print "opción no válida, ingrese valores númericos(1-2)"

	
