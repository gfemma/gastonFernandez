<?php
    $data = $_REQUEST;
    
    $reg = array();

    $reg['nombre'] = (isset($data['nombre']))? $data['nombre']:null;
    $reg['apellido'] = (isset($data['apellido']))? $data['apellido']:null;
    $reg['edad'] = (isset($data['edad']))? $data['edad']:null;
    $reg['genero'] = (isset($data['genero']))? $data['genero']:null;
    $reg['email'] = (isset($data['email']))? $data['email']:null;
    $reg['telefono'] = (isset($data['telefono']))? $data['telefono']:null;
    $reg['celular'] = (isset($data['celular']))? $data['celular']:null;
    $reg['imagen'] = (isset($data['imagen']))? $data['imagen']:null;
    $reg['pais'] = (isset($data['pais']))? $data['pais']:null;
    $reg['estado'] = (isset($data['estado']))? $data['estado']:null;
    $reg['latitud'] = (isset($data['latitud']))? $data['latitud']:null;
    $reg['longitud'] = (isset($data['longitud']))? $data['longitud']:null;

    foreach($reg as $key => $value){
        if(empty($value)){
            $reg[$key] = "No encontrado";
        }
    }
//Ahora realizo la vista que ira dentro de la card
?>

