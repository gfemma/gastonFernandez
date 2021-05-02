class cEval{
    Eval(str){
        if(str.search(/^\{["\w"]+:["\w"]+,?.*\}$/igm) != -1){
            var test = JSON.parse(str);
            this.Result = test;
        }else{
            this.error = "Json mal formado"; 
        }
    }
}