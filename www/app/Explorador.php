<?php
class Explorador extends Controller
{
    //protected $_view;
    private $_carpeta;
    private $_archivo;
    public $_validaciones;

    public function __construct($carpeta = FALSE , $archivo = FALSE)
    {        
        if (substr($archivo , 0, 6) == "action") 
        {
            $archivo = substr($archivo, 6);
        }
        else
        {
            $archivo = $archivo;
        }

        if($carpeta && $archivo)
        {            
            if((isset($carpeta) && !empty($carpeta)) &&
            (isset($archivo) && !empty($archivo)))
            {
                $this->_carpeta = $carpeta;
                $this->_archivo = $archivo;
            }

            $dir = 'views'. DS . $this->_carpeta . DS ;

            $dir_file = $this->retorna_archivo($dir , $archivo);

            if($dir_file)
            {
                $campos = $this->leer_archivo($dir_file);
                foreach ($campos as $value) 
                {                                    
                    $validacion = OrigenCampo::consultarCampoControladorMetodo($value->id_cam , $carpeta , $archivo);
                    if($validacion)
                    {
                        $value->atributos = Array();
                        foreach ($validacion as $val) 
                        {
                            array_push($value->atributos, Array(
                                                                "att" => $val->cod_att_val , 
                                                                "val" => $val->val_att_val_cam,
                                                                "att_msg" => $val->cod_msg_val , 
                                                                "val_msg" => $val->val_msg_val_cam
                                                                ));
                        }
                    }
                    else
                    {
                        $value->atributos = Array();
                    }                
                }       
            }
            $this->_validaciones = $campos;
        }
        else
        {
            $this->_validaciones = NULL;   
        }
    }
    
    private function retorna_archivo($dir , $archivo)
    {
        /*Validamos si es directorio*/
        if(is_dir($dir))
        {
            /*Abrimos directorio*/
            if ($dh = opendir($dir)) 
            {
                /*Recorremos directorio*/
                while (($file = readdir($dh)) !== false) 
                {
                    /*Buscamos el archivo indicado*/
                    $patrón = "/^$archivo.[a-z]*$/";                    
                    /*Extraemos coincidencias*/
                    preg_match($patrón, $file, $coincidencias);
                    
                    /*Validamos existencia de coincidencias*/
                    if(count($coincidencias) > 0)
                    {
                        $archivo = current($coincidencias);
                    }                                        
                }
                closedir($dh);
            }
            
            return $dir .= $archivo ;
        }
        else
        {
            return false;
        }
    }

    public function leer_archivo($ruta_archivo)
    {                  
        //print $ruta_archivo."<br>";
        if(file_exists($ruta_archivo))
        {                   
            $file = fopen($ruta_archivo , 'r');
            $campos = Array();
            
            while(!feof($file))
            {
                $patron  = '/for="[a-zA-Z0-9_]*"/';
                $patron1 = '/>[a-zA-ZñÑáéíóúÁÉÍÓÚ\s-:&-><!;.\/º]*<\/label/';
                $patron2 = '/type="[a-zA-Z0-9_]*"|(select)|(textarea)/';                
                $patron3  = '/id="[a-zA-Z0-9_]*"/';
                
                $html = fgets($file);
                                
                preg_match($patron , $html , $id_label);                
                preg_match($patron1 , $html , $descripcion);                                
                preg_match($patron2 , $html , $tipo);
                preg_match($patron3 , $html , $id_elemento);                
                                    
                if(count($id_label) > 0) 
                {                          
                    $id_tmp = str_replace(Array('for=','"'), "", current($id_label));                    
                }
                
                if(count($descripcion) > 0) 
                {                                        
                    $descripcion_tmp = str_replace(Array('/label','>','<',':'), "", current($descripcion));
                }
                
                if(count($tipo) > 0 && count($id_elemento) > 0) 
                {                                        
                    $tipo_tmp = str_replace(Array('<','type=','"'), "", current($tipo));
                    $id_elemento_tmp = str_replace(Array('id=','"'), "", current($id_elemento));
                }
                
                if(($id_tmp == $id_elemento_tmp) && $descripcion_tmp && $tipo_tmp )
                {
                    $campos[$id_tmp] = (object) Array(
                                    "id_cam"  => $id_tmp,
                                    "des_cam" => $descripcion_tmp,
                                    "tip_cam" => $tipo_tmp                        
                                    );
                                         
                    unset($id_tmp);
                    unset($id_elemento_tmp);
                    unset($descripcion_tmp);
                    unset($tipo_tmp);
                }
            }
            fclose($file);    
        }
        else 
        {
            $campos = Array();
        }

        return (object) $campos;
    }
    
    public function listar_archivos($dir,$ext = false)
    {
        $lista = Array();
        /*Validamos si es directorio*/
        if(is_dir($dir))
        {
            /*Abrimos directorio*/
            if ($dh = opendir($dir)) 
            {
                /*Recorremos directorio*/
                while (($file = readdir($dh)) !== false) 
                {
                    if($file != "." && $file != "..")
                    {
                        if($ext)
                        {
                            $nombre = explode(".", $file);
                            $lista[$nombre[0]] = $file;
                        }
                        else 
                        {
                            $nombre = explode(".", $file);
                            array_push($lista, $nombre[0]);
                        }
                        
                    }                                                      
                }
                closedir($dh);
            }
            
            return $lista;
        }
        else
        {
            return false;
        }
    }
}
?>
