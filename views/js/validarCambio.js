// Validar edición de usuarios

function validarCambio(){
	
	var usuarioEditar = document.querySelector("#usuarioEditar").value;
	var passwordEditar = document.querySelector("#passwordEditar").value;
	var emailEditar = document.querySelector("#emailEditar").value;
	//~ var terminosEditar = document.querySelector("#terminos").checked;
	
	/* Validar usuario */
	if(usuarioEditar != ""){
		
		var caracteres = usuarioEditar.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres > 6){
			
			document.querySelector("label[for='usuarioEditar']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o menos.</i>";
			
			return false;
		}
		
		if(!expresion.test(usuarioEditar)){
			
			document.querySelector("label[for='usuarioEditar']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar contraseña */
	if(passwordEditar != ""){
		
		var caracteres = passwordEditar.length;
		var expresion = /^[a-zA-Z0-9]*$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(caracteres < 6){
			
			document.querySelector("label[for='passwordEditar']").innerHTML += "<br><i style='color:red;'>Escriba por favor 6 caracteres o más.</i>";
			
			return false;
		}
		
		if(!expresion.test(passwordEditar)){
			
			document.querySelector("label[for='passwordEditar']").innerHTML += "<br><i style='color:red;'>No escriba caracteres especiales.</i>";
			
			return false;
			
		}
		
	}
	
	/* Validar email */
	if(emailEditar != ""){
		
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		// Decimos que se permitan caracteres de la 'a' a la 'z', de la 'A' a la 'Z'
		// y dígitos del 0 (cero) al 9. (/^) indica la apertura de la expresión regular
		// mientras que (*$/) indica el cierre de dicha expresión.
		
		if(!expresion.test(emailEditar)){
			
			document.querySelector("label[for='emailEditar']").innerHTML += "<br><i style='color:red;'>Escriba correctamente el Email.</i>";
			
			return false;
			
		}
		
	}
	
	//~ /* Validar términos */
	//~ if(!terminos){
		
		//~ document.querySelector("form").innerHTML += "<br><i style='color:red;'>No se logró el registro, acepte términos y condiciones!</i>";
		//~ // Reescritura de datos para no tener que volver a escribirlos todos 
		//~ // si falla el registro.
		//~ document.querySelector("#usuarioEditar").value = usuario;
		//~ document.querySelector("#passwordEditar").value = password;
		//~ document.querySelector("#emailEditar").value = email;
		
		//~ return false;
		
	//~ }
	
	return true;

}

// Fin validar edición de usuarios
