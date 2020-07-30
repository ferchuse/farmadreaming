
<form id="form_caja" autocomplete="off">
	
	
	<h4 class="modal-title">Selecciones Sucursal</h4>
	
	
	<div class="form-group">
		<label for="id_sucursal"></label>
		<?php echo generar_select($link, "sucursales", "id_sucursales", "sucursal", true)?>
	</div>
	<div class="form-group">
		<label for="efectivo_inicial">Efectivo Inicial:</label>
		<input type="number" value="0" step="0.01" name="efectivo_inicial" class="form-control " id="efectivo_inicial" placeholder="Efectivo inicial" required="" />
	</div>
	
	
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Aceptar</button>
	</div>
	
</form>