
<div id="modal_existencia" class="modal fade" role="dialog">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title text-center">Existencias</h3>
			</div>
			<div class="modal-body">
				<h4 id="descripcion">
				</h4>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered" id="tabla_productos">
							<thead class="bg-primary">
								<tr>
									<th class="text-center">Sucursal</th>
									<th class="text-center">Existencia</th>	
								</tr>
							</thead>
							<tbody id="lista_existencias">                    
								<tr>
									<th class="text-center" colspan="9">
										<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
									</th>
								</tr>                   
							</tbody>
							<tfoot class="bg-secondary hidden">                    
								<tr>
									<th class="text-center">TOTAL</th>
									<th class="text-center"></th>	
								</tr>                   
							</tfoot>
							
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
