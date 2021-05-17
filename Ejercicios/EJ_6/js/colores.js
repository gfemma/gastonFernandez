function checkColor(self){
    if(self.id == 'fondo'){
        var body = document.querySelector("body");
        var colores = ["red", "green", "blue"];
        var color = self.value;
        if(colores.indexOf(color) == -1){
            color = 'red';
        }
        if(body){
            body.setAttribute("style", "background-color: "+color);
        }
    }else{
        var colores = ["white", "black", "yellow"];
        var color = self.value;
        if(colores.indexOf(color) == -1){
            color = 'white';
        }
        var all = document.querySelectorAll("h1,h2,h3");
        for(var d of all){
            d.setAttribute("style","color: "+color);
        }
    }
}