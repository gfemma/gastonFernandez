var evResult = new cEval;
var frmData = new cFormSend({
    file: 'checkData',
    content: 'formulario',
    onFinish: function(a,b,c,d){
        evResult.Eval(c);
        if(typeof evResult.Result.ok != 'undefined' && typeof evResult.Result.next != 'undefined'){
            window.location.href = window.location.protocol+"//"+window.location.host+"/"+evResult.Result.next;
        }
    }
});

var frmDataGet = new cFormSend({
    file: 'checkData',
    content: 'formulario',
    type: 'GET',
    onFinish: function(a,b,c,d){
        evResult.Eval(c);
        if(typeof evResult.Result.ok != 'undefined' && typeof evResult.Result.next != 'undefined'){
            window.location.href = window.location.protocol+"//"+window.location.host+"/"+evResult.Result.next;
        }
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
        clearOptions('localidad');
        addOption('localidad', {'text':'Seleccionar localidad...',disabled: true,selected: true});
        clearOptions('ciudad');
        addOption('ciudad', {'text':'Selecciona una localidad',disabled: true,selected: true});
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

function obtenerCiudades(self, from = 0){
    var localidades = document.getElementById("localidad");
    var localidad_id = localidades.value;
    ajax({
        file: 'obtenerCiudades',
        content: 'paises',
        extraparams: {
            localidad: localidad_id,
            from: from
        }
    }, function(a,b,c,d){
        var select = document.getElementById("ciudad");
        if(select){
            console.log(from);
            if(from == 0){
                console.log("Clear!");
                clearOptions('ciudad');
                addOption('ciudad', {'text':'Seleccionar ciudad...',disabled: true,selected: true});
                while(select.childElementCount > 1){
                    select.children[1].remove();
                }
            }
            evResult.Eval(c);
            var added = false;
            if(typeof evResult.Result != 'undefined'){
                if(typeof evResult.Result.ciudades != 'undefined'){
                    for(d of evResult.Result.ciudades){
                        added = true;
                        addOption("ciudad", {value: d.id, text: d.nombre});
                    }
                    if(typeof evResult.Result.more != 'undefined'){
                        obtenerCiudades(null,evResult.Result.more);
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

    if(typeof values.selected != 'undefined'){
        option.setAttribute("selected", true);
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

function sendFormData(id, type = 'POST'){
    var frm = document.getElementById(id);
    if(frm == null){
        console.log("Elemento no encontrado");
        return;
    }
    var result = checkFormData(frm);
    if(!result){
        return;
    }

    if(type.toUpperCase() == 'GET'){
        frmDataGet.send(frm);
    }else{
        frmData.send(frm);
    }
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
