// Validar registro

function validarRegistro(){
	
	var usuario = document.querySelector("#usuarioRegistro").value;
	var password = document.querySelector("#passwordRegistro").value;
	var email = document.querySelector("#emailRegistro").value;
	var terminos = document.querySelector("#terminos").checked;
	
	/* Validar usuario */
	if(usuario != ""){
		
		var caracteres = usuario.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres > 6){
			
			document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o menos.</i>";
			
			return false;
		}
		
		if(!expresion.test(usuario)){
			
			document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar contraseña */
	if(password != ""){
		
		var caracteres = password.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres < 6){
			
			document.querySelector("label[for='passwordRegistro']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o más.</i>";
			
			return false;
		}
		
		if(!expresion.test(password)){
			
			document.querySelector("label[for='passwordRegistro']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar email */
	if(email != ""){
		
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(!expresion.test(email)){
			
			document.querySelector("label[for='emailRegistro']").innerHTML += "<br><i style='color:red;'>Escriba correctamente el Email.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar términos */
	if(!terminos){
		
		document.querySelector("form").innerHTML += "<br><i style='color:red;'>No se logró el registro, acepte términos y condiciones!</i>";
		// Reescritura de datos para no tener que volver a escribirlos todos 
		// si falla el registro.
		document.querySelector("#usuarioRegistro").value = usuario;
		document.querySelector("#passwordRegistro").value = password;
		document.querySelector("#emailRegistro").value = email;
		
		return false;
		
	}
	
	return true;

}

// Fin validar registro
