function EnviarDatos(){
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
        var data = new FormData;
        data.append("nombre", nombre.value);
        data.append("apellido", apellido.value);
        data.append("edad", edad.value);

        //Ahora hago el ajax
        var ajax = new XMLHttpRequest;
        ajax.open("POST", "ajax/procesarDatos.php");
        ajax.onreadystatechange = function(){
            if(this.readyState == 4){//Este estado significa que la petición ajax a finalizado
                var datos = document.getElementById("datosProcesados");
                if(datos != null){
                    datos.innerHTML = this.responseText;
                }
            }
        }
        ajax.send(data);
    } 
}