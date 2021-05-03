class cEval{
    Eval(str){
        if(str.search(/^\{["\w"]+:["\w"]+,?.*\}$/igm) != -1){
            var test = JSON.parse(str);
            this.Result = test;
            if(typeof this.Result.msgerr != 'undefined'){
                this.setError();
            }
        }else{
            this.error = "Json mal formado"; 
        }
    }

    setError(){
        if(this.Result.length > 1){
            console.log(this.Result);
        }else{
            var prev = document.getElementById("msgerr");
            if(prev){
                prev.remove();
            }
            var modal = document.createElement("div");
            modal.setAttribute("id", "msgerr");
            modal.setAttribute("class", "modal");
            modal.setAttribute("role", "dialog");
            var doc = document.createElement("div");
            doc.setAttribute("class", "modal-dialog modal-dialog-centered");

            var content =  document.createElement("div");
            content.classList.add("modal-content");

            // Boton cerrar
            var head = document.createElement("div");
            head.classList.add("modal-header","border-0");
            var close = document.createElement("button");
            close.classList.add("close");
            close.setAttribute("data-dismiss", "modal")
            close.setAttribute("aria-label", "close")
            var span = document.createElement("span");
            span.setAttribute("aria-hidden", "true");
            span.innerHTML = "&times;"
            close.appendChild(span);
            head.appendChild(close);

            // Cuerpo
            var body = document.createElement("div");
            body.classList.add("modal-body","text-center");
            var p = document.createElement("p");
            p.classList.add("text-danger","font-weight-bold");
            p.innerHTML = this.Result.msgerr;
            body.appendChild(p);

            content.appendChild(head);
            content.appendChild(body);

            doc.appendChild(content);
            modal.appendChild(doc);
            modal.addEventListener("blur", function(){
                console.log("cerro");
            });

            var btn = document.createElement("button");
            btn.setAttribute("data-toggle", "modal");
            btn.setAttribute("data-target", "#msgerr");
            btn.setAttribute("type","button");
            
            var wrapper = document.querySelector(".contentWrapper");
            wrapper.appendChild(modal);
            wrapper.appendChild(btn);
            btn.click();
            btn.remove();
        }
    }
}
