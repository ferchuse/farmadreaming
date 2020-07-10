$("#bodyProductos").on("click", ".btn_caducidad", modalCaducidad);
$("#lista_caducidad").on("click", ".btn_borrar", borrarCaducidad);
$("#form_caducidad").on("submit",  agregarCaducidad);


function modalCaducidad() {
	
	$('#form_caducidad').find("input[name=id_productos]").val($(this).data("id_productos"));
	listarCaducidad();
	$('#modal_caducidad').modal('show');
	
}

function listarCaducidad(){
	
	let id_productos = $('#form_caducidad').find("input[name=id_productos]").val();
	
	$.ajax({
		url: '../caducidad/lista_caducidad.php',
		data: { 
			"id_productos": id_productos
		}
		}).done(function (respuesta) {
		$('#lista_caducidad').html(respuesta);
		
	});
	
}

function agregarCaducidad(evt){
	
	evt.preventDefault();
	
	let $boton = $(this).find(":submit");
	let $icono = $boton.find(".fas");
	
	$boton.prop("disabled", true)
	$icono.toggleClass("fa-arrow-right fa-spinner fa-spin");
	
	$.ajax({
		url: '../caducidad/guardar.php',
		method: 'POST',
		data: $("#form_caducidad").serialize()
		
		}).done(function (respuesta) {
		
		listarCaducidad();
		}).always(function(){
		
		$boton.prop("disabled", false)
		$icono.toggleClass("fa-arrow-right fa-spinner fa-spin");
		
	});
	
}
function borrarCaducidad(evt){
	
	evt.preventDefault();
	
	let $id_registro = $(this).data("id_registro");
	let $boton = $(this);
	let $icono = $boton.find(".fas");
	
	$boton.prop("disabled", true)
	$icono.toggleClass("fa-trash fa-spinner fa-spin");
	
	$.ajax({
		url: '../funciones/fila_delete.php',
		method: 'POST',
		data: {
			"tabla": "caducidad" ,
			"id_campo": "id_caducidad",
			"id_valor": $id_registro 
		}
		
		}).done(function (respuesta) {
		
		listarCaducidad();
		}).always(function(){
		
		$boton.prop("disabled", false)
		$icono.toggleClass("fa-trash fa-spinner fa-spin");
		
	});
	
}

