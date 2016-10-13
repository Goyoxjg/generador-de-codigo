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
		
	def consultarConstraint(self, tabla):
		sql = "SELECT tc.constraint_name, tc.constraint_schema || '.' || tc.table_name || '.' || kcu.column_name as physical_full_name,  tc.constraint_schema,tc.table_name, "
		sql += "kcu.column_name,ccu.table_name as foreign_table_name, ccu.column_name as foreign_column_name,tc.constraint_type "
		sql += "FROM information_schema.table_constraints as tc "
		sql += "join information_schema.key_column_usage as kcu on (tc.constraint_name = kcu.constraint_name and tc.table_name = kcu.table_name) "
		sql += "join information_schema.constraint_column_usage as ccu on ccu.constraint_name = tc.constraint_name "
		sql += "WHERE /*constraint_type in ('PRIMARY KEY','FOREIGN KEY') */constraint_type in ('FOREIGN KEY') "
		sql += "/*AND tc.constraint_schema = 'public'*/ AND tc.table_name like '%"+tabla+"%' AND ccu.table_name <> '"+tabla+"'"
		
		#print "\n\n SQL: %s \n\n"% sql
		
		return self.consultar(sql)
