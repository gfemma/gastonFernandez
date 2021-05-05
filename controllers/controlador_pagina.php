<?php
    //Compruebo si la vista existe
    if(!$controlador->buscarVista($url)){
        require_once(DIR_controllers."controlador_404.php");
        return;
    }
    //Obtengo el menu (si es que hay)
    $menu = new cMenu("menu.json");
    if(!isset($menu->erorMsg)){
        $menu->getElements();
        $menu->getParentElements();
        if($menu->hasChildrends($controlador->padre)){
            if($menu->getConfigs($controlador->alias, $controlador->padre)){
                $controlador->configs = $menu->configs;
            }
        }else{
            if($menu->getConfigs($controlador->padre)){
                $controlador->configs = $menu->configs;
            }
        }
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