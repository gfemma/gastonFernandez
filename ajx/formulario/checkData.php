<?php
/**
 * Con este archivo controlo que los datos sean correctos y no falte ninguno
 */
    require_once(DIR_class."geo".DS."class.geo_paises.inc.php");
    require_once(DIR_class."geo".DS."class.geo_localidades.inc.php");
    require_once(DIR_class."geo".DS."class.geo_ciudades.inc.php");
    $paises = new cGeoPaises;
    $localidades = new cGeoLocalidades;
    $ciudades = new cGeoCiudades;

    $msgerr = array();
    $data = CleanArray($_REQUEST);
    
    $nombre = @$data['nombre'];
    if(empty($nombre)){
        $msgerr['nombre'] = 'Debes colocar un nombre';
    } 

    $apellido = @$data['apellido'];    
    if(empty($apellido)){
        $msgerr['apellido'] = 'Debes colocar un apellido';
    } 

    $dni = @$data['dni'];
    if(empty($dni)){
        $msgerr['dni'] = 'Debes colocar un DNI';
    }

    if(!cCheck::dni($dni)){
        $msgerr['dni'] = 'El DNI ingresado no es válido';
    }

    $fechanac = @$data['fechanac'];
    if(empty($fechanac)){
        $msgerr['fechanac'] = 'Debes indicar tu fecha de nacimiento';
    }

    if(!cFechas::looksLikeDate($fechanac) AND !isset($msgerr['fechanac'])){
        $msgerr['fechanac'] = 'La fecha ingresada no es válida';
    }
    
    if($fechanac > cFechas::Ahora() AND !isset($msgerr['fechanac'])){
        $msgerr['fechanac'] = '¡Wow! Eres del futuro';
    }

    $email = @$data['email'];
    if(empty($email)){
        $msgerr['email'] = 'Debes ingresar un email';
    } 

    if(!cCheck::email($email)){
        $msgerr['email'] = 'El email ingresado no es válido';
    }

    $pais = SecureInt(@$data['pais']);
    if(is_null($pais)){
        $msgerr['pais'] = 'Debes Seleccionar un país';
    }

    if(!$paises->Get($pais)){
        $msgerr['pais'] = 'El país que seleccionaste no existe en nuestro sistema';
    }

    $localidad = SecureInt(@$data['localidad']);
    if(is_null($localidad)){
        $msgerr['localidad'] = 'Debes seleccionar una localidad';
    }

    if(!$localidades->Get($localidad)){
        $msgerr['localidad'] = 'La localidad que seleccionaste no existe en nuestro sistema';
    }

    $ciudad = SecureInt(@$data['ciudad']);
    if(!is_null($ciudad)){
        if(!$ciudades->Get($ciudad)){
            $msgerr['localidad'] = 'La localidad que seleccionaste no existe en nuestro sistema';
        } 
    }else{
        // $msgerr['ciudad'] = 'Debes seleccionar una ciudad';
    }
  
    $donante = @$data['donante'];
    if($donante == 'false' or !$donante){
        $donante = false;
    }else{
        $donante = true;
    }

    $terminos = boolval(@$data['terminos']);
    if(!is_bool($terminos) or $terminos === false){
        $msgerr['terminos'] = 'Debes aceptar los terminos y condiciones';
    } 

    if(CanUseArray($msgerr)){
        EmitError($msgerr);
        return;
    }

    $reg = array(
        'nombre' => $nombre,
        'apellido' => $apellido,
        'dni' => $dni,
        'fechanac' => $fechanac,
        'email' => $email,
        'pais' => $paises->nombre,
        'localidad' => $localidades->nombre,
        'ciudad' => @$ciudades->Nombre,
        'donante' => $donante,
        'terminos' => $terminos
    );
    $reg = json_decode(json_encode($reg));

    if(isset($_SESSION)){
        if(!isset($_SESSION['user_data'])){
            $_SESSION['user_data'] = new stdClass;
        }
        if($controlador->method == 'POST'){
            $_SESSION['user_data']->post = $reg;
        }else{
            $_SESSION['user_data']->get = $reg;
        }
    }
    ResponseOk(['next'=>"formularios/ver-datos"]);
?>