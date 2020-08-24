<?php
	include("../../conexi.php");
	$link = Conectarse();
	
	// $dt_fecha_inicial = new DateTime("first day of this month");
	// $dt_fecha_final = new DateTime("last day of this month");
	
	
	// if (isset($_GET["fecha_inicial"])) {
	// $fa_inicial = $_GET["fecha_inicial"];
	// }else{
	
	// $fa_inicial = $dt_fecha_inicial->format("Y-m-d");
	// }
	
	// if (isset($_GET["fecha_final"])) {
	// $fa_final = $_GET["fecha_final"];
	// }else{
	
	// $fa_final = $dt_fecha_final->format("Y-m-d");
	// }
	
	
	$consulta = "SELECT * FROM traspasos 
	
	LEFT JOIN traspasos_detalle USING(id_traspaso)
	LEFT JOIN productos USING(id_productos)
	
	WHERE date(fecha) BETWEEN '{$_GET["fecha_inicial"]}' AND '{$_GET["fecha_final"]}' 
	
	ORDER BY (fecha) DESC";
	
	$result = mysqli_query($link, $consulta);
	
	
	if(!$result) {
		
		die($consulta. mysqli_error($link));
	}
	
	// echo $consulta;
?>



<table class="table table-hover">
	<tr>
		<th class="text-center"> Folio</th>
		<th class="text-center"> Fecha</th>
		<th class="text-center"> Cantidad</th>
		<th class="text-center"> Producto</th>
		<th class="text-center"> Origen</th>
		<th class="text-center"> Destino</th>
	</tr>
	
	
	<?php
		
		
		
		
		while ($fila = mysqli_fetch_assoc($result)) {
			// extract($row_ventas);
			
			// switch($estatus_compras){
			// case "CANCELADA":
			// $color = "danger";
			// break;	
			// case "PENDIENTE":
			// $color = "warning";
			// break;
			// default:
			// $color = "success";
			// break;
			// }
			
		?>
		<tr class="<?php echo $color; ?>">
			<td class="text-center"><?php echo $fila["id_traspaso"]; ?></td>
			<td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($fila["fecha"])); ?></td>
			<td class="text-center"><?php echo $fila["cantidad"]; ?></td>
			<td class="text-center"> <?php echo  $fila["descripcion_productos"]  ; ?></td>
			<td class="text-center"> <?php echo  $fila["origen"] == "1" ? "San Sebastián" : "Zumpango" ; ?></td>
			<td class="text-center"> <?php echo  $fila["destino"] == "1" ? "San Sebastián" : "Zumpango" ; ?></td>
			
			
		</tr>
		<?php
		}
	?>
	
</table>