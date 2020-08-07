<?php
	include('../funciones/numero_a_letras.php');
	$consulta = "SELECT * FROM empresas";
	
	$result = mysqli_query($link, $consulta);
	
	while ($fila = mysqli_fetch_assoc($result)) {
		$empresa = $fila;
	}
	
	$consulta_productos = "SELECT
	cantidad,
	descripcion,
	importe
	FROM
	ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	WHERE
	fecha_ventas = '$fecha_ventas'
	AND id_sucursal = '$id_sucursal'
	";
	
	$result = mysqli_query($link, $consulta_productos);
	
	while ($fila = mysqli_fetch_assoc($result)) {
		$productos_vendidos[] = $fila;
	}
	
	
	$respuesta = "";
	
	$respuesta.=   "\x1b"."@";
	$respuesta.= "\x1b"."E".chr(1); // Bold
	$respuesta.= "!";
	$respuesta.=  "{$empresa['nombre_empresas']}\n";
	$respuesta.=  "\x1b"."E".chr(0); // Not Bold
	$respuesta.=  "\x1b"."@" .chr(10).chr(13);
	$respuesta.= "Resumen del Dia:      ". date("d/m/Y"). "\n";
	$respuesta.= "Hora:                 " .date("H:i:s")."\n";
	$respuesta.= "Usuario:              " . $_COOKIE["nombre_usuarios"]."\n";
	// $respuesta.= "Inicio Turno:         " .date("H:i:s", strtotime($hora_inicios))."\n";
	// $respuesta.= "Fin Turno:            " .date("H:i:s", strtotime($hora_fin))."\n";
	$respuesta.= "Numero de Ventas:     " .$totales["ventas_totales"]."\n\n";
	$respuesta.= "Fondo de Caja:        " .number_format($_COOKIE["efectivo_inicial"], 2)."\n";
	$respuesta.= "Ventas en Efectivo: +$" .number_format($suma_efectivo , 2)."\n";
	$respuesta.= "Ventas con Tarjeta: +$" .number_format($suma_tarjeta, 2)."\n";
	$respuesta.= "Entradas:           +$" .number_format($totales["entradas"], 2)."\n";
	$respuesta.= "Salidas:            -$" .number_format($totales["salidas"], 2)."\n";
	$respuesta.= "__________________________\n";
	$respuesta.= "Saldo Final:         $" .number_format($saldo_final, 2)."\n";
	
	foreach ($productos_vendidos as $i => $producto){
		$respuesta.= number_format($producto["cantidad"], 0)."   ".$producto["importe"]."    ".substr($producto["descripcion"], 0 , 16)."\n";
	}
	
	// $respuesta.= NumeroALetras::convertir($fila_venta[0]["total_ventas"], "pesos", "centavos").chr(10).chr(13).chr(10).chr(13);
	// $respuesta.= "GRACIAS POR SU COMPRA";
	$respuesta.= "\x1b"."d".chr(1); // Blank line
	// $respuesta.= "aSeguro de Viajero\n"; // Blank line
	$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
	$respuesta.= "VA"; // Cut
	
	// }
	
	$corte = base64_encode ( $respuesta);
	
	// print_r($productos_vendidos);
	// echo $consulta_productos;
	echo "<textarea HIDDEN id='corte_b64'>$corte</textarea>";
	
?>

