<?php

class Herramientas {

    function __construct() {}
    
    public function trim_array($data)
    {
        foreach ($data as $key => $value) 
        {
            $data[$key] = trim($value);
        }
        
        return $data;
    }
    
    public function object_to_array($data)
    {
        if((! is_array($data)) and (! is_object($data)))
        {
            return $data;
        }

        $result = array();

        $data = (array) $data;
        foreach ($data as $key => $value) 
        {
            if (is_object($value))
            {
                $value = (array) $value;
            }
            
            if (is_array($value)) 
            {
                $result[$key] = $value;
            }
            else
            {
                $result[$key] = $value;
            }
        }

        return $result;
    }
    
    public function obtener_atributos($data)
    {
        if(is_array($data) && !is_object($data))
        {
            $campos = Array();
            foreach ($data as $key => $value) 
            {
                array_push($campos, (object) $value->attributes());            
            }
        }
        else if(!is_array($data) && is_object($data))
        {
            $campos = $data->attributes();        
        }
        
        return  (object)$campos;
    }
    
    public function transformarDatosValidos($arreglo)
    {        
        if(is_array($arreglo))
        {
            $total_datos = count(current($arreglo));
            $registro = Array();
            $i = 0;
            for ($index = 0; $index < $total_datos; $index++) 
            {
                $registro[$index] = Array();
                foreach ($arreglo as $key => $value) 
                {
                    if(is_array($value))
                    {
                        $registro[$index][$key] = $value[$i];
                    }
                    else
                    {
                        $registro[$index][$key] = $value;
                    }
                }
                $i++;
            }
            
            return $registro;
        }
        else
        {
            die("no es un arreglo válido");
        }
    }
    
    public function fechaPostgres($fecha)
    {
        $fecha_tmp = explode("/", $fecha);
        $fecha = $fecha_tmp[2]."-".$fecha_tmp[1]."-".$fecha_tmp[0];
        return  $fecha;
    }
    
    public function debug($data)
    {
        if(DEBUG)
        {
            print "<pre>";
            var_dump($data);
            print "</pre><br>";
        }
    }
    
    
    public function eliminarCamposVacios($data)
    {
        if(is_array($data))
        {
            foreach ($data as $key => $value) 
            {
                if(!empty($value))
                {
                    $campo[$key] = $value;
                }
            }
            return $campo;
        }
    }
    
    public function soloNumerico($data)
    {
        $respuesta = false;
        $patrón = '/^[0-1]{1}(\,|\.)[0-9]{1,2}$/';
        preg_match($patrón, $data, $coincidencias);
        if($coincidencias)
        {
            $respuesta = true;
        }
        
        return $respuesta;
    }
    
    public function soloNumeros($valor)
    {
        return preg_match("/^[0-9]*$/", $valor);
    }
    
    public function soloValoresSeparadosConPuntos($valor)
    {
        return preg_match("/^[0-9]*[\.]*[0-9]*$/", $valor);
    }
    
    public function soloValoresAlfanumericos($valor)
    {
        return preg_match("/^[A-Za-z0-9]*$/", $valor);
    }
    
    public function soloLetras($valor)
    {
        return preg_match("/^[a-zA-Z]*$/", $valor);
    }
    
    public function soloLetrasConEspacios($valor)
    {
        return preg_match("/^[a-zA-Z\s]*$/", $valor);
    }
    
    public function soloMayusculas($valor)
    {
        return preg_match("/^[A-Z]*$/", $valor);
    }
    
    public function soloMinusculas($valor)
    {
        return preg_match("/^[a-z]*$/", $valor);
    }
    
    public function validaciones($datos = Array(), $validaciones = Array())
    {
        if(is_array($datos))
        {
            foreach ($datos as $key => $value) 
            {   
                if(isset($validaciones[$key]["NULL"]) && !$validaciones[$key]["NULL"])
                {
                    if(is_null($value) || $value == "")
                    {
                        $errores[] = "-El campo: '".$validaciones[$key]["nombre"]."' No puede estar vácio o NULO.";
                    }
                    
                    if($value == "0")
                    {
                        $errores[] = "-Debe seleccionar un opción en el campo: '".$validaciones[$key]["nombre"].".";
                    }
                }
                /*
                if(isset($validaciones[$key]["SELECT"]))
                {
                    if($value == "0")
                    {
                        $errores[] = "-Debe seleccionar un opción en el campo: '".$validaciones[$key]["nombre"].".";
                    }
                }
                */
                if(isset($validaciones[$key]["longitud"]))
                {
                    if(strlen($value) > $validaciones[$key]["longitud"])
                    {
                        $errores[] = "-El campo: '".$validaciones[$key]["nombre"]."' excede el límite de caracteres permítidos.";
                    }
                }
                
                if(isset($validaciones[$key]["expReg"]))
                {
                    if(!is_array($value))
                    {
                        if($value != "" && $value != "0" && !is_null($value))
                        {
                            if(!Herramientas::$validaciones[$key]["expReg"]($value))
                            {
                                $tmp1 = substr($validaciones[$key]["expReg"], 0 , 4);
                                $tmp2 = substr($validaciones[$key]["expReg"], 4 , strlen($validaciones[$key]["expReg"]));
                                $cadena = str_split($tmp2);  
                                $c = 0;
                                foreach ($cadena as $v) 
                                {                     
                                    if(Herramientas::soloMayusculas($v))
                                    {
                                        $c++;
                                        $r[$c] .= $v;
                                    }
                                    else
                                    {
                                        $r[$c] .= $v;
                                    }
                                }
                                $tmp = $tmp1." ".  join(" ", $r);
                                $errores[] = "-El campo: '".$validaciones[$key]["nombre"]."' permite ".$tmp.".";
                            }
                        }
                    }
                    else
                    {
                        foreach ($value as $val) 
                        {
                            if($val != "" && $val != "0" && !is_null($val))
                            {
                                if(!Herramientas::$validaciones[$key]["expReg"]($val))
                                {
                                    $tmp1 = substr($validaciones[$key]["expReg"], 0 , 4);
                                    $tmp2 = substr($validaciones[$key]["expReg"], 4 , strlen($validaciones[$key]["expReg"]));
                                    $tmp = $tmp1." ".$tmp2;
                                    $errores[] = "-El campo: '".$validaciones[$key]["nombre"]."' permite ".$tmp.".";
                                }
                            }
                        }
                    }
                }
            }
            
            return ($errores)?$errores:true;
        }
        else
        {
            die("ERROR: Se esperaba un arreglo.");
        }
    }
    
    public function eliminarCoincidencias($arregloP, $indiceP , $arregloS , $indiceS)
    {
        $nuevo_arreglo = Array();
        foreach ($arregloP as $keyP => $valueP) 
        {   
            $existe = false;
            foreach ($arregloS as $keyS => $valueS) 
            {
                if($valueP->$indiceP == $valueS->$indiceS)
                {
                    $existe = true;
                }
            }
            
            if(!$existe)
            {
                array_push($nuevo_arreglo, $valueP);
            }
        }
        return $nuevo_arreglo;
    }
}

?>