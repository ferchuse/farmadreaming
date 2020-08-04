<?php 
	
	include('../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM caducidad
	LEFT JOIN sucursales USING(id_sucursal)
	WHERE 
	id_productos = '{$_GET["id_productos"]}'
	AND vendido = 0
	
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
	
	
	
	// ECHO "fecha cad:". $ts_fecha_caducidad;
	// echo "<br>";
	// echo "<br>";
	// echo "fecha_actual: ". $ts_fecha_actual;
	
	// if($ts_fecha_actual > $ts_fecha_caducidad){
	// echo "<br>";
	// echo "Proximo a caducar";
	// }
	// strtotime("-30 days", $fila["fecha_caducidad"])
	
	foreach($filas AS $i => $fila){
		
		//ts = Timestamp Unix;
		$ts_fecha_caducidad = strtotime($fila["fecha_caducidad"]. '-32 days');
		
		$ts_fecha_actual = strtotime("now");
		
		if($ts_fecha_actual > $ts_fecha_caducidad){
			$icon = "<span class='badge badge-warning'><i class='fas fa-exclamation-triangle'></i></span>";
			$bg = "bg-danger";
			$oferta = "SI";
		}
		else{
			$icon = "";
			$bg = "";
			$oferta = "NO";
		}
	?>
	<tr class="<?= $bg?>">
		<td class="text-center">
			<!-- 
			<label class="custom_checkbox" hidden>
				<input data-oferta="<?= $oferta?>" data-id_caducidad=<?= $fila["id_caducidad"]?> class="id_caducidad" type="checkbox">
				<span class="checkmark"></span>
			</label>
			
			-->
			<input   class="cantidad" type="number"  data-id_caducidad=<?= $fila["id_caducidad"]?> >	
		</td>
		<td class="text-center">
			<?php echo $fila["sucursal"];?>		
		</td>	
		<td class="text-center">
			<?php echo $fila["cantidad"];?>		
		</td>
		<td class="text-center"><?php echo $fila["lote"];?></td>
		<td class="text-center">
			<?php
				echo $icon ." ";
				echo date("d/m/Y", strtotime($fila["fecha_caducidad"]));
			?>
			
		</td>
	</tr>
	
	<?php
	}
	
?>