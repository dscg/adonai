// NOTIFCACION
var id_notificacion_eliminar = '0';
var id_notificacion_editar = '0';
var bb_notificacion_editar = false;
function notificacion(){
	$('.title-page').html('Notifcacion');
	$.ajax({
		url: base_url+'admin/listaNotificacion',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_notificacion();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de notificaciones del cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_notificacion(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_notificacion(\' Nueva Notificacion\')"> Nueva Notificacion</i>').appendTo('div.dataTables_wrapper');
}
function ver_ventana_notificacion(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_notificacion(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_notificacion(id_notificacion){
	var notificacion_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarNotificacion',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_notificacion': id_notificacion},
		success: function(res){
			if(res.length>0){
				res = res[0];
				notificacion_info += '<label class="width2longcolmn infolabel">Titulo:</label><label class="width2longcolmn infolabeltext">'+res['titulo']+'</label>';
				notificacion_info += '<label class="width2longcolmn infolabel">Mensaje:</label><label class="width2longcolmn infolabeltext">'+res['mensaje']+'</label>';
				notificacion_info += '<label class="width2longcolmn infolabel">Cantidad Avisos por D&iacute;a:</label><label class="width2longcolmn infolabeltext">'+res['cantidad_avisos_dia']+'</label>';
				notificacion_info += '<label class="width2longcolmn infolabel">Fecha Inicio:</label><label class="width2longcolmn infolabeltext">'+res['fecha_inicio']+'</label>';
				notificacion_info += '<label class="width2longcolmn infolabel">Fecha Final:</label><label class="width2longcolmn infolabeltext">'+res['fecha_final']+'</label>';
				$(".message-view-content").html(notificacion_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_notificacion(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_notificacion(target){
	if(bb_notificacion_editar){
		editar_notificacion();
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/crearNotificacion',
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
					cerrar_ventana_notificacion();
					notificacion();
				} else {
					console.log('Error al subir datos',res);
					alert('Error al subir datos');
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
		return false;
	}catch(e){
		console.log('Error de envio:',e);
		return false;
	}
	return false;
}
function ver_editar_notificacion(id_notificacion){
	bb_notificacion_editar = true;
	id_notificacion_editar = id_notificacion;
	$.ajax({
		url: base_url+'admin/seleccionarNotificacion',
		type: 'post',
		dataType: "json",
		cache:false,
		data: {'id_notificacion': id_notificacion_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#titulo').val(res['titulo']);
				$('#mensaje').val(res['mensaje']);
				$('#cantidad_avisos_dia').val(res['cantidad_avisos_dia']);
				$('#fecha_inicio').val(res['fecha_inicio']);
				$('#fecha_final').val(res['fecha_final']);
				ver_ventana_notificacion(' Editar Notificacion');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_notificacion(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_notificacion(){
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarNotificacion/'+id_notificacion_editar,
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
				bb_notificacion_editar = false;
				if(res == "true"){
					$("#btn-guardar").html('Guardar');
					$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
					$("#btn-guardar").prop('disabled', false); // enable button
					cerrar_ventana_notificacion();
					notificacion();
				} else {
					console.log('Error al subir datos',res);
					alert('Error al subir datos');
				}
				$("#btn-guardar").html('Guardar');
				$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
				$("#btn-guardar").prop('disabled', false); // enable button
			},
			error: function(e){
				bb_notificacion_editar = false;
				$("#btn-guardar").prop('disabled', false); // enable button
				console.log('ERROR:',e);
			}
		});
		return false;
	}catch(e){
		bb_notificacion_editar = false;
		console.warning('Error de envio:',e);
		return false;
	}
}
function ver_eliminar_notificacion(id_notificacion, titulo){
	id_notificacion_eliminar = id_notificacion;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_notificacion(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_notificacion(){
	$.ajax({
		url: base_url+'admin/eliminarNotificacion/'+id_notificacion_eliminar,
		type: 'post',
		data: {'id_notificacion':id_notificacion_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_notificacion();
			notificacion();
		},
		error: function(e){
			alert('Error al eliminar notificacion');
			console.log('ERROR:',e);
		}
	});
}

