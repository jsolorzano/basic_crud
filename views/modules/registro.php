<h1>REGISTRO DE USUARIO</h1>

<form method="post" onsubmit="return validarRegistro()">
	
	<label for="usuarioRegistro">Usuario</label>
	<input type="text" placeholder="Mínimo 6 caracteres" maxlength="6" name="usuarioRegistro" id="usuarioRegistro" required>

	<label for="passwordRegistro">Contraseña</label>
	<input type="password" placeholder="Mínimo 6 caracteres, incluir " name="passwordRegistro" id="passwordRegistro" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">

	<label for="emailRegistro">E-mail</label>
	<input type="email" placeholder="Escriba su correo electrónico" name="emailRegistro" id="emailRegistro" required>
	<!-- 
	Se debe escribir al menos 6 caracteres, entre los que debe haber al menos un número,
	una letra minúscula y una letra mayúscula. Y no debe haber caracteres especiales.
	 -->
	 
	<p style="text-align:center">
		<input type="checkbox" id="terminos">
		<a href="#">Acepta términos y condiciones</a>
	</p>

	<input type="submit" value="Enviar">

</form>

<?php

$registro = new MvcController();
$registro->registroUsuarioController();

if(isset($_GET['action'])){
	
	if($_GET['action'] == "ok"){
	
		echo "Registro exitoso";
	
	}
	
}

?>
