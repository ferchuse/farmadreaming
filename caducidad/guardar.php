<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	
	$consulta = "INSERT INTO caducidad SET 
	id_productos = '{$_POST["id_productos"]}',
	cantidad = '{$_POST["cantidad"]}',
	lote = '{$_POST["lote"]}',
	fecha_caducidad = '{$_POST["fecha_caducidad"]}'
	
	";
	
	
	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = "success";
		$id_producto = mysqli_insert_id($link);
		}
	else{
		$respuesta['estatus'] = "error";
		$respuesta['mensaje'] = mysqli_error($link);
	}
	
	$respuesta['consulta'] = $consulta;
	
	
	
	echo json_encode($respuesta);
?>