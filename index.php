<?php
	include("login/login_success.php");
	include("funciones/generar_select.php");
	
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
	error_reporting(0);
	
	if(isset($_COOKIE["id_sucursal"])){
		
	}
	
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Nueva Venta</title>
		<?php include("styles.php"); ?>
		
		<link rel="stylesheet" href="css/forma_pago.css">
		<link rel="stylesheet" href="css/b4-margin-padding.css">
		<link rel="stylesheet" href="css/b4-radios.css">
	</head>
	
	<body>
		
		<div class="container" >
			<form id="form_caja" autocomplete="off">
				
				
				<h4 class="modal-title text-center">Selecciona Sucursal</h4>
				
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="form-group">
							<label for="usuario">Usuario:</label>
							<input readonly class="form-control " value="<?= $_COOKIE["nombre_usuarios"]?>" />
						</div>
						<div class="form-group">
								<label for="password">Ultimo Turno:</label>
								<input type="number" readonly name="turno" class="form-control col-sm-6" id="turno" placeholder="" required="" />
								<input class="form-control col-sm-6" readonly id="cerrado" name="cerrado">
							</div>
						<div class="form-group">
							<label for="id_sucursal">Sucursal</label>
							<?php echo generar_select($link, "sucursales", "id_sucursal", "sucursal", false, false, true)?>
						</div>
						<div class="form-group">
							<label for="efectivo_inicial">Efectivo Inicial:</label>
							<input type="number" value="0" step="0.01" name="efectivo_inicial" class="form-control " id="efectivo_inicial" placeholder="Efectivo inicial" required="" />
						</div>
						
						
						<div class="modal-footer">
							<button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Aceptar</button>
						</div>
					</div>
				</div>
				
			</form>
		</div>
		<?php include("scripts.php"); ?>
		<script>
			$(document).ready(onLoad)
			
			function onLoad(){
				ultimoTurno();
				$("#form_caja").submit(guardarTurno);
				
			}
			
			function ultimoTurno(){
				
				$.ajax({
					"url": "login/ultimo_turno.php"
					}).done(function(respuesta){
					
					
					$("#turno").val(respuesta.ultimo_turno);
					$("#cerrado").val(respuesta.fila_ultimo_turno.cerrado == 1 ? "Cerrado": "Abierto");
					$("#efectivo_inicial").val(respuesta.fila_ultimo_turno.efectivo_inicial);
					
				});
				
			}
			
			
			function guardarTurno(event){
				event.preventDefault();
				
				$.ajax({
					"url": "guardar_turno.php",
					"method": "POST",
					"data": $("#form_caja").serialize()
					
					}).done(function(respuesta){
					window.location.href = "ventas/index.php";
				})
				
			}
		</script>
	</body>
	
</html>