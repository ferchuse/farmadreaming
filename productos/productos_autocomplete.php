<?php
	
	include ("../conexi.php");
	header("Content-Type: application/json");
	
	$link=Conectarse();
	
	$respuesta  =array() ;
	$query=$_GET["query"]; 
	$tabla= "productos"; 
	$campo= "descripcion_productos"; 
	
	$consulta = "SELECT * FROM $tabla 
	
	LEFT JOIN sucursal_existencias
	USING(id_productos)
	
	WHERE $campo LIKE '%$query%' 
	AND id_sucursal = '{$_COOKIE["id_sucursal"]}'
	
	
	ORDER BY $campo LIMIT 50 ";
	$result= mysqli_query($link,$consulta);
	if($result){
		while($fila=mysqli_fetch_assoc($result)){
			
			$respuesta ["suggestions"][]  = ["value" => $fila[$campo]." | ".$fila["sustancia"], "data" => $fila ];
		}
	}
	else $respuesta["result"] = "Error". mysqli_error($link);
	
	$respuesta["consulta"] = $consulta;
	echo json_encode($respuesta );
	
	
	
?>	

