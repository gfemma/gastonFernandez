<?php
/**
 * Este archivo contiene funciones basicas que se pueden utilizar en todo el sitio
 */

    function ShowVar($param, $details = false){
        echo "<pre>";
        if($details){
            var_dump($param);
        }else{
            print_r($param);
        }
        echo "</pre>";
    }

    /**
     * Determina si un array tiene al menos 1 elemento que se pueda utilizar
     */
    function CanUseArray($array){
        if(!empty($array) AND is_array($array)){
            foreach($array as $value){
                if(!empty($value)){
                    return true;
                }
            }
        }
        $result = false;
    }

    /**
     * Determina si un archivo existe y se puede leer y escribir
     */
    function ExisteArchivo($file){
        return file_exists($file) AND is_readable($file) AND is_writable($file);
    }

    /**
     * Determina si un directorio existe
     */
    function ExisteDirectorio($dir){
        return (@opendir($dir))? true:false;
    }

    /**
     * A una ruta le cambia todos los slashes a DS
     */
    function AcomodarRuta($dir){
        return preg_replace("/(\/|\\\)*/", DS, $dir);
    }

    /**
     * Respuesta al ajax local
     */
    function ResponseOk($param = null){
        echo '{"ok":"ok"';
        $msg = "";
        if(CanUseArray($param)){
            foreach($param as $key => $value){
                if(is_array($value)){
                    $value = json_encode($value);
                    $tmpVal = ''.$value.'';
                }else{
                    $tmpVal = '"'.$value.'"';
                }
                
                $msg .= ',"'.$key.'":'.$tmpVal;
            }
        }
        echo $msg."}";
    }

    /**
     * Respuesta de error al ajax local
     */
    function EmitError($param = null){
        $final_msg = '{"msgerr":"Err"'; 
        $msg = "";
        if(CanUseArray($param)){
            foreach($param as $key => $value){
                if(is_array($value)){
                    $value = json_encode($value);
                    $tmpVal = ''.$value.'';
                }else{
                    $tmpVal = '"'.$value.'"';
                }
                
                $msg .= ',"'.$key.'":'.$tmpVal;
            }
        }else{
            if(!empty($param)){
                $final_msg = '{"msgerr":"'.$param.'"';
            }
        }
        echo $final_msg.$msg."}";
    }

    /**
     * Se fija que un número sea realmente un número, de lo contrario devuelve null
     */
    function SecureInt($value){
        $result = null;
        if(preg_match("/^[0-9]+$/", $value)){
            $result = $value;
        }
        return $result;
    }

    /**
     * Agrega los `` a un string
     */
    function SQLQuote($string){
        $result = false;
        if(!empty($string)){
            $result = $string;
            if($result[0] != "`"){
                $result = "`".$result;
            }
            if($result[strlen($result)-1] != "`"){
                $result = $result."`";
                
            }
        }
        return $result;
    }

    /**
     * Determina rapidamente si un string es un json
     */
    function IsJson($str){
        return preg_match('/\A\{.*?\}\Z/i',$str);
    }

    /**
     * Limpia un array quitando las posiciones vacias (omitiendo el 0 y el false)
     */
    function CleanArray($arr){
        $result = $arr;
        if(CanUseArray($result)){
            foreach($result as $key => $value){
                if(empty($value) AND $value !== 0 AND $value !== false){
                   unset($result[$key]); 
                }
            }
        }
        return $result;
    }
?>