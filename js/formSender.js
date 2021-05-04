class cFormSend{
    constructor(params){
        this.file = null;
        this.content = null;
        this.type = 'POST';
        this.onFinish = null;
        
        var ajaxFile = params.file;
        if(typeof ajaxFile != 'string'){
            console.log("No se a que archivo ir");
            return;
        }

        var ajaxContent = params.content;
        if(typeof ajaxContent == 'string'){
            this.content = ajaxContent;
        }
        var ajaxType = params.type;
        if(typeof ajaxType == 'string' && ajaxType.search(/post|get/i) != -1){
            this.type = ajaxType.toUpperCase();
        }
        this.file = ajaxFile;

        if(typeof params.onFinish == 'function'){
            this.onFinish = params.onFinish;
        }
    }

    send(data, callback = null){
        if(!this.file){
            return;
        }

        var frm = data;
        if(frm == null){
            console.log("No tengo nada que enviar");
            return;
        }

        if(frm.nodeName != 'FORM'){
            console.log("Solo funciono con formularios");
            return;
        }

        var elements = frm.querySelectorAll("[name]");

        var params = {};
        if(elements.length > 0){
            for(var d of elements){
                var value = false;
                if(d.type == 'checkbox'){
                    value = d.checked;
                }else{
                    value = d.value;
                }
                params[d.name] = value;
            }
        }
        if (typeof callback == 'function'){
            this.onFinish = callback;
        }
        ajax({
            file: this.file,
            content: this.content,
            type: this.type,
            extraparams: params
        }, this.onFinish);
    }
}
