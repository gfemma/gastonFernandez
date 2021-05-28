<?php
/**
 * Archivo para obtener todas las localidades almacenados de la DB
 */
    require_once(DIR_class."geo".DS."class.geo_localidades.inc.php");
    $geo = new cGeoLocalidades;
    $post = CleanArray($_REQUEST);

    $id = SecureInt(@$post['pais']);
    if(is_null($id)){
        EmitError("Debes seleccionar un país primero.");
        return;
    }
    $geo->pais_id = $id;
    if(!$rs = $geo->Listar()){
        EmitError("No se pudo obtener la lista de localidades");
        return;
    }

    if(!CanUseArray($rs)){
        EmitError("No se pudo obtener la lista de localidades");
        return;
    }

    $listado = array();
    do{
        $listado[] = array(
            'nombre' => $rs['nombre'],
            'id' => $rs['id']
        );
    }while($rs = $geo->Siguiente());

    ResponseOk(["localidades"=>$listado]);
?>