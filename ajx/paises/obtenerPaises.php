<?php
/**
 * Archivo para obtener todos los paises almacenados de la DB
 */
    require_once(DIR_class."geo".DS."class.geo_paises.inc.php");
    $geo = new cGeoPaises;

    if(!$rs = $geo->Listar()){
        EmitError("No se pudo obtener la lista de países");
        return;
    }

    if(!CanUseArray($rs)){
        EmitError("No se pudo obtener la lista de países");
        return;
    }

    $listado = array();
    do{
        $listado[] = array(
            'nombre' => $rs['nombre'],
            'id' => $rs['id']
        );
    }while($rs = $geo->Siguiente());

    ResponseOk(["Paises"=>$listado]);
?>