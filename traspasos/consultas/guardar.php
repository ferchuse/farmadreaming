<?php 
	include("../../conexi.php");
	$link = Conectarse();
	
	$insertar = "INSERT INTO traspasos SET
	
	id_usuarios = '{$_COOKIE['id_usuarios']}',
	fecha = NOW(),
	origen = '{$_POST["origen"]}',
	destino = '{$_POST["destino"]}',
	articulos = '{$_POST["articulos"]}'
	";
	
	$exec_query = mysqli_query($link,$insertar);
	
	$respuesta["insertar"] = $insertar;
	
	if($exec_query){
		$respuesta["estatus_venta"] = "success";
		$respuesta["mensaje_venta"] = "Venta Guardada";
		$folio = mysqli_insert_id($link);
		$respuesta["folio"] = $folio;
		
	}
	else{
		$respuesta["estatus_venta"] = "error";
		$respuesta["mensaje_venta"] = "Error en Insertar: $insertar  ".mysqli_error($link);	
		
	}
	
	
	//Borrar compras detalle anterior
	
	
	// $consulta = "DELETE FROM compras_detalle WHERE id_compras = {$_POST["id_compras"]}";
	
	// $result = mysqli_query($link,$consulta);
	
	
	// if($result){
	// $respuesta["estatus_borrar"] = "success";
	// $respuesta["mensaje_borrar"] = "Compras detalle borrado";
	// }
	// else{
	// $respuesta["estatus_borrar"] = "error";
	// $respuesta["mensaje_borrar"] = "Error en  $consulta  ".mysqli_error($link);	
	
	// }
	
	//Inserta productos en compras_detalle
	
	foreach($_POST['productos'] as $indice => $producto){
		$insertar_productos = "INSERT INTO traspasos_detalle SET
		id_traspaso = '$folio',
		id_productos = '$producto[id_productos]',
		descripcion = '$producto[descripcion]',
		cantidad = '$producto[cantidad]'
		";
		
		$exec_query = mysqli_query($link, $insertar_productos);
		
		if($exec_query){
			$respuesta['estatus_detalle'] = 'success';
			$respuesta['mensaje_detalle'] = 'Productos Guardados';
			
		}
		else{
			$respuesta['estatus_detalle'] = 'error';
			$respuesta['mensaje_detalle'] = "Error al guardar  $insertar_productos ".mysqli_error($link);
			$respuesta['insertar_productos'] = $insertar_productos;
		}
		
		
	
		
		$update_existencia = "UPDATE sucursal_existencias
		
		SET existencia = existencia - '{$producto["cantidad"]}'
		WHERE id_productos = '{$producto["id_productos"]}'	
		AND id_sucursal = '{$_POST["origen"]}'
		"; 
		
		$result_existencia = mysqli_query( $link, $update_existencia );
		
		$respuesta["result_existencia"] = $result_existencia ;
		
		
		$update_existencia = "UPDATE sucursal_existencias
		
		SET existencia = existencia + '{$producto["cantidad"]}'
		WHERE id_productos = '{$producto["id_productos"]}'	
		AND id_sucursal = '{$_POST["destino"]}'
		"; 
		
		$result_existencia = mysqli_query( $link, $update_existencia );
		
		$respuesta["result_existencia"] = $result_existencia ;
		$respuesta["update_existencia"] = $update_existencia ;
		
		
		
	}
	
	echo json_encode($respuesta);
?>