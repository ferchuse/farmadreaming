
<?php
	include("../login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "compras";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lista Traspasos</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
	<body>
		
		<?php include("../menu_carpetas.php");?>
		
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-md-12 text-right hidden-print">
					<h3 class="text-center">Lista de Traspasos</h3>
					<hr>
					
				</div>
				
				<div class="col-md-12 ">
					
					<div class="row ">
						<!-- Filtro Fecha -->
						<div class="col-sm-9 text-left">
							<form id="form_filtros" class="form-inline" action="" method="">
								<div class="form-group">
									<label for="fecha_inicio">Desde:</label>
									<input type="date" name="fecha_inicial" id="fecha_inicio" class="form-control" value="<?= date("Y-m-01"); ?>">
								</div>
								<div class="form-group">
									<label for="fecha_fin">Hasta:</label>
									<input type="date" name="fecha_final" id="fecha_fin" class="form-control" value="<?= date("Y-m-t"); ?>">
								</div>
								<button type="submit" class="btn btn-primary" id="btn_buscar">
									<i class="fa fa-search"></i> Buscar
								</button>
							</form>
						</div>
						
						<div class="col-md-3 text-right">
							<a href="nuevo.php" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
						</div>
					</div>
					
				</div>
				
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive" id="lista_registros">
						
						
					</div>
				</div>
			</div>
			
		</div>
		
		<?php  include('../scripts_carpetas.php'); ?>
		<script>
			
			$("#form_filtros").submit(listarRegistros);
			
			function listarRegistros(event){
				event.preventDefault();
				console.log("guardarVenta");
				
				var boton = $(this).find(":submit");
				var icono = boton.find('.fa');
				
				icono.toggleClass('fa fa-usd fa fa-spinner fa-spin');
				
				$.ajax({
					url: 'consultas/lista.php',
					method: 'GET',
					data:$("#form_filtros").serialize()
					}).done(function(respuesta){
					
					$("#lista_registros").html(respuesta);
					
					
					}).always(function(){
					boton.prop('disabled',false);
					icono.toggleClass('fa fa-usd fa fa-spinner fa-spin');
				});
				
				
			}
		</script>
		
		
		
	</body>
</html>

