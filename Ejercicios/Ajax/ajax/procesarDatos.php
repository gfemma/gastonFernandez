<?php
    //Recordemos que $_REQUEST hace referencia a $_POST y $_GET
    //En este archivo procesamos los datos y los mostramos luego
    if(!isset($_REQUEST['nombre']) or empty($_REQUEST['nombre'])){//Preguntamos si existe el campo nombre y no esta vacío
        MostrarError("El nombre esta vacío.");
        return;
    }
    $nombre = $_REQUEST['nombre'];

    if(!isset($_REQUEST['apellido']) or empty($_REQUEST['apellido'])){//Preguntamos si existe el campo apellido y no esta vacío
        MostrarError("El apellido esta vacío.");
        return;
    }
    $apellido = $_REQUEST['apellido'];

    if(!isset($_REQUEST['edad']) or (empty($_REQUEST['edad']) AND $_REQUEST['edad'] != 0)){//Preguntamos si existe el campo edad y no esta vacío y es distinto de 0
        MostrarError("La edad esta vacía.");
        return;
    }
    $edad = intval($_REQUEST['edad']);//Hago que edad sea un número
    //Ahora válido que la edad sea un número entero
    if($edad <= 0){
        MostrarError("La edad debe ser mayor a 0.");
        return;
    }

    //Función para mostrar un mensaje de error básico
    function MostrarError($mensaje){ 
        if(empty($mensaje)){
            $mensaje = "No podemos mostrar tus datos, intentalo más tarde";
        }
        ?>
        <h4 class="texto-rojo"><?php echo $mensaje; ?></h4>
<?php
    }
    //Ahora muestro los datos en una lista
?>

<ul class="sin-iconos">
    <li>Tu nombre es: <span class="texto-verde"><?php echo $nombre; ?></span></li>
    <li>Tu apellido es: <span class="texto-verde"><?php echo $apellido; ?></span></li> 
    <li>Tu edad es: <span class="texto-verde"><?php echo $edad; ?></span></li> 
</ul>