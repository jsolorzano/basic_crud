<?php 

class Paginas{
	
	# Control de navegación
	public function enlacesPaginasModel($enlaces){
		
		$permitidos = array('ingresar','usuarios','editar','salir');  // Lista blanca
		
		if(in_array($enlaces, $permitidos)){
		
			$module = "views/modules/".$enlaces.".php";
		
		}else if($enlaces == "ok"){
		
			$module = "views/modules/registro.php";
		
		}else if($enlaces == "fallo"){
		
			$module = "views/modules/ingresar.php";
		
		}else{
		
			$module = "views/modules/registro.php";
		
		}
		
		return $module;

	}

}

?>
