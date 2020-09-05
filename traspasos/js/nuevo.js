
var producto_elegido ;

function beforePrint() {
	//
}
function afterPrint() {
	
	
	window.location.reload(true);
	
}

//Funciona a llamar si ha terminado de imprimir
if (window.matchMedia) {
	var mediaQueryList = window.matchMedia('print');
	mediaQueryList.addListener(function(mql) {
		if (mql.matches) {
			beforePrint();
		} 
		else {
			afterPrint();
		}
	});
}

// window.onbeforeprint = beforePrint;
//window.onafterprint = afterPrint;
function buscarDescripcion(){
	var indice = $(this).data("indice");
	var valor_filtro = $(this).val();
	
	var num_rows = buscar(valor_filtro,'tabla_productos',indice);
	
	$("#cantidad_productos").text(num_rows);
	
	if(num_rows == 0){
		$('#mensaje').html("<div class='alert alert-warning text-center'><strong>No se ha encontrado.</strong></div>");
		}else{
		$('#mensaje').html('');
	}
}

$(document).ready(function(){
	
	// Editar Compras
	if($("#id_compras").val()){
		
		$.ajax({
			url: "compras_detalle.php",
			data: {
				
				id_compras: $("#id_compras").val()
				
			}
			
			}).done(function(respuesta){
			
			for(let producto of respuesta.productos ){
				
				
				
				agregarProducto(producto);
			}
			console.log("compras_detalle", respuesta)
			
		});
		
		
	}
	
	$('#codigo_producto').keypress( buscarCodigo );
	
	// $("#piezas").keyup(calcularCostoUnitario);
	
	$('#form_granel').submit(agregarGranel);
	$('#form_agregar_producto').submit(function(event){
		
		event.preventDefault();
	});
	
	$('#cerrar_venta').click( guardarTraspaso);
	
	$("#cantidad").on("keyup", calcularGranel)
	$("#importe").on("keyup", calcularGranel);
	
	$("input").focus( function selecciona_input(){
		$(this).select();
	});
	
	$("#modal_granel").on("shown.bs.modal", function () { 
		$("#cantidad").focus();
	});
	
	
	
	//Autocomplete Productos https://github.com/devbridge/jQuery-Autocomplete
	$("#buscar_producto").autocomplete({
		serviceUrl: "consultas/productos_autocomplete.php",   
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			if(eleccion.data.unidad_productos == 'KG'){
				$("#precio_mayoreo").val(eleccion.data.precio_mayoreo);
				$("#precio_menudeo").val(eleccion.data.precio_menudeo);
				$("#precio").val(eleccion.data.costo_proveedor);
				
				$("#modal_granel").modal("show");
				$("#importe").val(eleccion.data.costo_proveedor * 1);
				producto_elegido = eleccion.data;
				$("#buscar_producto").val("");
				$("#buscar_producto").focus();
			} 
			else{ 
				
				agregarProducto(eleccion.data)
				// $("#codigo_producto").focus(); 
				
			}
			
			// $("#tel_clientes").val(eleccion.data.tel_clientes)
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	
});




function buscarCodigo(event){
	if(event.which == 13){
		if($(this).val() == ""){
			alertify.error("Escribe un Código");
			return;
		}
		console.log("buscarCodigo()");
		var input = $(this);
		// input.prop('disabled',true);
		input.toggleClass('ui-autocomplete-loading');
		var codigoProducto = $(this).val();
		$.ajax({
			url: "productos_autocomplete.php",
			dataType: "JSON",
			method: 'GET',
			data: {
				tabla:'productos', 
				campo:'codigo_productos', 
				query: codigoProducto
			}
			}).done(function terminabuscarCodigo(respuesta){
			
			if(respuesta.suggestions.length >= 1){
				console.log("Producto Encontrado");
				producto_elegido = respuesta.suggestions[0]["data"];
				
				if(producto_elegido.unidad_productos == 'PZA'){//Si el producto se vende por pieza
					
					producto_elegido.importe= producto_elegido.precioventa_menudeo_productos;
					producto_elegido.cantidad=1 ;
					agregarProducto(producto_elegido);
					$("#codigo_producto").focus();
					
				}
				else if(producto_elegido.unidad_productos == 'KG'){ //Si el producto se vende a granel
					$('#modal_granel').modal('show');
					
					$('#unidad_granel').val(1);
					$('#costo_granel').val(producto_elegido.precio_menudeo);
					$('#costoventa_granel').text('$ '+ producto_elegido.precioventa_menudeo_productos);
					
				}
				$('#form_agregar_producto')[0].reset();		
			}
			else{
				alertify.error('Código no Encontrado');
			}
			
			}).always(function(){
			
			input.toggleClass('ui-autocomplete-loading');
			input.prop('disabled',false);
			input.focus();
		});
	} 
}


function calcularGranel(event){
	let precio = Number($("#precio").val());
	let cantidad = Number($("#cantidad").val());
	console.log("target",event.target.id)
	
	let importe = precio * cantidad;
	
	if(event.target.id == 'cantidad'){ 
		
		$("#importe").val(importe.toFixed(2))
	}
	else{
		importe = Number($("#importe").val());
		cantidad = importe / precio;
		
		$("#cantidad").val(cantidad.toFixed(3))
		
	}
	console.log("importe",importe )
}

function agregarGranel(event){
	event.preventDefault();
	
	producto_elegido.cantidad = $("#cantidad").val();
	$("#modal_granel").modal("hide");
	agregarProducto(producto_elegido);
	
	$("#buscar_producto").focus();
}


function agregarProducto(producto){
	console.log("agregarProducto()", producto);
	
	let articulos = $("#tabla_venta tbody tr").size();
	if(!producto.cantidad){
		
		producto.cantidad = 1;
	}
	
	//Buscar por id_productos, si se encuentra agregar 1 unidad sino agregar nuevo producto
	console.log("Buscando id_productos = ", producto.id_productos);
	var $existe= $(".id_productos[value='"+producto.id_productos+"']");
	console.log("existe", $existe);
	
	if($existe.length > 0){
		console.log("El producto ya existe");
		let cantidad_anterior = Number($existe.closest("tr").find(".cantidad").val());
		console.log("cantidad_anterior", cantidad_anterior)
		cantidad_nueva = cantidad_anterior+ 1;
		console.log("cantidad_nueva", cantidad_nueva)
		
		$existe.closest("tr").find(".cantidad").val(cantidad_nueva);
	}
	else{
		console.log("El producto no existe, agregarlo a la tabla");
		$fila_producto = `<tr>
		<td class="col-sm-1">
		<input hidden class="id_productos"  value="${producto['id_productos']}">
		<input hidden class="existencia_anterior"  value='${producto['existencia_productos']}'>
		<input hidden class="descripcion" value='${producto['descripcion_productos']}'>
		<input hidden class="precio_mayoreo" value='${producto['precio_mayoreo']}'>
		<input type="number"  step="any" class="cantidad form-control text-right"  value='${producto['cantidad']}'>
		</td>
		<td class="text-center">${producto['unidad_productos']}</td> 
		<td class="text-center">${producto['descripcion_productos']}</td>
		
		<td class="col-sm-1">	
		<input class=" form-control" readonly  value='${producto['san_sebas']}'> 
		</td>
		<td class="col-sm-1">	
		<input class=" form-control" readonly  value='${producto['zumpango']}'> 
		</td>
		<td class="col-sm-1">	
		<input class="existencia_anterior form-control" readonly  value='${producto['existencia_total']}'> 
		</td>
		<td class="text-center">
		<button title="Eliminar Producto" class="btn btn-danger btn_eliminar">
		<i class="fa fa-trash"></i>
		</button> 
		</td>
		</tr>`;
		
		$("#tabla_venta tbody").append($fila_producto);
		
		//Asigna Callbacks de eventos
		$(".cantidad").keyup(sumarImportes);
		$(".cantidad").change(sumarImportes);
		$(".precio").on("keyup", sumarImportes);
		$(".precio").on("change", sumarImportes);
		
		$("input").focus(function(){
			$(this).select();
		});
		$(".btn_eliminar").click(eliminarProducto);
		
		
	}
	$("#buscar_producto").val("");
	
	alertify.success("Producto Agregado")
	
	sumarImportes();
	
	
	
}

function guardarTraspaso(event){
	event.preventDefault();
	console.log("guardarVenta");
	if($("#tabla_venta tbody tr").length != 0){
		var boton = $(this);
		var icono = boton.find('.fa');
		boton.prop('disabled',true);
		icono.toggleClass('fa fa-usd fa fa-spinner fa-pulse fa-fw');
		
		
		var productos = []; 
		
		$("#tabla_venta tbody tr").each(function(index, item){
			productos.push({
				"id_productos": $(item).find(".id_productos").val(),
				"cantidad": $(item).find(".cantidad").val(),
				"descripcion": $(item).find(".descripcion").val()
			})
		});
		
		$.ajax({
			url: 'consultas/guardar.php',
			method: 'POST',
			dataType: 'JSON',
			data:{
				origen: $('#origen').val(),
				destino: $('#destino').val(),
				articulos: $('#articulos').val(),
				productos: productos
			}
			}).done(function(respuesta){
			if(respuesta.estatus_venta == "success"){
				alertify.success('Traspaso Guardado');
				
				imprimirTraspaso( respuesta.folio)
				// window.location.href="index.php";
				
			}
			}).always(function(){
			boton.prop('disabled',false);
			icono.toggleClass('fa fa-usd fa fa-spinner fa-pulse fa-fw');
		});
	}
	else{
		alertify.error('No hay productos');
	}
	
}




function eliminarProducto(){
	// var indice =$(".btn_eliminar").index($(this));
	// $('#ticket tr').eq(indice).remove();
	
	$(this).closest("tr").remove();
	
	
	
	sumarImportes(tabla_venta);
	
	
}
$("input").focus(function(){
	$(this).select();
	
});


function sumarImportes(){
	console.log("sumarImportes");
	var total = 0;
	let articulos = 0;
	$(".id_productos").each(function(indice, fila ){
		let cantidad = Number($(this).closest("tr").find(".cantidad").val());
		let precio = Number($(this).closest("tr").find(".precio").val());
		
		
		articulos+= cantidad;
		importe= cantidad * precio;
		total+= importe;
		$(this).closest("tr").find(".importe").val(importe.toFixed(2))
	});
	
	$("#articulos").val(articulos);
	
}



function buscar(filtro,table_id,indice) {
	// Declare variables 
	var  filter, table, tr, td, i;
	filter = filtro.toUpperCase();
	table = document.getElementById(table_id);
	tr = table.getElementsByTagName("tr");
	
	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[indice];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
				} else {
				tr[i].style.display = "none";
			}
		} 
	}
	var num_rows = $(table).find('tbody tr:visible').length; 
	return num_rows;
}

function imprimirTraspaso (folio){
	console.log("imprimirTraspaso()");
	
	$.ajax({
		url: "impresion/imprimir_traspaso.php" ,
		data:{
			"folio" : folio
		}
		}).done(function (respuesta){
		
		printService.submit({
			'type': 'LABEL',
			'raw_content': respuesta
		});
		}).always(function(){
		
	});
}	