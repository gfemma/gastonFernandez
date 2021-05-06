<?php
    session_start();
    require_once("init.php");
    $controlador = new cControllers;
    $url = array();
    //Busco la url solicitadad
    if(!isset($_SERVER['REDIRECT_URL']) or empty($_SERVER['REDIRECT_URL'])){
        $_SERVER['REDIRECT_URL'] = '/formularios/post'; 
    }
    $url = explode("/",$_SERVER['REDIRECT_URL']);
    //La primera posición del array siempre esta vacía, asi que la quito
    array_shift($url);

    if(in_array(strtolower($url[0]), $file_alias)){
        $control = array_shift($url);
        require_once(DIR_controllers."controlador_".strtolower($control).".php");
        return;
    }

    //Desactivo el cache de la página
    header("Expires: 1");//En cuanto tiempo expira el cache
    header("Pragma: no-cache");//Sin cache
    header("Cache-Control: no-cache, must-revalidate");//Sin cache
    //A partir de aca que se encargue el controlador
    require_once(DIR_controllers."controlador_pagina.php");
?>