$("#bodyProductos").on("click", ".btn_existencia", modalExistencias);
$("#lista_existencias").on("keyup", ".existencia", guardarExistencia);
$("#lista_existencias").on("focus", ".existencia", function(){
	
	$(this).select();
	
});
// $("#lista_caducidad").on("click", ".btn_editar", cargarExistencia);
// $("#form_existencia").on("submit",  guardarExistencia);



function modalExistencias() {
	// $('#form_existencia')[0].reset();
	// $('#form_existencia').find("input[name=id_productos]").val($(this).data("id_productos"));
	
	let id_productos = $(this).data("id_productos");
	
	$.ajax({
		url: '../existencias/lista_existencias.php',
		data: { 
			"id_productos": id_productos
		}
		}).done(function (respuesta) {
		$('#lista_existencias').html(respuesta);
		
	});
	$('#descripcion').text($(this).data("descripcion"));
	$('#modal_existencia').modal('show');
	
}



function guardarExistencia(evt){
	console.log("guardarExistencia()")
	// evt.preventDefault();
	
	if(evt.key == "Enter"){
		
		let id_sucursal = $(this).data("id_sucursal");
		let id_productos = $(this).data("id_productos");
		let existencia = $(this).val();
		let textbox = $(this);
		// let $icono = $boton.find(".fas");
		
		// $boton.prop("disabled", true)
		textbox.toggleClass("cargando");
		
		$.ajax({
			url: '../existencias/guardar.php',
			method: 'POST',
			data:{
				
				"id_sucursal" :id_sucursal,
				"id_productos" : id_productos,
				"existencia" : existencia
			} 
			
			}).done(function (respuesta) {
			alertify.success("Guardado");
			}).always(function(){
			
			textbox.toggleClass("cargando");
			// $boton.prop("disabled", false)
			// $icono.toggleClass("fa-arrow-right fa-spinner fa-spin");
			
		}).fail();
		
	}
}
