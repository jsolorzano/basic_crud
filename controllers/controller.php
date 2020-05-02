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
			
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioRegistro']) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordRegistro']) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['emailRegistro']))
			{
				echo "Aquí";
			
				#crypt(): devolverá el hash de un string utilizando el algoritmo
				#estándar basado en DES de Unix o algoritmos alternativos que puedan
				#estar disponibles en el sistema.
				
				$encriptar = crypt($_POST['passwordRegistro'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$datosController = array(
					'user' => $_POST['usuarioRegistro'],
					'password' => $encriptar,
					'email' => $_POST['emailRegistro'],
					'd_create' => date("Y-m-d H:i:s")
				);
				
				$respuesta = Datos::registroUsuarioModel($datosController, 'users');
				
				if($respuesta == "success"){
					
					header("location:ok");
					
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
			{
				
				$encriptar = crypt($_POST['passwordIngreso'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		
				$datosController = array(
					'user' => $_POST['usuarioIngreso'],
					'password' => $encriptar
				);
				
				$respuesta = Datos::ingresoUsuarioModel($datosController, 'users');
				
				$intentos = $respuesta['intentos'];
				
				$usuario = $_POST['usuarioIngreso'];
				
				$maximoIntentos = 3;
				
				if($intentos < $maximoIntentos){
				
					if($respuesta['user'] == $_POST['usuarioIngreso'] && $respuesta['password'] == $encriptar){
						
						// Iniciamos sesión y creamos una varible de sesión
						session_start();
						
						// Reiniciamos el contador de intentos (al ingresar)
						$intentos = 0;
					
						$datosController = array(
							'usuarioActual' => $usuario,
							'actualizarIntentos' => $intentos
						);
						
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "users");
						
						$_SESSION['validar'] = true;
					
						header("location:usuarios");
					
					}else{
						
						// Aumentamos el contador de intentos (al fallar)
						$intentos++;
						
						$datosController = array(
							'usuarioActual' => $usuario,
							'actualizarIntentos' => $intentos
						);
						
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "users");
					
						header("location:fallo");
					
					}
					
				}else{
					
					// Reiniciamos el contador de intentos (al fallar 3 veces)
					$intentos = 0;
					
					$datosController = array(
						'usuarioActual' => $usuario,
						'actualizarIntentos' => $intentos
					);
					
					$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "users");
					
					header("location:fallo3intentos");
					
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
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST['emailEditar']))
			{
				
				#crypt(): devolverá el hash de un string utilizando el algoritmo
				#estándar basado en DES de Unix o algoritmos alternativos que puedan
				#estar disponibles en el sistema.
				
				$encriptar = crypt($_POST['passwordEditar'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		
				$datosController = array(
					'id' => $_POST['id'],
					'user' => $_POST['usuarioEditar'],
					'password' => $encriptar,
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
				
				header("location:usuarios");
				
			}

		}
		
	}
}
