<?php

session_start();

// Validamos si se ha iniciado sesión para poder ingresar en esta página				
if(!$_SESSION['validar']){

	header("location:index.php?action=ingresar");
	
	exit();

}

?>
<h1>EDITAR USUARIO</h1>

<form method="post">
	
	<?php

	$buscarUsuario = new MvcController();
	$buscarUsuario->buscarUsuarioController();

	?>

</form>

<?php

$edicion = new MvcController();
$edicion->editarUsuarioController();

if(isset($_GET['action'])){
	
	if($_GET['action'] == "edit_ok"){
	
		echo "Edición exitosa";
	
	}
	
}

?>


