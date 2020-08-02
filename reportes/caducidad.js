$("#form_reporte").on("submit",  listarCaducidad);
$("#form_reporte").submit();


function listarCaducidad(event){
	event.preventDefault();
	
	$.ajax({
		url: 'lista_caducidad.php',
		data:{ 
			"dias": $("#dias").val()
			}
		}).done(function (respuesta) {
		$('#lista_caducidad').html(respuesta);
		
	});
	
}


