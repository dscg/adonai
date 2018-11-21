
// SERVICIO
var id_producto_eliminar = '0';
var id_producto_editar = '0';
var bb_producto_editar = false;
function producto(){
	$('.title-page').html('Producto');
	$.ajax({
		url: base_url+'admin/listaProducto',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_producto();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de producto</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_producto(){
	var screen_height = $(window).height()-250;
	var table = $('#tabla').DataTable({
		bProcessing: true,
		scrollY: screen_height,
		lengthMenu: [
			[10, 25, 50, -1],
			['10 Lineas', '25 Lineas', '50 Lineas', 'Mostrar Todo']
		],
		language: lenguaje_es
	});
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_producto(\' Nuevo Producto\', \'required_img\')"> Nuevo Producto</i>').appendTo('div.dataTables_wrapper');
	document.getElementById("file").onchange = function () {
		var label = document.getElementById("file-label");
		var size_name = this.value.length;
		label.innerHTML = (size_name > 1) ? this.value.split( '\\' ).pop() : '<i class="fas fa-upload"></i> Seleccione un Archivo';
		label.style.backgroundColor = (size_name > 1) ? "rgba(44, 124, 222, 0.8)" : "rgba(111, 122, 133, 0.8)";
	};
}
function ver_ventana_producto(titulo_ventana, required){
	$('.window-popup').css('display', 'block');
	$('#file').attr("required", ((required == 'required_img') ? true: false));;
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_producto(){
	document.getElementById('form').reset();
	$("#file-label").html('<i class=\"fas fa-upload\"></i> Seleccione un Archivo');
	$("#file-label").css("background-color", "rgba(111, 122, 133, 0.8)");
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_producto(id_producto){
	var producto_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarProducto',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_producto': id_producto},
		success: function(res){
			if(res.length>0){
				res = res[0];
				producto_info += '<label class="width2longcolmn infolabel">Nombre:</label><label class="width2longcolmn infolabeltext">'+res['nombre']+'</label>';
				producto_info += '<label class="width2longcolmn infolabel">Precio:</label><label class="width2longcolmn infolabeltext">'+res['precio']+'</label>';
				producto_info += '<label class="width2longcolmn infolabel">Precio de Reserva:</label><label class="width2longcolmn infolabeltext">'+res['precio_reserva']+'</label>';
				producto_info += '<label class="width2longcolmn infolabel">Puntos del Cliente:</label><label class="width2longcolmn infolabeltext">'+res['puntos_cliente']+'</label>';
				producto_info += '<label class="width2longcolmn infolabel">Imagen:</label><label class="width2longcolmn infolabeltext">'+res['img']+'</label>';
				producto_info += '<center style="max-width:100%;"><img style="max-width:50%;height:auto;" src="'+base_url+'img/servicio/'+res['img']+'"></img></center>';
				$(".message-view-content").html(producto_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_producto(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_producto(target){
	if(bb_servicio_editar){
		editar_producto();
		return false;
	}
	try{
		var tag_img = $('#file');
		var archivos = tag_img[0].files;
		if (archivos.length > 0) {
			var archivo = archivos[0];
			var form_data = new FormData();
			form_data.append('file', archivo);
			form_data.append('nombre', document.getElementById('nombre').value);
			form_data.append('precio', document.getElementById('precio').value);
			form_data.append('precio_reserva', document.getElementById('precio_reserva').value);
			form_data.append('puntos_cliente', document.getElementById('puntos_cliente').value);
			$.ajax({
				url: base_url+'admin/crearProducto',
				type: 'post',
				data: form_data,
				contentType: false,
				processData: false,
				beforeSend: function() { 
					$("#btn-guardar").html('Subiendo ...');
					$("#btn-guardar").css('color','green');
					$("#btn-guardar").prop('disabled', true); // disable button
				},
				success: function(res){
					if(res == "true"){
						$("#btn-guardar").html('Guardar');
						$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
						$("#btn-guardar").prop('disabled', false); // enable button
						cerrar_ventana_servicio();
						servicio();
					} else {
						console.log('Error al subir archivo',res);
						alert('Error al subir archivo');
					}
					$("#btn-guardar").html('Guardar');
					$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
					$("#btn-guardar").prop('disabled', false); // enable button
				},
				error: function(e){
					$("#btn-guardar").prop('disabled', false); // enable button
					console.log('ERROR:',e);
				}
			});
		}
		return false;
	}catch(e){
		console.log('Error de envio:',e);
		return false;
	}
	return false;
}
function ver_editar_servicio(id_servicio){
	bb_servicio_editar = true;
	id_servicio_eliminar = id_servicio;
	$.ajax({
		url: base_url+'admin/seleccionarServicio',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_servicio': id_servicio_eliminar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#nombre').val(res['nombre']);
				$('#precio').val(res['precio']);
//				$('#file-label').val(res['img']);
				$('#precio_reserva').val(res['precio_reserva']);
				$('#puntos_cliente').val(res['puntos_cliente']);
				ver_ventana_servicio(' Editar Servicio', '');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_servicio(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_servicio(){
	try{
		console.log('editar_servicio');
		//var formElement = document.getElementById("form");
		//var form_data = new FormData(formElement);
		var tag_video = $('#file');
		var archivos = tag_video[0].files;
		var form_data = new FormData();
		var exist_file = 'no';
		if (archivos.length > 0) {
			exist_file = 'si';
			var archivo = archivos[0];
			form_data.append('file', archivo);
		}
		form_data.append('exist_file', exist_file);
		form_data.append('nombre', document.getElementById('nombre').value);
		form_data.append('precio', document.getElementById('precio').value);
		form_data.append('precio_reserva', document.getElementById('precio_reserva').value);
		form_data.append('puntos_cliente', document.getElementById('puntos_cliente').value);
		$.ajax({
			url: base_url+'admin/actualizarServicio/'+id_servicio_eliminar,
			type: 'post',
			data: form_data,
			contentType: false,
			processData: false,
			beforeSend: function() { 
				$("#btn-guardar").html('Subiendo ...');
				$("#btn-guardar").css('color','green');
				$("#btn-guardar").prop('disabled', true); // disable button
			},
			success: function(res){
				bb_servicio_editar = false;
				if(res == "true"){
					$("#btn-guardar").html('Guardar');
					$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
					$("#btn-guardar").prop('disabled', false); // enable button
					cerrar_ventana_servicio();
					servicio();
				} else {
					console.log('Error al subir archivo',res);
					alert('Error al subir archivo');
				}
				$("#btn-guardar").html('Guardar');
				$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
				$("#btn-guardar").prop('disabled', false); // enable button
			},
			error: function(e){
				bb_servicio_editar = false;
				$("#btn-guardar").prop('disabled', false); // enable button
				console.log('ERROR:',e);
			}
		});
		return false;
	}catch(e){
		bb_servicio_editar = false;
		console.warning('Error de envio:',e);
		return false;
	}
}
function ver_eliminar_servicio(id_servicio, titulo){
	id_servicio_eliminar = id_servicio;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_servicio(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_servicio(){
	$.ajax({
		url: base_url+'admin/eliminarServicio/'+id_servicio_eliminar,
		type: 'post',
		data: {'id_servivio':id_servicio_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_servicio();
			servicio();
		},
		error: function(e){
			alert('Error al eliminar servicio');
			console.log('ERROR:',e);
		}
	});
}


