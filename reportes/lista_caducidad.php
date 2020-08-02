<?php 
	
	include('../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM caducidad  
	LEFT JOIN productos USING(id_productos)
	LEFT JOIN sucursales USING(id_sucursal)
	
	HAVING DATEDIFF(fecha_caducidad , CURDATE()) < '{$_GET["dias"]}'
	ORDER BY fecha_caducidad ASC
	";  
	
	
	$result = mysqli_query($link,$consulta);
	if(!$result){
        die("Error en $consulta" . mysqli_error($link) );
		}else{
		$num_rows = mysqli_num_rows($result);
		if($num_rows != 0){
			while($row = mysqli_fetch_assoc($result)){
				$filas[] = $row;        
			}
		}
		else{
			
		}
	}
	
	// $consulta = "SELECT * FROM caducidad  
	// LEFT JOIN productos USING(id_productos)
	// LEFT JOIN sucursales USING(id_sucursal)
	
	// HAVING DATEDIFF(fecha_caducidad , CURDATE()) < '{$_GET["dias"]}'
	// ORDER BY fecha_caducidad ASC
	// ";  
	
	
	// $result = mysqli_query($link,$consulta);
	// if(!$result){
        // die("Error en $consulta" . mysqli_error($link) );
		// }else{
		// $num_rows = mysqli_num_rows($result);
		// if($num_rows != 0){
			// while($row = mysqli_fetch_assoc($result)){
				// $filas[] = $row;        
			// }
		// }
		// else{
			
		// }
	// }
	
	
	// SELECCIONAR SUCURSALES y POR CADA UNA MOSTRAR CADUCIDADAES
	
	?>
	
	<table >
	<tr >
		<th class="text-center">Sucursal</th>
		<th class="text-center">Producto</th>
		<th class="text-center">Cantidad</th>
		<th class="text-center">Lote</th>
		<th class="text-center">Fecha Caducidad</th>
		
		
	</tr>
	
	<?php
	foreach($filas AS $i => $fila){
		
	?>
	<tr >
		<td class="text-center"><?php echo $fila["sucursal"];?></td>
		<td class="text-center"><?php echo $fila["descripcion_productos"];?></td>
		<td class="text-center"><?php echo $fila["cantidad"];?></td>
		<td class="text-center"><?php echo $fila["lote"];?></td>
		<td class="text-center"><?php echo date("d/m/Y", strtotime($fila["fecha_caducidad"]));?></td>
	</tr>
	
	<?php
	}
	
?>

</table >