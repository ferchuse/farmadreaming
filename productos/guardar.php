<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	
	include ("../sucursales/get_sucursales.php");
	
	$sucursales = getSucursales($link);
	$respuesta = Array();
	
	
	$guardarProductos = "INSERT INTO productos SET 
	id_productos = '{$_POST["id_productos"]}',
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	sustancia = '{$_POST["sustancia"]}',
	laboratorio = '{$_POST["laboratorio"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}',
	fecha_modificacion = NOW()
	
	
	
	ON DUPLICATE KEY UPDATE 
	
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	sustancia = '{$_POST["sustancia"]}',
	laboratorio = '{$_POST["laboratorio"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}',
	fecha_modificacion = NOW()
	;
	
	";
	
	$result = mysqli_query($link,$guardarProductos);
	
	if($result){
		$respuesta['estatus'] = "success";
		$id_producto = mysqli_insert_id($link);
	}
	
	else{
		$respuesta['estatus'] = "error";
		$respuesta['guardarProductos'] = $guardarProductos;
		$respuesta['mensaje'] = mysqli_error($link);
	}
	
	$respuesta['mysqli_affected_rows'] = mysqli_affected_rows($link);
	$respuesta['sucursales'] =($sucursales);
	
	if(mysqli_affected_rows($link) == 1){
		//Si es nuevo producto instertar en tabla de existencias
		foreach($sucursales as $sucursal){
			$insert_existencias = "INSERT INTO sucursal_existencias SET
			id_sucursal = {$sucursal["id_sucursal"]},
			id_productos = $id_producto ,
			existencia = 0;
			";
			
			$result_existencia = mysqli_query($link,$insert_existencias);
			
			if($result_existencia){
				$respuesta['estatus_existencia'] = "success";
				
			}
			
			else{
				$respuesta['estatus_existencia'] = "error";
				$respuesta['mensaje_existencia'] = mysqli_error($link);
			}
			
			
		}
		
	}
	
	
	echo json_encode($respuesta);
?>