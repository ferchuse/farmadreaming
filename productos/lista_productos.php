<?php 
	header("Content-Type: application/json");
	include('../conexi.php');
	$link = Conectarse();
	$arrResult = array();
	
	
	
	
	$consulta = "SELECT * FROM productos 
	LEFT JOIN departamentos USING (id_departamentos) 
	LEFT JOIN 
	(SELECT id_productos, SUM(existencia) AS existencia_total 
	FROM sucursal_existencias GROUP BY id_productos) AS t_existencias
	USING(id_productos) ";
	
	
	// foreach($sucursales as $sucursal){
	
	// $consulta.=" LEFT JOIN 
	// (
	// SELECT id_productos, existencia AS existencia{$sucursal["id_sucursal"]}  
	// FROM sucursal_existencias WHERE id_sucursal = {$sucursal["id_sucursal"]}
	// ) AS t_existencia_{$sucursal["id_sucursal"]}
	// USING(id_productos)";
	
	
	// }
	
	
	
	
	$consulta.= "WHERE 1";    
	if($_GET["id_departamentos"] != '') {        
		$consulta.= " AND  id_departamentos = '{$_GET["id_departamentos"]}'";
	}
	if($_GET["existencia"] != '') {        
		$consulta.= " AND existencia_productos < min_productos";
	} 
	if($_GET["codigo_productos"] != '') {        
		$consulta.= " AND codigo_productos = '{$_GET["codigo_productos"]}'";
	}  
	if($_GET["descripcion_productos"] != '') {        
		$consulta.= " AND descripcion_productos LIKE '%{$_GET["descripcion_productos"]}%'";
	} 
	
	if($_GET["sustancia"] != '') {        
		$consulta.= " AND sustancia LIKE '%{$_GET["sustancia"]}%'";
	} 
	
	$consulta.= "  ORDER BY {$_GET["orden"]} {$_GET["asc"]}";
	
	$result = mysqli_query($link,$consulta);
	if(!$result){
        die("Error en $consulta" . mysqli_error($link) );
		}else{
		$num_rows = mysqli_num_rows($result);
		if($num_rows != 0){
			while($fila_producto = mysqli_fetch_assoc($result)){
				$existencias = [];
				$consulta_existencia = "SELECT * FROM sucursal_existencias WHERE id_productos = {$fila_producto["id_productos"]}";
				
				$result_existencia = mysqli_query($link,$consulta_existencia);
				
				if(!$result_existencia){
					die("Error en $consulta_existencia" . mysqli_error($link) );
				}
				else{
					
					while($fila_existencia = mysqli_fetch_assoc($result_existencia)){
						$existencias[] = $fila_existencia;        
					}
					
				}
				
				$fila_producto["existencias"] = $existencias;
				
				$productos[] = $fila_producto;        
			}
		}
		else{
			
		}
	}
	
	
	// $productos[] = $consulta;
	// $productos[] = $sucursales;
	// $productos[] = $consulta_sucursales;
	
	
	
    echo json_encode($productos);
?>
