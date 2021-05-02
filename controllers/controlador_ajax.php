<?php
    if(!$controlador->ProcesarAjax($url)){
        EmitError("Archivo inexistente");
        return;
    }

    require_once($controlador->ajaxFile);
?>