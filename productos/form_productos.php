<form id="form_productos" autocomplete="off" class="is-validated">
	<div id="modal_productos" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center"></h3>
				</div>
				<div class="modal-body">
					<input class="hidden" type="text" id="id_productos" name="id_productos">
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="codigo_productos">Codigo de Barras:</label>
								<input  type="text" class="form-control" name="codigo_productos" id="codigo_productos" placeholder="Opcional">
							</div>
							<div class="form-group">
								<label for="">Descripción:</label>
								<input placeholder="Nombre del producto" required class="form-control" type="text" name="descripcion_productos" id="descripcion_productos">
							</div>
							<div class="form-group">
								<label for="">Sustancia:</label>
								<input  class="form-control" type="text" name="sustancia" id="sustancia">
							</div>
							<div class="form-group">
								<label for="">Laboratorio:</label>
								<input  class="form-control" type="text" name="laboratorio" id="laboratorio">
							</div>
							<div class="form-group">
								<label required for="unidad_productos">Unidad de Medida:</label>
								<select  class="form-control" id="unidad_productos" name="unidad_productos">
									<option value="">Elije...</option>
									<option selected value="PZA">Pieza</option>
									<option value="KG">A Granel</option>
								</select>
							</div>
							<div class="form-group">
								<label required for="id_departamentos">Departamento:</label>
								<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos")?>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="costo_proveedor">Costo de compra:</label>
								<input placeholder=""  type="number" min="0" step=".01" class="form-control" id="costo_proveedor" name="costo_proveedor">
								
							</div>
							<div class="form-group">
								<label for="costo_proveedor">
									Piezas por Paquete:
								</label>
								<input placeholder="" required type="number" min="1" step="1" class="form-control" value="1" id="piezas" name="piezas">
								
							</div>
							<div class="form-group ">
								<label for="">Porcentaje de Ganancia :</label>
								
								<input   type="number" value="25" step=".01" class="form-control" id="ganancia_menudeo_porc" name="ganancia_menudeo_porc">
								
							</div>
							<div class="form-group ">
								<label >Precio de Venta:</label>
								
								<input placeholder="PRECIO" type="number" min="0"  step=".01" class="form-control" id="precio_menudeo" name="precio_menudeo">
								
							</div>
							<div class="form-group ">
								<label for="precio_mayoreo">Precio Mayoreo:</label>
								
								<input placeholder="" type="number" step=".01" class="form-control" id="precio_mayoreo" name="precio_mayoreo">
							</div>  
							<div class="form-group ">
								<label for="existencia_productos">Existencia:</label>
								<input readonly placeholder="Cantidad de productos en existencia" type="number" min="0" step="any" class="form-control" id="existencia_productos" name="existencia_productos">
							</div>
							<div class="form-group ">
								<label for="min_productos">Minimo:</label>
								<input placeholder="" type="number" min="0" class="form-control" id="min_productos" name="min_productos">
							</div>
						</div>					
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success" id="btn_formAlta">
						<i class="fa fa-save"></i> Guardar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>							