var evResult = new cEval;
var frmData = new cFormSend({
    file: 'checkData',
    content: 'formulario',
    onFinish: function(a,b,c,d){
        evResult.Eval(c);
    }
});

function obtenerPaises(){
    ajax({
        file: 'obtenerPaises',
        content: 'paises'
    }, function(a,b,c,d){
        var select = document.getElementById("pais");
        clearOptions("localidades");
        if(select){
            while(select.childElementCount > 1){
                select.children[1].remove();
            }
            evResult.Eval(c);
            var added = false;
            if(typeof evResult.Result != 'undefined'){
                if(typeof evResult.Result.Paises != 'undefined'){
                    for(d of evResult.Result.Paises){
                        added = true;
                        addOption("pais", {value: d.id, text: d.nombre});
                    }
                }
            }
            if(!added){
                addOption("pais", 
                    {
                        text: 'No se pudo obtener la lista de paises',
                        disabled: true
                    });
            }else{
                select.addEventListener("change", obtenerLocalidades);
            }
        }
    });
}

function obtenerLocalidades(){
    ajax({
        file: 'obtenerLocalidades',
        content: 'paises',
        extraparams: {
            pais: this.value
        }
    }, function(a,b,c,d){
        var select = document.getElementById("localidad");
        clearOptions('ciudad');
        addOption('ciudad', {'text':'Selecciona una localidad'});
        if(select){
            while(select.childElementCount > 1){
                select.children[1].remove();
            }
            evResult.Eval(c);
            var added = false;
            if(typeof evResult.Result != 'undefined'){
                if(typeof evResult.Result.localidades != 'undefined'){
                    for(d of evResult.Result.localidades){
                        added = true;
                        addOption("localidad", {value: d.id, text: d.nombre});
                    }
                }
            }
            if(!added){
                addOption("localidad", 
                    {
                        text: 'No se pudo obtener la lista de localidades',
                        disabled: true
                    });
            }else{
                select.addEventListener("change", obtenerCiudades);
            }
        }
    });
}

function obtenerCiudades(){
    ajax({
        file: 'obtenerCiudades',
        content: 'paises',
        extraparams: {
            localidad: this.value
        }
    }, function(a,b,c,d){
        var select = document.getElementById("ciudad");
        clearOptions('ciudad');
        addOption('ciudad', {'text':'Selecciona una localidad'});
        if(select){
            while(select.childElementCount > 1){
                select.children[1].remove();
            }
            evResult.Eval(c);
            var added = false;
            if(typeof evResult.Result != 'undefined'){
                if(typeof evResult.Result.ciudades != 'undefined'){
                    for(d of evResult.Result.ciudades){
                        added = true;
                        addOption("ciudad", {value: d.id, text: d.nombre});
                    }
                }
            }
            if(!added){
                addOption("ciudad", 
                    {
                        text: 'No se pudo obtener la lista de ciudades',
                        disabled: true
                    });
            }
        }
    });
}

function addOption(id, values){
    var select = document.getElementById(id);
    if(select == null || typeof values != 'object'){
        return;
    }

    if(typeof values.value == 'undefined' && typeof values.text == 'undefined'){
        return;
    }

    var option = document.createElement("option");
    if(typeof values.value != 'undefined'){
        option.setAttribute("value", values.value);
    }

    if(typeof values.text != 'undefined'){
        option.innerHTML = values.text;
    }

    if(typeof values.disabled != 'undefined'){
        option.setAttribute("disabled", true);
    }

    select.appendChild(option);
}

function clearOptions(id){
    var select = document.getElementById(id);
    if(select == null){
        return;
    }

    while(select.childElementCount > 0){
        select.children[0].remove();
    }
}

function sendFormData(id){
    var frm = document.getElementById(id);
    if(frm == null){
        console.log("Elemento no encontrado");
        return;
    }
    var result = checkFormData(frm);
    if(!result){
        return;
    }

    frmData.send(frm);
}

function checkFormData(frm){
    var result = true;
    if(frm == null){
        console.log("Elemento no encontrado");
        return;
    }

    if(frm.nodeName != 'FORM'){
        console.log("El elemento no es un formulario");
        return;
    }

    var ele = frm.nombre;
    if(ele.value.trim() == ''){
        result = $(ele).msgerr("Debes colocar tú nombre");
    }

    ele = frm.apellido;
    if(ele.value.trim() == ''){
        result = $(ele).msgerr("Debes colocar tú apellido");
    }

    ele = frm.dni;
    if(ele.value.trim() == ''){
        result = $(ele).msgerr("Debes colocar tú DNI");
    }

    ele = frm.fechanac;
    if(ele.value.trim() == ''){
        result = $(ele).msgerr("Debes colocar tú fecha de nacimiento");
    }

    ele = frm.email;
    if(ele.value.trim() == ''){
        result = $(ele).msgerr("Debes colocar tú fecha de email");
    }

    ele = frm.pais;
    if(ele.value == -1){
        result = $(ele).msgerr("Debes seleccionar tú país");
    }

    ele = frm.localidad;
    if(ele.value == -1){
        result = $(ele).msgerr("Debes seleccionar tú localidad");
    }

    ele = frm.terminos;
    if(ele.checked === false){
        result = $(ele).msgerr("Debes aceptar los terminos y condiciones");
    }
    return result;
}

window.onload = function(){
    obtenerPaises();
}
