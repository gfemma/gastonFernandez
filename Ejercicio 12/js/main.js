function ObtenerDatos(){
    var dataToSend = {};

    var url = "https://randomuser.me/api";
   fetch(url, {
        method: "GET"
    }).then(data => {//Aquí agarro la respuesta como un json directamente...
        data.text().then(text => {
            //Ahora veo si el json puede ser convertido en un objeto utilizable
            var datos = null;
            if(text.search(/^\{["\w"]+,?.*\}$/igm) != -1){//Es una forma muy basica pero funcional de válidar un string tipo json
                datos = JSON.parse(text);
                datos = (typeof datos.results[0] != 'undefined')? datos.results[0]:null;
                if(datos != null){
                    dataToSend["genero"] = (typeof datos.gender != 'undefined')? datos.gender:null;
                    dataToSend["email"] = (typeof datos.email != 'undefined')? datos.email:null;
                    dataToSend["edad"] = (typeof datos.dob.age != 'undefined')? datos.dob.age:null;
                    dataToSend["telefono"] = (typeof datos.phone != 'undefined')? datos.phone:null;
                    dataToSend["celular"] = (typeof datos.cell != 'undefined')? datos.cell:null;
                    dataToSend["nombre"] = (typeof datos.name.first != 'undefined')? datos.name.first:null;
                    dataToSend["apellido"] = (typeof datos.name.last != 'undefined')? datos.name.last:null;
                    dataToSend["imagen"] = (typeof datos.picture.large != 'undefined')? datos.picture.large:null;
                    dataToSend["pais"] = (typeof datos.location.country != 'undefined')? datos.location.country:null;
                    dataToSend["estado"] = (typeof datos.location.state != 'undefined')? datos.location.state:null;
                    dataToSend["latitud"] = (typeof datos.location.coordinates.latitude != 'undefined')? datos.location.coordinates.latitude:null;
                    dataToSend["longitud"] = (typeof datos.location.coordinates.longitude != 'undefined')? datos.location.coordinates.longitude:null;
                }
            }else{
                console.log("El texto de respuesta al parecer no es un string JSON");
            }

            //Ahora se envia estos datos por ajax a un PHP que se haga cargo del resto....
            sendData(dataToSend);
        });
    }).catch(error => console.log("Hubo un error en la petición: "+error));
}

function sendData(data){
    if(typeof data != 'object'){
        console.log("Data no es un objeto"); return;
    }
    
    if(data.length == 0){
        console.log("Data no tiene elementos"); return;
    }

    var formdata = new FormData;
    for(var d in data){
        formdata.append(d,data[d]);
    }

    fetch("ajax/procesarDatos.php",{
        method: 'POST',
        body: formdata
    }).then(data => {
        data.text().then(text => {
            console.log(text);
        });
    }).catch(erro => console.log(error));
}