window.onload = function(){
    var textarea = document.getElementById("texto");
    if(textarea){
        textarea.addEventListener("dblclick", AlertaTexto);
    }
}

function AlertaTexto(){
    if(this.value.trim() == ''){
        alert("El textarea esta vacío");
    }else{
        alert(this.value);
    }
}