<?php

session_start();

// Validamos si se ha iniciado sesión para poder ingresar en esta página				
if(!$_SESSION['validar']){

	header("location:index.php?action=ingresar");
	
	exit();

}

?>

<h1>USUARIOS</h1>

<table border="1">
	
	<thead>
		
		<tr>
			<th>Usuario</th>
			<th>Contraseña</th>
			<th>Email</th>
			<th></th>
			<th></th>

		</tr>

	</thead>

	<tbody>
		
	<?php

	$usuarios = new MvcController();
	$usuarios->listaUsuariosController();
	$usuarios->borrarUsuarioController();

	?>

	</tbody>
	
</table>
