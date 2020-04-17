<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset($_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}else{
			
			$enlaces = "registro";
			
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}
	
	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroUsuarioController(){
		
		if(isset($_POST['usuario'])){
		
			$datosController = array(
				'user' => $_POST['usuario'],
				'password' => $_POST['password'],
				'email' => $_POST['email'],
				'd_create' => date("Y-m-d H:i:s")
			);
			
			$respuesta = Datos::registroUsuarioModel($datosController, 'users');
			
			if($respuesta == "success"){
				
				header("location:index.php?action=ok");
				
			}
		}
		
	}
}

?>
