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
		
		if(isset($_POST['usuarioRegistro'])){
		
			$datosController = array(
				'user' => $_POST['usuarioRegistro'],
				'password' => $_POST['passwordRegistro'],
				'email' => $_POST['emailRegistro'],
				'd_create' => date("Y-m-d H:i:s")
			);
			
			$respuesta = Datos::registroUsuarioModel($datosController, 'users');
			
			if($respuesta == "success"){
				
				header("location:index.php?action=ok");
				
			}
		}
		
	}
	
	#INGRESO DE USUARIOS
	#-------------------------------------
	public function ingresoUsuarioController(){
		
		if(isset($_POST['usuarioIngreso'])){
		
			$datosController = array(
				'user' => $_POST['usuarioIngreso'],
				'password' => $_POST['passwordIngreso']
			);
			
			$respuesta = Datos::ingresoUsuarioModel($datosController, 'users');
			
			if($respuesta['user'] == $_POST['usuarioIngreso'] && $respuesta['password'] == $_POST['passwordIngreso']){
				
				// Iniciamos sesión y creamos una varible de sesión
				session_start();
				
				$_SESSION['validar'] = true;
			
				header("location:index.php?action=usuarios");
			
			}else{
			
				header("location:index.php?action=fallo");
			
			}
			
		}
		
	}
	
	#LISTA DE USUARIOS
	#-------------------------------------
	public function listaUsuariosController(){
		
		$respuesta = Datos::listaUsuariosModel('users');
		
		foreach($respuesta as $respuesta){
		
			echo '<tr>
					<td>'.$respuesta['user'].'</td>
					<td>'.$respuesta['password'].'</td>
					<td>'.$respuesta['email'].'</td>
					<td><button>Editar</button></td>
					<td><button>Borrar</button></td>
				</tr>';

		}
		
	}
}

?>
