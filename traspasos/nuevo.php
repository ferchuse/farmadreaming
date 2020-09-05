<?php
	include("../login/login_success.php");
	include("../funciones/generar_select.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "traspasos";
	
	
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			<style>
				.tabla_totales .row{
				margin-bottom: 10px;
				}
				
				
				@media only screen and (max-width: 1400px) {
				.tab-pane {
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 380px;
				width: 100%;
				padding: 10px;				
				}	
				}
				
				@media only screen and (min-width: 1400px) {
				.tab-pane {
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 600px;
				width: 100%;
				padding: 10px;				
				}	
				
				}
			</style>  
		</style>
		
		<title>Nuevo Traspaso</title>
		<?php include("../styles_carpetas.php");?>
	</head>
	<body>
		
		<?php include("../menu_carpetas.php");?>
		
		<div class="container-fluid hidden-print">
			
			
			<div class="row">
				<form id="form_agregar_producto" class="form-inline" autocomplete="off">
					
					<div class="col-md-2">
						<label for="">Código:</label>
						<input id="codigo_producto"   type="text" class="form-control" >
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="buscar_producto">Descripción:</label>
							<input id="buscar_producto" autofocus  type="text" class="form-control" size="50">
						</div>
					</div>
				</form>
				<input type="hidden" id='id_traspaso' class="form-control"  value='<?php echo $_GET["id_traspaso"]?>'>
				<div class="col-sm-2 ">
					<label>Origen</label> 
					<?php echo generar_select($link, "sucursales", "id_sucursal", "sucursal", false, false, false, 0,0, "origen", "origen");?>
				</div>
				<div class="col-sm-2 ">
					<label>Destino</label> 
					<?php echo generar_select($link, "sucursales", "id_sucursal", "sucursal", false, false, false, 0,0, "destino", "destino");?>
				</div>
				
				
			</div>
			
			
			<div class="row">
				<div class="col-md-12">
					<div class="tab-pane">
						<table id="tabla_venta" class="table table-hover table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Unidad</th>
								<th class="text-center">Descripcion del Producto</th>
								<th class="text-center">San Sebastián</th>
								<th class="text-center">Zumpango</th>
								<th class="text-center">Existencia Total</th>
								<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody >
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<br>
			<section id="footer">
				<div class="row lead">
					<div class="col-sm-1  ">
						<strong>Articulos:</strong>
						<input readonly id="articulos" type="number" class="form-control input-lg text-right " value="0" name="articulos">
					</div>
									
					<div class="col-sm-2 text-right col-sm-offset-7">
						<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">
							<i class="fas fa-save"></i> Guardar
						</button>
					</div>
				</div>
			</section>
		</div>
		<div id="ticket" class="visible-print">
			
		</div>
		<?php include('../scripts_carpetas.php'); ?>
		<?php include('../forms/modal_venta.php'); ?>
		<?php include('../forms/modal_granel.php'); ?>
		<script src="js/nuevo.js?v=<?= date("YmdHis")?>"></script>
		
	</body>
</html>						