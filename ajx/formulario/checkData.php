<?php
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

    $fechanac = @$data['fechanac'];
    if(empty($fechanac)){
        $msgerr['fechanac'] = 'Debes indicar tu fecha de nacimiento';
    } 

    $email = @$data['email'];
    if(empty($email)){
        $msgerr['email'] = 'Debes ingresar un email';
    } 

    $pais = SecureInt(@$data['pais']);
    if(is_null($pais)){
        $msgerr['pais'] = 'Debes Seleccionar un país';
    }

    $localidad = SecureInt(@$data['localidad']);
    if(is_null($localidad)){
        $msgerr['localidad'] = 'Debes seleccionar una localidad';
    } 

    $ciudad = SecureInt(@$data['ciudad']);
    if(is_null($ciudad)){
        $msgerr['ciudad'] = 'Debes seleccionar una ciudad';
    } 
  
    $donante = boolval(@$data['donante']);
    if(!is_bool($donante)){
        $donante = false;
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
        'pais' => $pais,
        'localidad' => $localidad,
        'ciudad' => $ciudad,
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
    ResponseOk();
?>