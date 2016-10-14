<?php
class formulariosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {        
        $explorador = new Explorador();
        
        $dir = 'views/';
        $carpeta = Array();
        
        if(is_dir($dir))
        {
            /*Abrimos directorio*/
            if ($dh = opendir($dir)) 
            {
                /*Recorremos directorio*/
                while (($file = readdir($dh)) !== false) 
                {
                    if($file[0] != "." && $file != "layout" && $file != "denegado" && $file != "index" && $file != "formularios")
                    {
                        $carpeta[$file]["nombre"] = $file;
                        $carpeta[$file]["max_elemento"] = 0;
                        if ($dh2 = opendir($dir.$file)) 
                        {
                            $carpeta[$file]["datos"] = Array();
                            while (($arc = readdir($dh2)) !== false) 
                            {
                                if(is_file($dir.$file.'/'. $arc))
                                {                                                                        
                                    $campos = $explorador->leer_archivo($dir.$file.'/'. $arc);                                                                        
                                    array_push($carpeta[$file]["datos"], Array("archivo" => str_replace(".phtml", "", $arc) , "elementos" => count((array)$campos)));
                                    if(count((array)$campos) > $carpeta[$file]["max_elemento"])
                                    {
                                        $carpeta[$file]["max_elemento"] = count((array)$campos) ;
                                    }
                                }
                            }
                        }
                    }                   
                }
                closedir($dh);
            }
        }
        
        $this->_view->elementos = $carpeta;        
        $this->_view->render('lista');
    }       
    
    public function actionEditar($carpeta , $archivo)
    {
        $explorador = new Explorador();
        $ruta_archivo = "views/$carpeta/$archivo.phtml";                
        $elementos = $explorador->leer_archivo($ruta_archivo);
        
        if(count($_REQUEST) > 1)
        {                                    
            OrigenCampo::eliminarCampos($carpeta , $archivo);            
            foreach ($_REQUEST as $key => $value) 
            {      
                $tip_dat = $value["tip_dat"];
                if(is_array($value))
                {       
                    foreach ($value as $index => $val) 
                    {                                                       
                        if(isset($val["val"]) && isset($val["msg"]) && !empty($val["msg"]) && $index != 'tip_dat')
                        {      
                            switch ($index) 
                            {
                                case "regex":
                                    $index = "data-validation-regex-regex";
                                    break;                       
                                case "callback":
                                    $index = "data-validation-callback-callback";
                                    break;                       
                                case "ajax":
                                    $index = "data-validation-ajax-ajax";
                                    break;                       
                                case "maxchecked":
                                    $index = "data-validation-maxchecked-maxchecked";
                                    break;                       
                                case "minchecked":
                                    $index = "data-validation-minchecked-minchecked";
                                    break;                                               
                            }    
                            Validacione::agregarValidaciones($carpeta , $archivo, $key , $val["val"] , $val["msg"] , $index , $tip_dat);
                        }
                    }
                }            
            }
        }

        $tipos_datos = Array();
        foreach ($elementos as $key => $value) 
        {            
            
            $dato = OrigenCampo::consultarTipoCampo($key);            
            
            if($dato->id_tipo_dato)
            {
                $tipos_datos[$key] = Array();
                array_push($tipos_datos[$key], $dato->id_tipo_dato);                
            }
            
            $value->validaciones = Array();                        
            $Validaciones = OrigenCampo::consultarCampo($key);
            
            if($Validaciones)
            {                
                foreach ($Validaciones as $val) 
                {                    
                    array_push($value->validaciones , (object) Array("tip" => $val->cod_att_val,"val" => $val->val_att_val_cam,"msg" =>$val->val_msg_val_cam));                
                }                
            }                        
        }
        
        $this->_view->tipo_campo = $tipos_datos;        
        $this->_view->tipo_dato = TiposDato::consultarTipoDato();
        $this->_view->controlador = $carpeta;        
        $this->_view->metodo = $archivo;        
        $this->_view->elementos = $elementos;                    
        $this->_view->render('editar');        
    }
}
?>
