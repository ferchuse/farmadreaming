<?php
	
	include ("../conexi.php");
	header("Content-Type: application/json");
	
	$link=Conectarse();
	
	$respuesta  =array() ;
	$query= $_GET["query"]; 
	$campo= $_GET["campo"]; 

	$consulta = "SELECT * FROM {$_GET["tabla"]}
	
	LEFT JOIN 
	(
	SELECT id_productos, existencia  
	FROM sucursal_existencias WHERE id_sucursal = {$_COOKIE["id_sucursal"]}
	) AS t_existencia
	USING(id_productos)
	
	
	WHERE {$_GET["campo"]} LIKE '%$query%' 
	OR sustancia LIKE '%$query%'
	
	
	
	ORDER BY {$_GET["campo"]} LIMIT 50 ";
	
	// $consulta = "SELECT * FROM $tabla WHERE $campo LIKE '%$query%' OR sustancia LIKE '%$query%' ORDER BY $campo LIMIT 50 ";
	
	$result= mysqli_query($link,$consulta);
	if($result){
		while($fila=mysqli_fetch_assoc($result)){
			
			$respuesta ["suggestions"][]  = ["value" => $fila[$campo]." | ".$fila["sustancia"], "data" => $fila ];
		}
	}
	else{
		
		$respuesta["result"] = "Error". mysqli_error($link);
	}
	
	$respuesta["consulta"] = $consulta;
	echo json_encode($respuesta );
	
	
	
	?>	
	
