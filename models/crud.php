<?php 

require_once "conexion.php";

class Datos extends Conexion{
	
	#REGISTRO DE USUARIOS
	#-----------------------------------------------------------------------------
	public function registroUsuarioModel($datosModel, $tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql incluyéndole varios marcadores de parámetro
		#Los marcadores de parámetro se pueden indicar mediante nombre (:name) o mediante signo de interrogación (?)
		#bindParam(): vincula las variables de php a los distintos marcadores de parámetro
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(user, password, email, d_create) VALUES (:user,:password,:email,:d_create)");
		
		$stmt->bindParam(":user", $datosModel['user'], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel['password'], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
		$stmt->bindParam(":d_create", $datosModel['d_create'], PDO::PARAM_STR);
		
		if($stmt->execute()){
			
			return "success";
			
		}else{
		
			return "error";
		
		}
		
		$stmt->close();  // Cerrar conexión

	}
	
	#INGRESO DE USUARIO
	#-----------------------------------------------------------------------------
	public function ingresoUsuarioModel($datosModel, $tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql incluyéndole varios marcadores de parámetro
		#Los marcadores de parámetro se pueden indicar mediante nombre (:name) o mediante signo de interrogación (?)
		#bindParam(): vincula las variables de php a los distintos marcadores de parámetro
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		#fetch(): obtiene el registro resultante de la consulta
		
		$stmt = Conexion::conectar()->prepare("SELECT id, user, password, email, d_create, d_update FROM $tabla WHERE user = :user");
		
		$stmt->bindParam(":user", $datosModel['user'], PDO::PARAM_STR);
		
		$stmt->execute();
		
		return $stmt->fetch();
		
		$stmt->close();  // Cerrar conexión

	}
	
	#LISTA DE USUARIOS
	#-----------------------------------------------------------------------------
	public function listaUsuariosModel($tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		#fetchAll(): obtiene todos los registros resultantes de la consulta
		
		$stmt = Conexion::conectar()->prepare("SELECT id, user, password, email, d_create, d_update FROM $tabla");
		
		$stmt->execute();
		
		return $stmt->fetchAll();
		
		$stmt->close();  // Cerrar conexión

	}
	
	#BUSCAR USUARIO
	#-----------------------------------------------------------------------------
	public function buscarUsuarioModel($datosModel, $tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql incluyéndole varios marcadores de parámetro
		#Los marcadores de parámetro se pueden indicar mediante nombre (:name) o mediante signo de interrogación (?)
		#bindParam(): vincula las variables de php a los distintos marcadores de parámetro
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		#fetch(): obtiene el registro resultante de la consulta
		
		$stmt = Conexion::conectar()->prepare("SELECT id, user, password, email, d_create, d_update FROM $tabla WHERE id = :id");
		
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		
		$stmt->execute();
		
		return $stmt->fetch();
		
		$stmt->close();  // Cerrar conexión

	}
	
	#EDICIÓN DE USUARIOS
	#-----------------------------------------------------------------------------
	public function editarUsuarioModel($datosModel, $tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql incluyéndole varios marcadores de parámetro
		#Los marcadores de parámetro se pueden indicar mediante nombre (:name) o mediante signo de interrogación (?)
		#bindParam(): vincula las variables de php a los distintos marcadores de parámetro
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET user=:user, password=:password, email=:email WHERE id=:id");
		
		$stmt->bindParam(":user", $datosModel['user'], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel['password'], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel['id'], PDO::PARAM_INT);
		
		if($stmt->execute()){
			
			return "success";
			
		}else{
		
			return "error";
		
		}
		
		$stmt->close();  // Cerrar conexión

	}
	
	#BORRAR USUARIO
	#-----------------------------------------------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla){
		
		#Para insertar los datos usamos los métodos propios de PDO
		#Estos métodos ya se encargan de realizar la limpieza de los datos
		#prepare(): prepara la consulta sql incluyéndole varios marcadores de parámetro
		#Los marcadores de parámetro se pueden indicar mediante nombre (:name) o mediante signo de interrogación (?)
		#bindParam(): vincula las variables de php a los distintos marcadores de parámetro
		#execute(): ejecuta la consulta y retorna un booleano (true o false)
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");
		
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		
		if($stmt->execute()){
			
			return "success";
			
		}else{
		
			return "error";
		
		}
		
		$stmt->close();  // Cerrar conexión

	}

}

?>
