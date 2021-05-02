<?php
    /**
     * Este archivo inicializa toda la configuración del sitio
     */
    $main_url = '';
    if(isset($_SERVER['REQUEST_SCHEME'])){
        $main_url = $_SERVER['REQUEST_SCHEME']."://";
    }

    if(isset($_SERVER['HTTP_HOST'])){
        $main_url .= $_SERVER['HTTP_HOST'];
    }

    require_once("directories.php");//Constantes de directorios
    require_once(DIR_includes."common.inc.php");
    require_once(DIR_config."siteConfig.php");
    require_once(DIR_config."config.php");
    require_once(DIR_config."databaseConfig.php");
    require_once(DIR_class."class.database.inc.php");
    require_once(DIR_class."class.controllers.inc.php");//Clase para el manejo de los controladores
?>