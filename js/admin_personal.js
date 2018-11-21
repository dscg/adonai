
// PERSONAL
var id_personal_eliminar = '0';
var id_personal_editar = '0';
var bb_personal_editar = false;
function personal(){
	$('.title-page').html('Personal');
	$.ajax({
		url: base_url+'admin/listaPersonal',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_personal();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de personal</center>';
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
function ver_info_personal(id_personal){
	var personal_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarPersonal',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_personal': id_personal},
		success: function(res){
			if(res.length>0){
				res = res[0];
				personal_info += '<label class="width2longcolmn infolabel">Nombre:</label><label class="width2longcolmn infolabeltext">'+res['nombre']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Apellido Paterno:</label><label class="width2longcolmn infolabeltext">'+res['ap_pat']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Apellido Materno:</label><label class="width2longcolmn infolabeltext">'+res['ap_mat']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Email:</label><label class="width2longcolmn infolabeltext">'+res['email']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Telefono:</label><label class="width2longcolmn infolabeltext">'+res['telefono']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Celular:</label><label class="width2longcolmn infolabeltext">'+res['celular']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Genero:</label><label class="width2longcolmn infolabeltext">'+res['genero']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Carnet de Indentidad:</label><label class="width2longcolmn infolabeltext">'+res['ci']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Lugar de Expedido C.I:</label><label class="width2longcolmn infolabeltext">'+res['expedido']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Fecha Nacimiento:</label><label class="width2longcolmn infolabeltext">'+res['fecha_nacimiento']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Fecha Inicio:</label><label class="width2longcolmn infolabeltext">'+res['fecha_inicio']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Direccion:</label><label class="width2longcolmn infolabeltext">'+res['direccion']+'</label>';
				$(".message-view-content").html(personal_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_personal(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_personal(target){
	if(bb_personal_editar){
		editar_personal();
		return false;
	}
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
			url: base_url+'admin/crearPersonal',
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
function ver_editar_personal(id_personal){
	bb_personal_editar = true;
	id_personal_editar = id_personal;
	//console.log('id_personal_editar',id_personal_editar);
	$.ajax({
		url: base_url+'admin/seleccionarPersonal',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_personal': id_personal_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				//console.log('res',res);
//				console.log('res[0]',res[0]);
//				console.log('res["nombre"]',res['nombre']);
//				console.log('res.nombre',res.nombre);
				$('#nombre').val(res['nombre']);
				$('#ap_pat').val(res['ap_pat']);
				$('#ap_mat').val(res['ap_mat']);
				$('#email').val(res['email']);
				$('#telefono').val(res['telefono']);
				$('#celular').val(res['celular']);
				$("#genero_m").attr('checked', (res['genero']=='Masculino') ? true : false);
				$("#genero_f").attr('checked', (res['genero']!='Masculino') ? true : false);
				//$('#genero').val(res['genero']);
				$('#ci').val(res['ci']);
				$("#expedido").attr('selected', (res['expedido']=='Beni') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Chuquisaca') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Cochabamba') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='La Paz') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Oruro') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Pando') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Potosi') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Santa Cruz') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Tarija') ? 'selected' : '');
				$("#expedido").attr('selected', (res['expedido']=='Extranjero') ? 'selected' : '');
				$('#expedido').val(res['expedido']);
				$('#fecha_nacimiento').val(res['fecha_nacimiento']);
				$('#fecha_inicio').val(res['fecha_inicio']);
				$('#direccion').val(res['direccion']);
				ver_ventana_personal();
			} else {alert('No es posible editar');}
//			cerrar_eliminar_personal();
//			personal();
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
//	$('.message-popup').css('display','block');
//	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_editar_personal(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_personal(){
	try{
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarPersonal/'+id_personal_editar,
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
					bb_personal_editar = false;
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
}
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
			cerrar_eliminar_personal();
			personal();
		},
		error: function(e){
			alert('Error al eliminar personal');
			console.log('ERROR:',e);
		}
	});
}


