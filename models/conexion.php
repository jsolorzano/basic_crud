<?php 

class Conexion{
	
	# Conexión a la base de datos
	public function conectar(){
		
		$link = new PDO("mysql:host=localhost;dbname=basic_crud","root","123456");
		
		return $link;

	}

}

?>
