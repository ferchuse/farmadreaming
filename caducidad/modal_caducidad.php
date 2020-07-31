
<div id="modal_caducidad" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title text-center">Fechas de Caducidad</h3>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-4">
						<form id="form_caducidad" autocomplete="off" class="was-validated">
							<input type="hidden" name="id_productos">
							<input type="hidden" name="id_caducidad" id="id_caducidad">
							<div class="form-group">
								<label for="id_sucursal">Sucursal</label>
								<?php echo generar_select($link, "sucursales", "id_sucursal", "sucursal", false, false, false, $_COOKIE["id_sucursal"])?>
							</div>
							<div class="form-group">
								<label for="cantidad">Cantidad</label>
								<input  type="text" required class="form-control" name="cantidad" id="cantidad" value="1" >
							</div>
							<div class="form-group">
								<label for="lote">Lote</label>
								<input  type="text" required class="form-control" name="lote" id="lote" >
							</div>
							<div class="form-group">
								<label for="fecha_caducidad">Fecha de Caducidad</label>
								<input  type="date" required class="form-control" name="fecha_caducidad" id="fecha_caducidad" >
							</div>
							<button type="reset" class="btn btn-danger " >
								<i class="fa fa-sync"></i> Reset 
							</button>
							<button type="submit" class="btn btn-success pull-right" id="agregar_caducidad">
								<i class="fa fa-arrow-right"></i> Agregar 
							</button>
							
							
						</form>					
						
					</div>
					<div class="col-md-8">
						<table class="table table-bordered" id="tabla_productos">
							<thead class="bg-primary">
								<tr>
									<th class="text-center">Sucursal</th>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Lote</th>
									<th class="text-center">Caducidad</th>
									<th class="text-center">Acciones</th>	
								</tr>
							</thead>
							<tbody id="lista_caducidad">                    
								<tr>
									<th class="text-center" colspan="9">
										<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
									</th>
								</tr>                   
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger " data-dismiss="modal" >
					<i class="fa fa-times"></i> Cerrar
				</button>
				</div>
			</div>
		</div>
	</div>
