//Ahora un ajax con jquery

function envioJquery(){

    var formulario = document.getElementById("datos");
    if(formulario != null){
        var nombre = formulario.nombre;
        if(nombre.value.trim() == ''){
            alert("El nombre no puede estar vacío.");
            return;
        }

        var apellido = formulario.apellido;
        if(apellido.value.trim() == ''){
            alert("El apellido no puede estar vacío.");
            return;
        }

        var edad = formulario.edad;
        if(edad.value.trim() == ''){
            alert("Edad no puede estar vacío.");
            return;
        }
    
        if(isNaN(parseInt(edad.value))){
            alert("Edad debe ser un número.");
            return;
        }

        //Agrego los datos a un formData para enviarlos
        var valores = new FormData;
        valores.append("nombre", nombre.value);
        valores.append("apellido", apellido.value);
        valores.append("edad", edad.value);

        var estado = $.ajax({
            type: "POST",//De que tipo es la petición
            url: "ajax/procesarDatos.php",//A que archivo voy
            processData: false,//Esto es para que no se coloquen los datos como string 
            contentType: false,//Esto es para que no haya ningún problema con FormData
            data: valores
        }).done(function(respuesta){//Aquí es cuando finaliza el ajax
            var datos = document.getElementById("datosProcesados");
            if(datos != null){
                datos.innerHTML = respuesta;
            }
            // Or
            $("#datosProcesados").html(respuesta);
        });

        estado.always(()=>{// Esto es lo mismo que .done, con la diferencia de que esta apartado del ajax
            console.log(estado);
            console.log("El ajax a finalizado");
            //estado.responseText; <- esta propiedad contiene el texto de respuesta del ajax, es decir lo que devuelve el archivo .php
        });
    }
}