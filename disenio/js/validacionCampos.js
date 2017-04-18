function solonumeros(e) {
	key = e.keyCode || e.which;

	teclado = String.fromCharCode(key);

	numeros = "0123456789.";

	especiales = "8-37-38-46-9-116-37-93-39"; // array

	teclado_especial = false;

	for ( var i in especiales) {
		if (key == especiales[i]) {
			teclado_especial = true;
		}
	}
	
	if (numeros.indexOf(teclado) == -1 && !teclado_especial) {
		alert("Solo se permiten números.");
		return false;
	}
}

function cedulaDigitos()
{
	if(document.getElementById("cedula").value.length > 10)
	{
		alert("La cédula debe contener 10 dígitos.");
	}
}


function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-38-46-9-116-37-93-39";

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
   	{
    	alert("Solo se puede ingresar letras.");
    	return false;
   	}
        
}


function guardar() {
    //code
	alert("Datos se almacenarán correctamente.");
}

$(document).ready(function(){
  	$("#guardar").click(function(){
  	    alert("Datos almacenados correctamente.");
  	});
});