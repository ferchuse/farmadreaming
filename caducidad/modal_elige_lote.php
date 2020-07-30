
<form id="form_elige_lote">
	<div id="modal_caducidad" class="modal fade" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center">Fechas de Caducidad</h3>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered" id="tabla_productos">
								<thead class="bg-primary">
									<tr>
										<th class="text-center">Descontar</th>	
										<th class="text-center">Disponibles</th>	
										<th class="text-center">Lote</th>
										<th class="text-center">Caducidad</th>
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
					<button type="submit" class="btn btn-success" >
						<i class="fa fa-check"></i> Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

