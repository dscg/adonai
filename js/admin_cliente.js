
// CLIENTE
var id_cliente_eliminar = '0';
var id_cliente_editar = '0';
var bb_cliente_editar = false;
function cliente(){
	$('.title-page').html('Cliente');
	$.ajax({
		url: base_url+'admin/listaCliente',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_cliente();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_cliente(){
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
	var op_cliente = '<i class="fas fa-plus-circle new-record" onClick="ver_ventana_cliente(\' Nuevo Cliente\')"> Nuevo Cliente</i>';
	var op_qr = '<i class="fas fa-plus-circle new-record" onClick="generar_qr_cliente()"> Pdf QR clientes</i>';
	$(op_cliente+op_qr).appendTo('div.dataTables_wrapper');
}
function ver_ventana_cliente(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_cliente(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_cliente(id_cliente){
	var cliente_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarCliente',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_cliente': id_cliente},
		success: function(res){
			if(res.length>0){
				res = res[0];
				cliente_info += '<label class="width2longcolmn infolabel">Nombre:</label><label class="width2longcolmn infolabeltext">'+res['nombre']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Apellido Paterno:</label><label class="width2longcolmn infolabeltext">'+res['ap_pat']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Apellido Materno:</label><label class="width2longcolmn infolabeltext">'+res['ap_mat']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Fecha Nacimiento:</label><label class="width2longcolmn infolabeltext">'+res['fecha_nac']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Carnet Identidad:</label><label class="width2longcolmn infolabeltext">'+res['ci']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Expedido:</label><label class="width2longcolmn infolabeltext">'+res['expedido']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Celular:</label><label class="width2longcolmn infolabeltext">'+res['celular']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Telefono:</label><label class="width2longcolmn infolabeltext">'+res['telefono']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Preferencia:</label><label class="width2longcolmn infolabeltext">'+res['preferencia']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">Observacion:</label><label class="width2longcolmn infolabeltext">'+res['observacion']+'</label>';
				cliente_info += '<label class="width2longcolmn infolabel">QR:</label><label class="width2longcolmn infolabeltext"> </label>';
				cliente_info += '<center style="max-width:100%;"><img style="max-width:50%;height:auto;" src="'+base_url+'img/cliente/'+res['id_cliente']+'_qr.png"></img></center>';
				$(".message-view-content").html(cliente_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_cliente(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_cliente(target){
	if(bb_cliente_editar){
		editar_cliente();
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/crearCliente',
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
					cerrar_ventana_cliente();
					cliente();
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
function ver_editar_cliente(id_cliente){
	bb_cliente_editar = true;
	id_cliente_editar = id_cliente;
	$.ajax({
		url: base_url+'admin/seleccionarCliente',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_cliente': id_cliente_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#nombre').val(res['nombre']);
				$('#ap_pat').val(res['ap_pat']);
				$('#ap_mat').val(res['ap_mat']);
				$('#fecha_nac').val(res['fecha_nac']);
				$('#ci').val(res['ci']);
				$('#expedido').val(res['expedido']);
				$('#celular').val(res['celular']);
				$('#telefono').val(res['telefono']);
				$('#preferencia').val(res['preferencia']);
				$('#observacion').val(res['observacion']);
				ver_ventana_cliente(' Editar Cliente');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_cliente(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_cliente(){
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarCliente/'+id_cliente_editar,
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
					cerrar_ventana_cliente();
					bb_cliente_editar = false;
					cliente();
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
		console.log('Error de envio:',e);
		return false;
	}
}
function ver_eliminar_cliente(id_cliente, titulo){
	id_cliente_eliminar = id_cliente;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_cliente(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_cliente(){
	$.ajax({
		url: base_url+'admin/eliminarCliente/'+id_cliente_eliminar,
		type: 'post',
		data: {'id_cliente':id_cliente_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_cliente();
			cliente();
		},
		error: function(e){
			alert('Error al eliminar cliente');
			console.log('ERROR:',e);
		}
	});
}

function generar_qr_cliente(){
	try{
		$.ajax({
			url: base_url+'admin/generarQrClientePdf',
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
				} else {
					console.log('Error al genrar',res);
					alert('Error al generar pdf de QR clientes');
				}
			},
			error: function(e){
				console.log('ERROR:',e);
			}
		});
		return false;
	}catch(e){
		console.log('Error de envio:',e);
		return false;
	}
}


