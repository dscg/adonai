var lenguaje_es = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
};

// VIDEO
var id_video_eliminar = '0';
function ver_mensaje_video(id_video, titulo){
	id_video_eliminar = id_video;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar el video '+titulo+'?');
}
function cerrar_mensaje_video(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_video(){
	$.ajax({
		url: base_url+'admin/eliminarVideo/'+id_video_eliminar,
		type: 'post',
		data: {'id_video':id_video_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_mensaje_video();
			video();
		},
		error: function(e){
			alert('Error al eliminar video');
			console.log('ERROR:',e);
		}
	});
}
function lista_video(){
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
	$('<i class="fas fa-plus-circle new-video" onClick="ver_ventana_video()"> Subir Video</i>').appendTo('div.dataTables_wrapper');
	var inputfile = 2;
	document.getElementById("file").onchange = function () {
		var label = document.getElementById("file-label");
		var size_name = this.value.length;
		label.innerHTML = (size_name > 1) ? this.value.split( '\\' ).pop() : '<i class="fas fa-upload"></i> Seleccione un Archivo';
		label.style.backgroundColor = (size_name > 1) ? "rgba(44, 124, 222, 0.8)" : "rgba(111, 122, 133, 0.8)";
	};
}
function ver_ventana_video(){
	$('.window-popup').css('display','block');
}
function cerrar_ventana_video(){
	document.getElementById('form').reset();
	$("#file-label").html('<i class=\"fas fa-upload\"></i> Seleccione un Archivo');
	$("#file-label").css("background-color", "rgba(111, 122, 133, 0.8)");
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function subir_video(target){
	try{
		var tag_video = $('#file');
		var archivos = tag_video[0].files;
		if (archivos.length > 0) {
			var archivo = archivos[0];
			var form_data = new FormData();
			form_data.append('file', archivo);
			form_data.append('title', document.getElementById('title').value);
			$.ajax({
				url: target.getAttribute('action'),
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
						cerrar_ventana_video();
						video();
					} else if(res == "existe_video"){
						alert("Existe un video con el mismo nombre de ruta");
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
	}catch(e){return false;}
	return false;
}

// PERSONAL
var id_personal_eliminar = '0';
function ver_eliminar_personal(id_personal, titulo){
	id_personal_eliminar = id_personal;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_personal(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_personal(){
	$.ajax({
		url: base_url+'admin/eliminarPersonal/'+id_personal_eliminar,
		type: 'post',
		data: {'id_personal':id_personal_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_mensaje_per();
			personal();
		},
		error: function(e){
			alert('Error al eliminar personal');
			console.log('ERROR:',e);
		}
	});
}

function lista_personal(){
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
	$('<i class="fas fa-plus-circle new-personal" onClick="ver_ventana_personal()"> Nuevo Personal</i>').appendTo('div.dataTables_wrapper');
}
function ver_ventana_personal(){
	$('.window-popup').css('display','block');
}
function cerrar_ventana_personal(){
	document.getElementById('form').reset();
	$("#file-label").html('<i class=\"fas fa-upload\"></i> Seleccione un Archivo');
	$("#file-label").css("background-color", "rgba(111, 122, 133, 0.8)");
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function guardar_personal(target){
	try{
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
/*
		form_data.append('nombre', document.getElementById('nombre').value);
		form_data.append('ap_pat', document.getElementById('nombre').value);
		form_data.append('ap_mat', document.getElementById('nombre').value);
		form_data.append('email', document.getElementById('nombre').value);
		form_data.append('telefono', document.getElementById('nombre').value);
		form_data.append('celular', document.getElementById('nombre').value);
		form_data.append('celular', document.getElementById('nombre').value);
		form_data.append('celular', document.getElementById('nombre').value);
		form_data.append('celular', document.getElementById('nombre').value);
*/
		$.ajax({
			url: target.getAttribute('action'),
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
					cerrar_ventana_personal();
					personal();
				} else {
					console.log('Error al guardar',res);
					alert('Error al guardar');
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
		console.warning('Error de envio:',e);
		return false;
	}
	return false;
}
