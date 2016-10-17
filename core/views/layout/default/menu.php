<?php
    $acl = unserialize(Session::get('acl'));                
    $cont_perm = Session::get("cont_perm");
    
    function validarControlaodres($controladores)
    {
        $cont_perm = Session::get("cont_perm");
        if(is_array($controladores))
        {
            $cont = 0;
            foreach ($controladores as $value) 
            {
                if(in_array($value, $cont_perm))
                {
                    $cont++;
                }
            }        
            return ($cont > 0 )?true:false;
        }
        else 
        {
            if(in_array($controladores, $cont_perm))
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
    }
?>
<ul class="nav navbar-nav navbar-left">            
    <ul class="nav navbar-nav top-nav">
        <li class="" >
            <a href="<?=BASE_URL;?>" >
                <span class="glyphicon glyphicon-home"></span>&nbsp;Inicio
            </a>
        </li>
    </ul>
    <ul class="nav navbar-nav top-nav">
        <?php
        $controladores = Array("ordenvuelos","tiposistemas","grupos","planentrenamientos","misiones");
        if(validarControlaodres($controladores))
        {?>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="glyphicon glyphicon-"></span>&nbsp;Gestión Operacional
                <!--<span class="badge badge-info">&nbsp;5</span>-->
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <?php 
            if(in_array("ordenvuelos", $cont_perm))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Orden de Vuelos
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $permKey = 'ordenvuelos_crear';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'ordenvuelos/actionCrear';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Crear
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        $permKey = 'ordenvuelos_asignar';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'ordenvuelos/actionAsignar';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Asignar
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        $permKey = 'ordenvuelos_registrar';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'ordenvuelos/';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Registrar
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>
            <?php
            }?>
                
            <?php 
            if(in_array("tareaaereas", $cont_perm))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Tarea Aerea
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $permKey = 'tareaaereas_crear';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Crear
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        $permKey = 'tareaaereas_index';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Asignar
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>
            <?php
            }?>
            
            <?php 
            $controladores = Array("tiposistemas","grupos","planentrenamientos","misiones");
            if(validarControlaodres($controladores))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Gestión de Unidades
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        if(validarControlaodres("unidades"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'unidades/';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Tipo de Aviación
                            </a>
                        </li> 
                        <?php
                        }?>

                        <?php 
                        if(validarControlaodres("grupos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'grupos/';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Grupos Aéreos
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("planentrenamientos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'planentrenamientos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Plan de Entrenamiento
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("misiones"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'misiones';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Misiones
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("codigosmisiones"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'codigosmisiones';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Código de Misiones
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>                
            <?php
            }?>                        
            </ul>
        </li>
        <?php
        }?>
        
        <?php
        $controladores = Array("personal","reportes","cargos","componentes","clasificacionaereonauticas","cefas","parentescos","ausencias","cursos","academias","postgrados","certificados","dotaciones","academias");
        if(validarControlaodres($controladores))
        {?>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="glyphicon glyphicon-"></span>&nbsp;Gestión Personal
                <!--<span class="badge badge-info">&nbsp;5</span>-->
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <?php 
                $controladores = Array("personal");
                if(validarControlaodres($controladores))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'personal';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Personal Registrado
                    </a>
                </li> 
            <?php
            }?>
                
            <?php 
            if(validarControlaodres("reportes"))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Reportes
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $permKey = '';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . '';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Informe Ausencias
                            </a>
                        </li> 
                        <?php
                        }?>
                        <?php 
                        $permKey = '';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <!--<a href="<?=BASE_URL . 'reportes/actionConsultarDePersonalIndividual';?>">-->
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Registro de Personal
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        $permKey = 'reportes_consultardepersonalindividual';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <!--<a href="<?=BASE_URL . 'actionConsultarDePersonalIndividual';?>">-->
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Registro de Personal Individual
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>
            <?php
            }?>
                
            <?php 
            if(validarControlaodres("ordenvuelos"))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Parte Diario
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $permKey = 'ordenvuelos_crear';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Agregar
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        $permKey = 'ordenvuelos_crear';
                        if($acl->hasPermission($permKey))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'construccion';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Consultar
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>
            <?php
            }?>
            
            <?php 
            $controladores = Array("cargos","componentes","clasificacionaereonauticas","cefas","parentescos","ausencias","cursos","academias","postgrados","certificados","dotaciones","academias");
            if(validarControlaodres($controladores))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Config. de Listas
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        if(validarControlaodres("componentes"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'componentes';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Componentes
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("clasificacionaereonauticas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'clasificacionaereonauticas';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Clas. Aeronáutica
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("cefas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'cefas';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Cefa
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("parentescos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'parentescos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Parentescos
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("ausencias"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'ausencias';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Tipo de Ausencias
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("cursos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'cursos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Cursos
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("pregrados"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'pregrados';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Pregrados
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("postgrados"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'postgrados';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Postgrado
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("academias"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'academias';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Academias
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("certificados"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'certificados';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Certificados
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("dotaciones"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'dotaciones';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Dotaciones
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("cargos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'cargos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Cargos
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>                
            <?php
            }?>                        
            </ul>
        </li>
        <?php
        }?>
        
        <?php
        $controladores = Array("sistemas","tiposistemas","estaciones"."mantenimiento");
        if(validarControlaodres($controladores))
        {?>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="glyphicon glyphicon-"></span>&nbsp;Gestión Logística
                <!--<span class="badge badge-info">&nbsp;5</span>-->
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <?php 
            $controladores = Array("sistemas","tiposistemas","estaciones"."mantenimiento","condicionesmetereologicas","reglasvuelos","criteriodisponibilidadsistemas","tipoarmamentos","armamentos","tipocargas","despegues","aterrizajes","sensores","condicionesopcinales","ordenado","simbolomision","apoyo","condicionesvuelo","carga");
            if(validarControlaodres($controladores))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-plane"></span>&nbsp;Gestión de Sistemas
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        if(validarControlaodres("sistemas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'sistemas';?>">
                                <span class="glyphicon glyphicon-plane"></span>&nbsp;Sistemas
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("tiposistemas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'tiposistemas';?>">
                                <span class="glyphicon glyphicon-plane"></span>&nbsp;Tipos de Sistemas
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("estaciones"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'estaciones';?>">
                                <span class="glyphicon glyphicon-road"></span>&nbsp;Estaciones
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("mantenimiento"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'mantenimiento';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Mantenimiento
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>
            <?php
            }?>
                
            <?php 
            $controladores = Array("condicionesmetereologicas","reglasvuelos","criteriodisponibilidadsistemas","tipoarmamentos","armamentos","tipocargas","despegues","aterrizajes","sensores","condicionesopcinales","ordenado","simbolomision","apoyo","condicionesvuelo","carga");
            if(validarControlaodres($controladores))
            {?>
                <li class="dropdown-submenu">
                    <a href="#">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Config. de Listas
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        if(validarControlaodres("criteriodisponibilidadsistemas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'criteriodisponibilidadsistemas';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Criterio de disponibilidad de sistemas
                            </a>
                        </li> 
                        <?php
                        }?>
                    
                        <?php 
                        if(validarControlaodres("tipoarmamentos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'tipoarmamentos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Tipo de Armamento
                            </a>
                        </li> 
                        <?php
                        }?>
                    
                        <?php 
                        /*
                        if(validarControlaodres("armamentos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'armamentos';?>">
                                <span class="glyphicon glyphicon-screenshot"></span>&nbsp;Armamento
                            </a>
                        </li> 
                        <?php
                        }*/?>
                        
                        <?php 
                        if(validarControlaodres("tipocargas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'tipocargas';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Tipos de cargas
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("despegues"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'despegues';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Despegues
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("aterrizajes"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'aterrizajes';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Aterrizajes
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("sensores"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'sensores';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Sensores
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("condicionesvuelo"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'condicionesvuelo';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Condición de Luz
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("condicionesmetereologicas"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'condicionesmetereologicas';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Condiciones Metereologicas
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("reglasvuelos"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'reglasvuelos';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Reglas de Vuelo
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("condicionesopcinales"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'condicionesopcinales';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Condiciones de Vuelo Opcionales
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("ordenado"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'ordenado';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Ordenado Por
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("simbolomision"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'simbolomision';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Simbolo de la Misión
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("apoyo"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'apoyo';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Apoyo a
                            </a>
                        </li> 
                        <?php
                        }?>
                        
                        <?php 
                        if(validarControlaodres("carga"))
                        {?>
                        <li>
                            <a href="<?=BASE_URL . 'carga';?>">
                                <span class="glyphicon glyphicon-adjust"></span>&nbsp;Carga
                            </a>
                        </li> 
                        <?php
                        }?>
                    </ul>
                </li>                
            <?php
            }?>  
            </ul>
        </li>
        <?php
        }?>
        
        <?php
        $controladores = Array("usuarios","roles","permisos","formularios");
        if(validarControlaodres($controladores))
        {?>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="glyphicon glyphicon-"></span>&nbsp;Administrar
                <!--<span class="badge badge-info">&nbsp;5</span>-->
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <?php 
                if(validarControlaodres("usuarios"))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'usuarios';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Usuarios
                    </a>
                </li> 
            <?php
            }?>
            <?php 
                if(validarControlaodres("roles"))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'roles';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Roles
                    </a>
                </li> 
            <?php
            }?>
            <?php 
                if(validarControlaodres("permisos"))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'permisos';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Permisos 
                    </a>
                </li> 
            <?php
            }?>
            <?php 
                if(validarControlaodres("formularios"))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'formularios';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Formularios
                    </a>
                </li> 
            <?php
            }?>
            </ul>
        </li>
        <?php
        }?>
    </ul>
</ul>

<ul class="nav navbar-nav navbar-right">            
    <ul class="nav navbar-nav top-nav">
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="glyphicon glyphicon-user"></span>&nbsp;<?= Session::get("ape_usu")." ".Session::get("nom_usu");?>
                <!--<span class="badge badge-info">&nbsp;5</span>-->
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php 
                $permKey = 'usuarios_editar';
                if($acl->hasPermission($permKey))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'usuarios/actionConsultar/'.Session::get("id_usu");?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Consultar Perfil
                    </a>
                </li> 
                <?php
                }?>
                
                <?php 
                $permKey = 'contrasena_index';
                if($acl->hasPermission($permKey))
                {?>
                <li>
                    <a href="<?=BASE_URL . 'contrasena/';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Cambiar Contraseña
                    </a>
                </li> 
                <?php
                }?>
                
                <li>
                    <a href="<?=BASE_URL . 'salir/';?>">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;Cerrar Sessión
                    </a>
                </li> 
            </ul>
        </li>
    </ul>
</ul>