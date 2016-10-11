#!/usr/bin/python
# -*- coding: utf-8 -*-

import psycopg2, psycopg2.extras

class baseDatos:
	
	def __init__(self,host,dbname,user,passwd):
		self.host = host
		self.dbname = dbname
		self.user = user
		self.passwd = passwd					
				
		self.conexion = self.conectarBDpostgres()		
		#return self.conexion
		
		
	def conectarBDpostgres(self):				
		try:
			return psycopg2.connect(database=self.dbname,user=self.user,password=self.passwd, host=self.host)
			print "Conexión a la base de datos exitosa"
		except:
			print "Error al conectar con la base de datos."
		
			
	def consultar(self,sql):			
		db = self.conexion.cursor()		
		db.execute(sql)		
		return db.fetchall()
		""""
		data = []
		for fila in filas:
			data.append(fila)			
		
		return data
		"""
	
	def leerTablas(self):
		sql = "SELECT table_name,table_schema FROM information_schema.tables WHERE table_schema <> 'pg_catalog' AND table_schema <> 'information_schema'"				
		return self.consultar(sql)

	def leerCamposTablas(self,tabla):
		sql = "SELECT * FROM information_schema.columns WHERE table_name =  '"+tabla+"'"				
		return self.consultar(sql)
