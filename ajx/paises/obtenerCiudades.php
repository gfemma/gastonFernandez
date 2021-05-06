<?php
/**
 * Archivo para obtener todas las ciudades almacenados de la DB
 */
    require_once(DIR_class."geo".DS."class.geo_ciudades.inc.php");
    $geo = new cGeociudades;
    $post = CleanArray($_POST);

    $id = SecureInt(@$post['localidad']);
    if(is_null($id)){
        EmitError("Debes seleccionar una localidad primero.");
        return;
    }

    $from = SecureInt(@$post['from']);
    if(is_null($from)){
        $from = 0;
    }

    $geo->localidad_id = $id;
    if(!$rs = $geo->Listar($from)){
        EmitError("No se pudo obtener la lista de ciudades");
        return;
    }

    if(!CanUseArray($rs)){
        EmitError("No se pudo obtener la lista de ciudades");
        return;
    }

    $listado = array();
    do{
        $listado[] = array(
            'nombre' => $rs['Nombre'],
            'id' => $rs['id']
        );
    }while($rs = $geo->Siguiente());
    
    $reg = array(
        'ciudades'=>$listado
    );
    
    if(isset($geo->getMore) AND $geo->getMore == true){
        $reg['more'] = $from+1;
    }


    ResponseOk($reg);
?>