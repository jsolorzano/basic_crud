// Validar ingreso al sistema

function validarIngreso(){
	
	var usuarioIngreso = document.querySelector("#usuarioIngreso").value;
	var passwordIngreso = document.querySelector("#passwordIngreso").value;
	
	/* Validar usuario */
	if(usuarioIngreso != ""){
		
		var caracteres = usuarioIngreso.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres > 6){
			
			document.querySelector("label[for='usuarioIngreso']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o menos.</i>";
			
			return false;
		}
		
		if(!expresion.test(usuarioIngreso)){
			
			document.querySelector("label[for='usuarioIngreso']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar contraseña */
	if(passwordIngreso != ""){
		
		var caracteres = passwordIngreso.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres < 6){
			
			document.querySelector("label[for='passwordIngreso']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o más.</i>";
			
			return false;
		}
		
		if(!expresion.test(passwordIngreso)){
			
			document.querySelector("label[for='passwordIngreso']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	return true;

}

// Fin validar ingreso al sistema
