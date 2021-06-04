function Sumar(){
	var result = document.getElementById("resultado");
	var numero1 = document.getElementById("numero1").value;
	var numero2 = document.getElementById("numero2").value;
	if(result){
		result.innerHTML = "El resultado aparecera aquí"
	}

	if(numero1.trim() == ''){
		alert("Debes ingresar un valor en el primer recuadro.");
		return;
	}

	if(numero2.trim() == ''){
		alert("Debes ingresar un valor en el segundo recuadro.");
		return;
	}

	numero1 = parseInt(numero1);
	numero2 = parseInt(numero2);
	if(isNaN(parseInt(numero1))){
		alert("El primer valor debe ser un número.");
		return;
	}

	if(isNaN(parseInt(numero2))){
		alert("El segundo valor debe ser un número.");
		return;
	}

	var resultado = numero1 + numero2;
	if(result){
		result.innerHTML = "El resultado es: " + resultado;
	}else{
		alert("El resultado es: " + resultado);
	}

}