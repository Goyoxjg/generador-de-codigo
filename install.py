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

		if os.path.isfile(ruta_core+elemento):
			ori = ruta_core+elemento
			des = ruta_destino+elemento
			if os.path.isfile(ori):
				#print "copiando %s"% des
				shutil.copyfile(ori,des)
		else:
			ori = ruta_core+elemento+"/"
			des = ruta_destino+elemento+"/"
			if os.path.exists(des):
				shutil.rmtree(des)
			if os.path.isdir(ori):
				shutil.copytree(ori,des)


	host = "localhost"
	dbname = "framework"
	user = "postgres"
	passwd = "postgres"

	connBD = baseDatos(host,dbname,user,passwd)
	boostrap = Boostrap()


	crearEstructura()
	tablas = connBD.leerTablas()
	totalVistas = 0

	for tabla in tablas:

		print tabla[0]
		nl = '\n'
		tab = '\t'

		nombreModelo = tabla[0].capitalize()

		modelo = open("www/models/"+nombreModelo+'.php','w')

		dirView = "www/view/"+tabla[0]+"/"
		if not os.path.exists(dirView):
			os.makedirs(dirView)

		totalCampos = connBD.leerCamposTablas(tabla[0])		
		while totalVistas < 4:
			boostrap.setTab(0)
			if totalVistas == 3:				
				vistaAgregar = open(dirView+'agregar.phtml','w')
				htmlAgregar = ""				
				camposColumna = 0				
				htmlCampos = boostrap.agregarTituloFormulario("Agregar",nombreModelo)
				
				for campo in totalCampos:					
					nombreCampo = campo[3]
					isNull = campo[6]
					tipoCampo = campo[7]
					maxLen = campo[8]
						
					pk = False
					patron = re.compile('nextval')
					if campo[5]:					
						if patron.match(campo[5]):
							pk = True
							
					if pk == False:
						if tipoCampo == "character varying" or tipoCampo == "integer" or tipoCampo == "time without time zone":
							htmlCampos += boostrap.agregarInput(tipoCampo,nombreCampo,nombreModelo,2)
						#elif :
							#tipo = "number"
						
					if camposColumna == 3:											
						camposColumna = -1
					
					camposColumna = camposColumna+1					
								
				htmlBotones =boostrap.agregarBotonera(tabla[0], "Agregar")								
				htmlCampos += htmlBotones						
				htmlForm = boostrap.crearFormulario(htmlCampos,3,tabla[0],"Agregar")							
				htmlAgregar += boostrap.crearCol(htmlForm, '8','2', 2)				
				htmlAgregar = boostrap.agregarFila()+boostrap.crearFila(htmlAgregar)
			elif totalVistas == 2:
				#print "creando vista Consultar, %s"% totalVistas
				vistaConsultar = open(dirView+'conusltar.phtml','w')
				htmlConsultar = ""				
				camposColumna = 0								
				htmlCampos = boostrap.agregarTituloFormulario("Consultar",nombreModelo)
				for campo in totalCampos:					
					nombreCampo = campo[3]
					isNull = campo[6]
					tipoCampo = campo[7]
					maxLen = campo[8]
									
					pk = False
					patron = re.compile('nextval')
					if campo[5]:					
						if patron.match(campo[5]):
							pk = True
							
					if pk == False:
						if tipoCampo == "character varying" or tipoCampo == "integer" or tipoCampo == "time without time zone":
							htmlCampos += boostrap.agregarInput(tipoCampo,nombreCampo,nombreModelo,2)
						#elif :
							#tipo = "number"
					
					if camposColumna == 3:											
						camposColumna = -1
					
					camposColumna = camposColumna+1
				
				htmlBotones =boostrap.agregarVolver(tabla[0], "Consultar")								
				htmlCampos += htmlBotones						
				htmlForm = boostrap.crearFormulario(htmlCampos,3,'',"")							
				htmlConsultar += boostrap.crearCol(htmlForm, '8','2', 2)				
				htmlConsultar = boostrap.agregarFila()+boostrap.crearFila(htmlConsultar)
			elif totalVistas == 1:
				#print "creando vista Editar, %s"% totalVistas
				vistaEditar = open(dirView+'editar.phtml','w')
				htmlEditar = ""
				camposColumna = 0				
				htmlCampos = boostrap.agregarTituloFormulario("Editar",nombreModelo)
				for campo in totalCampos:					
					nombreCampo = campo[3]
					isNull = campo[6]
					tipoCampo = campo[7]
					maxLen = campo[8]
									
					pk = False
					patron = re.compile('nextval')
					if campo[5]:					
						if patron.match(campo[5]):
							pk = True
							
					if pk == False:
						if tipoCampo == "character varying" or tipoCampo == "integer" or tipoCampo == "time without time zone":
							htmlCampos += boostrap.agregarInput(tipoCampo,nombreCampo,nombreModelo,2)
						#elif :
							#tipo = "number"
					
					if camposColumna == 3:											
						camposColumna = -1
					
					camposColumna = camposColumna+1
				htmlBotones =boostrap.agregarBotonera(tabla[0], "Editar")								
				htmlCampos += htmlBotones						
				htmlForm = boostrap.crearFormulario(htmlCampos,3,tabla[0],"Editar")							
				htmlEditar += boostrap.crearCol(htmlForm, '8','2', 2)				
				htmlEditar = boostrap.agregarFila()+boostrap.crearFila(htmlEditar)
			elif totalVistas == 0:
				#print "creando vista Listar, %s"% totalVistas
				vistaLista = open(dirView+'lista.phtml','w')
				htmlLista = ""

			totalVistas = totalVistas+1
		

		totalVistas = 0
		campos = []

		model = '<?php \nclass '+nombreModelo+' extends ActiveRecord\Model\n{\n'
		model += tab+'static $db = \''+tabla[1]+'\';'+nl*2
		model += tab+'static $table_name = \''+tabla[0]+'\';'+nl*2
		constraint = connBD.consultarConstraint(tabla[0])

		has_many = False
		c = len(constraint)
		if c:
			model += tab+"static $has_many = array("+nl

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

		#print "\n totalCampos: %s "% len(totalCampos)

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


		model += metodoListar(nombreModelo)
		model += metodoConsultar(nombreModelo)
		model += metodoAgregar(nombreModelo)
		model += metodoModificar(nombreModelo)
		model += metodoEliminar(nombreModelo)

		model += nl+'}'+nl+'?>'

		modelo.write(model)
		vistaAgregar.write(htmlAgregar)
		vistaConsultar.write(htmlConsultar)
		vistaEditar.write(htmlEditar)
		vistaLista.write(htmlLista)
		#print campos
		
		#print "Tab: %s" % boostrap.getTab()
		if boostrap.getTab() != 0:
			boostrap.setTab(0)
		#print "Tab: %s" % boostrap.getTab()
		#break

except ValueError:
	print "opción no válida, ingrese valores númericos(1-2)"


