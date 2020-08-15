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
USING(id_productos)

WHERE 1";    
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

$consulta.= "  ORDER BY descripcion_productos LIMIT 1000";
$result = mysqli_query($link,$consulta);
if(!$result){
        die("Error en $consulta" . mysqli_error($link) );
}else{
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 0){
        while($row = mysqli_fetch_assoc($result)){
            $arrResult[] = $row;        

            }
        }else{
    
        }
    }
    echo json_encode($arrResult);
?>
