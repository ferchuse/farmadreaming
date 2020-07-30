<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	
	$consulta = " 
	UPDATE
	sucursal_existencias
	SET
	existencia = '{$_POST["existencia"]}'
	
	WHERE
	id_sucursal = '{$_POST["id_sucursal"]}'
	AND
	id_productos = '{$_POST["id_productos"]}'
	
	
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