<?php 
	
	include('../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM sucursal_existencias 
	LEFT JOIN sucursales  USING(id_sucursal)
	WHERE id_productos = '{$_GET["id_productos"]}'";    
	
	
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
		<td class="text-center"><?php echo $fila["sucursal"];?></td>
		<td class="text-center">
			<input class="existencia form-control text-right" data-id_sucursal="<?php echo $fila["id_sucursal"];?>" data-id_productos="<?php echo $fila["id_productos"];?>"  size="10"  value="<?php echo $fila["existencia"];?>">
		</td>
		
	</tr>
	
	<?php
	}
	
?>