<?php
    $root = null;
    if(PHP_VERSION > "5.3"){
        $root = __DIR__;
    }else{
        $root = dirname(__FILE__);   
    }

    define("DS", DIRECTORY_SEPARATOR);
    define("DIR_root", $root.DS);
    //Directorios de archivos
    define("DIR_js", DIR_root."js".DS);
    define("DIR_css", DIR_root."css".DS);
    define("DIR_vistas", DIR_root."vistas".DS);
    define("DIR_system", DIR_root."system".DS);
    define("DIR_ajax", DIR_root."ajx".DS);
    
    //Directorios de system
    define("DIR_config", DIR_system."config".DS);
    define("DIR_includes",DIR_system."includes".DS);
    define("DIR_class", DIR_system."class".DS);

    //Directorios de vistas
    define("DIR_plantillas", DIR_vistas."plantillas".DS);
    define("DIR_paginas", DIR_vistas."paginas".DS);
    define("DIR_menus", DIR_vistas."menus".DS);

    //controladores
    define("DIR_controllers", DIR_root."controllers".DS);

    //Url's
    define("BASE_url", $main_url."/");
    define("URL_css", BASE_url."css/");
    define("URL_js", BASE_url."js/");

?>