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
					<td><a href="index.php?action=editar&id='.$respuesta['id'].'"><button>Editar</button></a></td>
					<td><button>Borrar</button></td>
				</tr>';

		}
		
	}
	
	#BUSCAR USUARIO
	#-------------------------------------
	public function buscarUsuarioController(){
		
		$user_id = $_GET['id'];
		
		$respuesta = Datos::buscarUsuarioModel($user_id, 'users');
		
		echo '<input type="text" value="'.$respuesta['user'].'" name="usuarioEditar" required>

			<input type="text" value="'.$respuesta['password'].'" name="passwordEditar" required>

			<input type="email" value="'.$respuesta['email'].'" name="emailEditar" required>

			<input type="hidden" name="id" value="'.$respuesta['id'].'">

			<input type="submit" value="Actualizar">';
		
	}
	
	#EDICIÓN DE USUARIOS
	#-------------------------------------
	public function editarUsuarioController(){
		
		if(isset($_POST['usuarioEditar'])){
		
			$datosController = array(
				'id' => $_POST['id'],
				'user' => $_POST['usuarioEditar'],
				'password' => $_POST['passwordEditar'],
				'email' => $_POST['emailEditar']
			);
			
			$respuesta = Datos::editarUsuarioModel($datosController, 'users');
			
			if($respuesta == "success"){
				
				header("location:index.php?action=edit_ok&id=".$_POST['id']);
				
			}
		}
		
	}
}

?>
