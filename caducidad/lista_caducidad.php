<?php 
	
	include('../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM caducidad  WHERE id_productos = '{$_GET["id_productos"]}'";    
	
	
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
	
	
	
	
	foreach($filas AS $i => $fila){
		
	?>
	<tr >
		<td class="text-center"><?php echo $fila["cantidad"];?></td>
		<td class="text-center"><?php echo $fila["lote"];?></td>
		<td class="text-center"><?php echo date("d/m/Y", strtotime($fila["fecha_caducidad"]));?></td>
		
		<td class="text-center">
			<button class="btn btn-danger btn_borrar" data-id_registro="<?php echo $fila["id_caducidad"];?>">
				<i class="fa fa-trash"></i>
			</button>
			<button class="btn btn-warning btn_editar" 
				data-id_caducidad="<?php echo $fila["id_caducidad"];?>"
				data-fecha_caducidad="<?php echo $fila["fecha_caducidad"];?>"
				data-cantidad="<?php echo $fila["cantidad"];?>"
				data-lote="<?php echo $fila["lote"];?>"
				>
				<i class="fa fa-edit"></i>
			</button>
		</td>
	</tr>
	
	<?php
	}
	
?>