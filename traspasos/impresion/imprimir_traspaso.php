<?php
	
	include('../../conexi.php');
	
	$link = Conectarse();
	$consulta = "SELECT * FROM traspasos
	LEFT JOIN traspasos_detalle USING (id_traspaso)
	LEFT JOIN usuarios USING (id_usuarios)
	WHERE id_traspaso={$_GET["folio"]}";
	
	$result = mysqli_query($link, $consulta);
	
	while ($fila = mysqli_fetch_assoc($result)) {
		$fila_venta[] = $fila;
	}
	
	
	$consulta = "SELECT * FROM empresas";
	
	$result = mysqli_query($link, $consulta);
	
	while ($fila = mysqli_fetch_assoc($result)) {
		$empresa = $fila;
	}
	
	
	$sucursales= [
		["1"] => "San Sebastián",
		["2"] => "Zumpango"
	];
	
	
	
	
	$respuesta = "";
	$respuesta.=   "\x1b"."@";
	$respuesta.= "\x1b"."E".chr(1); // Bold
	$respuesta.= "!";
	$respuesta.=  "{$empresa['nombre_empresas']}\n";
	$respuesta.=  "\x1b"."E".chr(0); // Not Bold
	$respuesta.=  "\x1b"."@" .chr(10).chr(13);
	$respuesta.= "TRASPASO DE PRODUCTO \n";
	
	$respuesta.= "Folio:   ". $fila_venta[0]["id_traspaso"]. "\n";
	$respuesta.= "Fecha:   " . date("d/m/Y", strtotime($fila_venta[0]["fecha"]))."\n";
	$respuesta.= "Hora:    " . date('H:i:s', strtotime($fila_venta[0]["hora"]))."\n";
	$respuesta.= "Usuario: " .$fila_venta[0]["nombre_usuarios"]."\n";
	 
	 
	 // $respuesta.= "Origen: " .$sucursales["1"].$fila_venta[0]["origen"]."\n";
	 // $respuesta.= "Origen: " .$sucursales[1].$fila_venta[0]["origen"]."\n";
	 $respuesta.= "Origen: " .$sucursales["{$fila_venta[0]["origen"]}"].$fila_venta[0]["origen"]."\n";
	 $respuesta.= "Destino: " .$sucursales["{$fila_venta[0]["destino"]}"].$fila_venta[0]["destino"]."\n";
	 
	
	// $respuesta.= "Destino: " .$fila_venta[0]["destino"] == "1" ? "San Sebastián" : "Zumpango""\n".chr(10).chr(13).chr(10).chr(13);
	
	
	foreach ($fila_venta as $i => $producto) { 
		$respuesta.=		$producto["cantidad"]. "    ".$producto["descripcion"]
		."\n ";      	
	}
	$respuesta.="\n\n\n";
	
	$respuesta.="Articulos:  ". $producto["articulos"]."\n";
	
	
	
	// $respuesta.= "\nTOTAL: $" .$fila_venta[0]["total_ventas"]."\n".chr(10).chr(13);
	// $respuesta.= NumeroALetras::convertir($fila_venta[0]["total_ventas"], "pesos", "centavos").chr(10).chr(13).chr(10).chr(13);
	
	$respuesta.= "\x1b"."d".chr(1); // Blank line
	// $respuesta.= "aSeguro de Viajero\n"; // Blank line
	$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
	$respuesta.= "VA"; // Cut
	
	
	echo base64_encode ( $respuesta );
	exit(0);
	
?>

