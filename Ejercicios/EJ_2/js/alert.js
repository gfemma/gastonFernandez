document.addEventListener("DOMContentLoaded", init);

function init(){
    var select = document.getElementById("MySelect");
    if(select){
        var colores = ["Rojo","Verde","Azul"];
        for(var d of colores){
            var option = document.createElement("option");
            option.setAttribute("value", d);
            option.innerHTML = d;
            select.appendChild(option);
        }
    }
}

function checkColor(self){
    alert(self.value);
}