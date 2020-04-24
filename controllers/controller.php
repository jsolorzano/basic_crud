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
			
			#preg_match(): realiza una comparación con una expresión regular
			
			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST['usuarioRegistro']) && 
			   preg_match('/^[a-zA-Z0-9]*$/', $_POST['passwordRegistro']) &&
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST['emailRegistro'])
			){
		
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
		
	}
	
	#INGRESO DE USUARIOS
	#-------------------------------------
	public function ingresoUsuarioController(){
		
		if(isset($_POST['usuarioIngreso'])){
			
			#preg_match(): realiza una comparación con una expresión regular
			
			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST['usuarioIngreso']) && 
			   preg_match('/^[a-zA-Z0-9]*$/', $_POST['passwordIngreso']))
			){
		
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
					<td><a href="index.php?action=usuarios&idBorrar='.$respuesta['id'].'"><button>Borrar</button></a></td>
				</tr>';

		}
		
	}
	
	#BUSCAR USUARIO
	#-------------------------------------
	public function buscarUsuarioController(){
		
		$user_id = $_GET['id'];
		
		$respuesta = Datos::buscarUsuarioModel($user_id, 'users');
		
		echo '<label for="usuarioEditar">Usuario</label>
			<input type="text" placeholder="Mínimo 6 caracteres" maxlength="6" value="'.$respuesta['user'].'" name="usuarioEditar" id="usuarioEditar" required>
			
			<label for="passwordEditar">Contraseña</label>
			<input type="text" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" value="'.$respuesta['password'].'" name="passwordEditar" id="passwordEditar" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
			
			<label for="emailEditar">E-mail</label>
			<input type="email" placeholder="Escriba su correo electrónico" value="'.$respuesta['email'].'" name="emailEditar" id="emailEditar" required>
			
			<input type="hidden" name="id" value="'.$respuesta['id'].'">

			<input type="submit" value="Actualizar">';
		
	}
	
	#EDICIÓN DE USUARIOS
	#-------------------------------------
	public function editarUsuarioController(){
		
		if(isset($_POST['usuarioEditar'])){
			
			#preg_match(): realiza una comparación con una expresión regular
			
			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST['usuarioEditar']) && 
			   preg_match('/^[a-zA-Z0-9]*$/', $_POST['passwordEditar']) &&
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST['emailEditar'])
			){
		
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
	
	
	#BORRAR USUARIO
	#-------------------------------------
	public function borrarUsuarioController(){
		
		if(isset($_GET['idBorrar'])){
		
			$datosController = $_GET['idBorrar'];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, 'users');
			
			if($respuesta == "success"){
				
				header("location:index.php?action=usuarios");
				
			}

		}
		
	}
}

?>
