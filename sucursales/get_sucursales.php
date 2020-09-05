<?php
	
	// include_once("../conexi.php");
	// $link = Conectarse();
	
	function getSucursales($link){
		
		$consulta_sucursales = "SELECT * FROM sucursales";
		
		$result_sucursales = mysqli_query($link,$consulta_sucursales);
		
		if(!$result_sucursales){
			die("Error en $consulta_sucursales" . mysqli_error($link) );
		}
		else{
			
			while($fila = mysqli_fetch_assoc($result_sucursales)){
				$sucursales[] = $fila;        
			}
			
		}
		
		return $sucursales;
		
		
	}
	
	
	
	
?>
