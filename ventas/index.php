<?php
	include("../login/login_success.php");
	include("../funciones/generar_select.php");
	
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
	error_reporting(0);
	
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Nueva Venta</title>
		<?php include("../styles_carpetas.php"); ?>
		<style>
			.tabla_totales .row {
			margin-bottom: 10px;
			}
			
			.tab-pane .productos {
			display: block;
			overflow: auto;
			overflow-x: hidden;
			height: 280px;
			width: 100%;
			padding: 5px;
			}
			
			.sticky-footer {
			position: fixed;
			right: 0;
			bottom: 0;
			}
			
			#tabs_ventas{
			background-color: dimgray;
			
			}
			
			.lbl_totales {
			margin-bottom: 15px;
			}
			.nav-tabs>li.active>a {
			font-color: white !importnat;
			background-color: #46b8da !important;
			}
		</style>
		<link rel="stylesheet" href="css/forma_pago.css">
		<link rel="stylesheet" href="css/b4-margin-padding.css">
		<link rel="stylesheet" href="css/b4-radios.css">
	</head>
	
	<body>
		
		<?php include("../menu_carpetas.php"); ?>
		
		<div class="container-fluid hidden-print">
			<div class="row">
				<form id="form_agregar_producto" class="form-inline" autocomplete="off">
					<div class="col-md-3">
						<label for="">Código:</label>
						<input tabindex="-1" id="codigo_producto" autofocus type="text" class="form-control" placeholder="ESC" size="30">
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label for="">Descripción:</label>
							<input tabindex="-1" id="buscar_producto" type="text" class="form-control" size="60" placeholder="F10">
						</div>
					</div>
					<div class="col-md-2" hidden>
						<label for="">Sustancia:</label>
						<input  id="sustancia" type="text" class="form-control" placeholder="F11" size="30">
					</div>
				</form>
				<?php if ($_COOKIE["permiso_usuarios"] != "mostrador") { ?>
					<div class="col-md-4 " hidden >
						<div class="form-group">
							
							<button tabindex="-1" class="btn btn-info pull-right" id="btn_refresh">
								<i class="fa fa-sync"></i> Ventas Pendientes
							</button>
						</div>
						
					</div>
					<?php
					}
				?>
			</div>
			
			<hr>
			
			
			<ul id="tabs_ventas" class="nav nav-tabs" >
				<li class="active">
					<a data-toggle="tab" href="#tab1">
						<input class="nombre_cliente" value="Cliente 1" >
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab2">
						<input  class="nombre_cliente" value="Cliente 2" >
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#tab3">
						<input  class="nombre_cliente" value="Cliente 3" >
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				
			</ul>
			
			<div class="tab-content">
				<div id="tab1" class="tab-pane in active">
					<div class="productos">
						<table id="tabla_venta" class="tabla_venta table table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">% Desc</th>
									<th class="text-center">$ Desc</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							
							<div class="col-sm-9 col-6  text-right ">
								<label class="venta lbl_totales"  for="">Subtotal:</label>  <br>
								<label class="venta lbl_totales" for="">Descuento:</label>  <br>
								<label class="venta lbl_totales" for="">Total:</label> 
							</div>
							<div class="col-sm-2 col-6  venta">
								<input readonly type="text" class="form-control text-right venta subtotal" value="0" >
								<input readonly type="text" class="form-control text-right venta total_descuento" value="0">
								<input readonly  type="text" class="form-control text-right venta total" value="0" >
							</div>
							
						</div>
					</section>
				</div>
				
				<div id="tab2" class="tab-pane">
					<div class="productos">
						<table class="tabla_venta table table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							<div class="col-sm-8 text-right">
								
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly type="text" class="total form-control input-lg text-right " value="0" name="total">
							</div>
						</div>
					</section>
				</div>
				<div id="tab3" class="tab-pane">
					<div class="productos">
						<table class="tabla_venta table table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							
							<div class="col-sm-9 col-6  text-right ">
								<label class="venta lbl_totales"  for="">Subtotal:</label>  <br>
								<label class="venta lbl_totales" for="">Descuento:</label>  <br>
								<label class="venta lbl_totales" for="">Total:</label> 
							</div>
							<div class="col-sm-2 col-6  venta">
								<input readonly type="text" class="form-control text-right venta subtotal" value="0" >
								<input readonly type="text" class="form-control text-right venta total_descuento" value="0">
								<input readonly  type="text" class="form-control text-right venta total" value="0" >
							</div>
						</div>
					</section>
				</div>
			</div>
			
			<div class="sticky-footer">
				
				<button class="btn btn-warning btn-lg" FORM="" id="btn_pendiente">
					F6 - Pendiente
				</button>
				<?php if(dame_permiso("index.php", $link) == "Escritura" || dame_permiso("index.php", $link) == "Supervisor"){	
				?> 
				<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">
					F12 - Cobrar
				</button>
				<?php
					
				}
				?>
			</div>
		</div>
		
		<div id="ticket" class="visible-print">
			
		</div>
		
		<?php include('forma_pago.php'); ?>
		<?php include('../forms/modal_granel.php'); ?>
		<?php include('../caducidad/modal_elige_lote.php'); ?>
		<?php include('../scripts_carpetas.php'); ?>
		
		<script>
			$.getScript('https://luke-chang.github.io/js-spatial-navigation/spatial_navigation.js', function() {
				$('.cliente')
				.SpatialNavigation()
				.focus(function() {
					$(this).addClass("bg-info");
				})
				.blur(function() {
					$(this).removeClass('bg-info');
				})
				.first()
				.focus();
			});
		</script>
		<script src="../lib/pos_print/websocket-printer.js" > </script>
		<script src="ventas.js?v=<?= date("d-m-Y-H-i-s")?>"></script>
		<script src="comision.js?v=<?= date("d-m-Y-H-i-s")?>"></script>
		
	</body>
	
</html>