<?php
    //Compruebo si la vista existe
    if(!$controlador->buscarVista($url)){
        require_once(DIR_controllers."controlador_404.php");
        return;
    }
    //Coloco las cabeceras
    require_once(DIR_plantillas."headers.htm");
    //Coloco la barra de navegación
    require_once(DIR_menus."navBar.htm");

    //Coloco la vista
    require_once($controlador->vista);

    //Coloco el footer
    require_once(DIR_plantillas."footer.htm");
?>