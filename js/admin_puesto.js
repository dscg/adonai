
// PUESTO
var id_puesto_eliminar = '0';
var id_puesto_editar = '0';
var bb_puesto_editar = false;
function puesto(){
	$('.title-page').html('Puesto');
	$.ajax({
		url: base_url+'admin/listaPuesto',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_puesto();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de puestoo</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_puesto(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_puesto(\' Nuevo Puesto\')"> Nuevo Puesto</i>').appendTo('div.dataTables_wrapper');
	document.getElementById("file").onchange = function () {
		var label = document.getElementById("file-label");
		var size_name = this.value.length;
		label.innerHTML = (size_name > 1) ? this.value.split( '\\' ).pop() : '<i class="fas fa-upload"></i> Seleccione un Archivo';
		label.style.backgroundColor = (size_name > 1) ? "rgba(44, 124, 222, 0.8)" : "rgba(111, 122, 133, 0.8)";
	};
}
function ver_ventana_puesto(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_puesto(){
	document.getElementById('form').reset();
	$("#file-label").html('<i class=\"fas fa-upload\"></i> Seleccione un Archivo');
	$("#file-label").css("background-color", "rgba(111, 122, 133, 0.8)");
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_puesto(id_puesto){
	var puesto_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarPuesto',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_puesto': id_puesto},
		success: function(res){
			if(res.length>0){
				res = res[0];
				puesto_info += '<label class="width2longcolmn infolabel">Nombre:</label><label class="width2longcolmn infolabeltext">'+res['nombre']+'</label>';
				puesto_info += '<label class="width2longcolmn infolabel">Numero:</label><label class="width2longcolmn infolabeltext">'+res['numero']+'</label>';
				puesto_info += '<label class="width2longcolmn infolabel">Tipo:</label><label class="width2longcolmn infolabeltext">'+res['tipo']+'</label>';
				puesto_info += '<center style="max-width:100%;"><img style="max-width:50%;height:auto;" src="'+base_url+'img/puesto/'+res['img']+'"></img></center>';
				$(".message-view-content").html(puesto_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_puesto(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_puesto(target){
	if(bb_puesto_editar){
		editar_puesto();
		return false;
	}
	try{
		var tag_img = $('#file');
		var archivos = tag_img[0].files;
		var form_data = new FormData();
		var exist_file = 'no';
		if (archivos.length > 0) {
			exist_file = 'si';
			var archivo = archivos[0];
			form_data.append('file', archivo);
		}
		form_data.append('exist_file', exist_file);
		form_data.append('nombre', document.getElementById('nombre').value);
		form_data.append('numero', document.getElementById('numero').value);
		form_data.append('tipo', document.getElementById('tipo').value);
		$.ajax({
			url: base_url+'admin/crearPuesto',
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
					cerrar_ventana_puesto();
					puesto();
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
		console.log('Error de envio:',e);
		return false;
	}
	return false;
}
function ver_editar_puesto(id_puesto){
	bb_puesto_editar = true;
	id_puesto_editar = id_puesto;
	$.ajax({
		url: base_url+'admin/seleccionarPuesto',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_puesto': id_puesto_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#nombre').val(res['nombre']);
				$('#numero').val(res['numero']);
				$('#tipo').val(res['tipo']);
				ver_ventana_puesto(' Editar Puesto');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_puesto(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_puesto(){
	try{
		//var formElement = document.getElementById("form");
		//var form_data = new FormData(formElement);
		var tag_img = $('#file');
		var archivos = tag_img[0].files;
		var form_data = new FormData();
		var exist_file = 'no';
		if (archivos.length > 0) {
			exist_file = 'si';
			var archivo = archivos[0];
			form_data.append('file', archivo);
		}
		form_data.append('exist_file', exist_file);
		form_data.append('nombre', document.getElementById('nombre').value);
		form_data.append('numero', document.getElementById('numero').value);
		form_data.append('tipo', document.getElementById('tipo').value);
		$.ajax({
			url: base_url+'admin/actualizarPuesto/'+id_puesto_editar,
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
					cerrar_ventana_puesto();
					bb_puesto_editar = false;
					puesto();
				} else {
					console.log('Error al guardar cambios',res);
					alert('Error al guardar cambios');
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
}
function ver_eliminar_puesto(id_puesto, titulo){
	id_puesto_eliminar = id_puesto;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_puesto(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_puesto(){
	$.ajax({
		url: base_url+'admin/eliminarPuesto/'+id_puesto_eliminar,
		type: 'post',
		data: {'id_puesto':id_puesto_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_puesto();
			puesto();
		},
		error: function(e){
			alert('Error al eliminar puesto');
			console.log('ERROR:',e);
		}
	});
}


