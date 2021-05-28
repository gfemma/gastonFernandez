var ajx = function(params, callback){
    var ajx = {};
    ajx.options = {
        content: '',
        file: '',
        type: 'POST',
        extraparams: null
    }

    ajx.callback = null;
    if(typeof params == 'object'){
        ajx.options = Object.assign({}, ajx.options,params);
        if(typeof params.extraparams == 'object'){
            ajx.options.extraparams = Object.assign({}, ajx.options.extraparams,params.extraparams);
        }else{
            ajx.options.extraparams = null;
        }
    }
    
    if(typeof callback == 'function'){
        ajx.callback = callback;
    }

    ajx.ExecCall = function(){
        ajx.options.type = ajx.options.type.toUpperCase();
        if(ajx.options.type.search(/post|get/i) == -1){
            ajx.options.type = 'POST';
        }
        var finalUrl = '';
        if(ajx.options.file == ''){
            console.log("No se a donde ir");
            return;
        }
        var formData = new FormData;
        if(ajx.options.type == 'GET'){
            if(ajx.options.content != ''){
                finalUrl = (ajx.options.content.search(/\/|\\$/) != -1)? ajx.options.content.replace(/\\*$/, "/"):ajx.options.content+"/";
            }
            finalUrl = "ajax/"+finalUrl+ajx.options.file;
            if(ajx.options.extraparams){
                var i = 0;
                var simbol = "?";
                for(d in ajx.options.extraparams){
                    if(i > 0){
                        simbol = "&";
                    }
                    finalUrl +=simbol+d+"="+ajx.options.extraparams[d];
                    i++;
                }
            }
        }else{
            finalUrl = "ajax/"
            formData.append("file", ajx.options.file);
            if(ajx.options.content != ''){
                var content = ajx.options.content.replace(/\\|\/$/, "");
                formData.append("content", content);
            }
            if(ajx.options.extraparams){
                for(d in ajx.options.extraparams){
                    formData.append(d, ajx.options.extraparams[d]);
                }
            }
        }
        finalUrl = window.location.origin+"/"+finalUrl;

        var finalOptions = {
            method: ajx.options.type
        };
        if(ajx.options.type == 'POST'){
            finalOptions.body = formData;
        }
        fetch(finalUrl, finalOptions)
        .then(data => {
            if(typeof ajx.callback == 'function'){
                data.text().then((text)=>{ ajx.callback(data.status, data.statusText,text); });
            }
        })
        .catch(error => console.log("Error on fetch: "+error));
    }
    ajx.ExecCall();
} 
