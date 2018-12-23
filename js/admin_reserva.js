
// RESERVA
var id_reserva_editar = '0';
var id_reserva_eliminar = '0';
var bb_reserva_editar = false;
function reserva(){
	$('.title-page').html('Reserva');
	$.ajax({
		url: base_url+'admin/listaReserva',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_reserva();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Error al generar vista de reserva</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_reserva(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_reserva(\' Nueva Reserva\')"> Nueva Reserva</i>').appendTo('div.dataTables_wrapper');

	$(".chosen-select").chosen({
		allow_single_deselect: true, // permitir quitar seleccion
		disable_search_threshold: 5, //deshabilitar busqueda menos de 10 opciones
		no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
		width: '78%', //ancho selector
		height: '5px' //alto selector
	});

	$('#hora').clockpicker({
		default: 'now',
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		donetext: 'Listo',
	});
	var date = new Date();
	$('#fecha')[0].valueAsDate = date;
	$('#hora').val(date.getHours()+':'+date.getMinutes());
}
function ver_ventana_reserva(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_reserva(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_reserva(id_reserva){
	var reserva_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarReserva',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_reserva': id_reserva},
		success: function(res){
			if(res.reserva.length>0 & res.servicios.length>0){
				res.reserva = res.reserva[0];
				console.log('res.reserva',res.reserva);
				reserva_info += '<label class="width2longcolmn infolabel">Cliente:</label><label class="width2longcolmn infolabeltext">'+res.reserva['nombreCliente']+' '+res.reserva['apPatCliente']+' '+res.reserva['apMatCliente']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Puesto:</label><label class="width2longcolmn infolabeltext">'+res.reserva['nombrePuesto']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Fecha:</label><label class="width2longcolmn infolabeltext">'+res.reserva['fecha']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Hora:</label><label class="width2longcolmn infolabeltext">'+res.reserva['hora']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Estado:</label><label class="width2longcolmn infolabeltext">'+res.reserva['estado']+'</label>';
				var tabla_servicios = '<label class="width2longcolmn infolabel">Servicios:</label><label class="width2longcolmn infolabeltext"></label><br/>'+
				'<center><table id="tabla-servicio" class="tabla-servicio width1colmn">'+
				'<caption>Lista servicios</caption>'+
				'<thead><tr><th>Nombre</th></tr></thead>'+
				'<tbody>';
				var bb_srv = false;
				res.servicios.forEach(function(element) {
					res.reserva_servicios.forEach(function(index) {
						if(index.id_servicio == element.id_servicio){
							bb_srv = true;
							tabla_servicios += '<tr>';
							tabla_servicios +=  '<td class="tabla-td colordarkslategray">'+element.nombre+'</td>';
							tabla_servicios +=  '</tr>';
						}
					});
				});
				tabla_servicios += '</tbody><tfoot></tfoot></table></center>';
				reserva_info += (bb_srv) ? tabla_servicios : '';
				$(".message-view-content").html(reserva_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_reserva(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}
function guardar_reserva(target){
	if(bb_reserva_editar){
		editar_reserva();
		return false;
	}
	try{
		//si es solo texto sin archivo
//		var formElement = document.getElementById("form");
//		var form_data = new FormData(formElement);
		var arg_srv_ids = JSON.parse($('#arg_srv_ids').html());
		var srv_ids = [];
		arg_srv_ids.forEach(function(element) {
			if ($('#id_srv'+element.id_servicio).is(':checked')){
				srv_ids.push({'id_servicio':element.id_servicio});
			}
		});
		var form_data = new FormData();
		form_data.append('id_cliente', $('#id_cliente').val());
		form_data.append('id_puesto', $('#id_puesto').val());
		form_data.append('fecha', $('#fecha').val());
		form_data.append('hora', $('#hora').val());
		form_data.append('estado', $('#estado').val());
		form_data.append('servicios', JSON.stringify(srv_ids));
		$.ajax({
			url: base_url+'admin/crearReserva',
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
					cerrar_ventana_reserva();
					reserva();
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
function ver_editar_reserva(id_reserva){
	bb_reserva_editar = true;
	id_reserva_editar = id_reserva;
	$.ajax({
		url: base_url+'admin/seleccionarReserva',
		type: 'post',
		dataType: "json",
		cache:false,
		data: {'id_reserva': id_reserva_editar},
		success: function(res){
			if(res.clientes.length>0 & res.puestos.length>0 & res.servicios.length>0 & res.reserva.length>0){
				res.reserva = res.reserva[0];
				var cliente_select = '';
				for (var i = 0; i < res.clientes.length; i++) {
					cliente_select += '<option value="'+res.clientes[i]['id_cliente']+'"'+((res.clientes[i]['id_cliente']==res.reserva.id_cliente) ? ' selected' : '')+'>';
					cliente_select += res.clientes[i]['nombre']+' '+res.clientes[i]['ap_pat']+' '+res.clientes[i]['ap_mat'];
					cliente_select += '</option>';
				}
				$('#id_cliente').html(cliente_select);
				$("#id_cliente").trigger("chosen:updated");
				var puesto_select = '';
				for (var i = 0; i < res.puestos.length; i++) {
					puesto_select += '<option value="'+res.puestos[i]['id_puesto']+'"'+((res.puestos[i]['id_puesto']==res.reserva.id_puesto) ? ' selected' : '')+'>';
					puesto_select += res.puestos[i]['nombre'];
					puesto_select += '</option>';
				}
				$('#id_puesto').html(puesto_select);
				$("#id_puesto").trigger("chosen:updated");
				$('#fecha').val(res.reserva['fecha']);
				$('#hora').val(res.reserva['hora']);
				$('#estado').val(res.reserva['estado']);
				var tabla_servicios = '';
				res.servicios.forEach(function(element) {
					var valor = '';
					res.reserva_servicios.forEach(function(index) {
						if(index.id_servicio == element.id_servicio){
							valor = ' checked ';
							return;
						}
					});
					tabla_servicios += '<tr>';
					tabla_servicios +=  '<td>'+element.nombre+'</td>';
					tabla_servicios +=  '<td class="tabla-td"><label for="id_srv'+element.id_servicio+'" class="width2colmn inputcheckbox">'+
					'<input type="checkbox" class="check-type-1" name="id_srv'+element.id_servicio+'" id="id_srv'+element.id_servicio+'" value="Si"'+valor+'/>'+
					'<i>No </i>'+
					'</td>';
					tabla_servicios +=  '</tr>';
				});
				$('#tabla-tbody-servicio').html(tabla_servicios);
				$('#arg_srv_ids').html(JSON.stringify(res.servicios));
				ver_ventana_reserva(' Editar Reserva');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_reserva(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_reserva(){
	try{
		//si es solo texto sin archivo
		var arg_srv_ids = JSON.parse($('#arg_srv_ids').html());
		var srv_ids = [];
		arg_srv_ids.forEach(function(element) {
			if ($('#id_srv'+element.id_servicio).is(':checked')){
				srv_ids.push({'id_servicio':element.id_servicio});
			}
		});
		var form_data = new FormData();
		form_data.append('id_cliente', $('#id_cliente').val());
		form_data.append('id_puesto', $('#id_puesto').val());
		form_data.append('fecha', $('#fecha').val());
		form_data.append('hora', $('#hora').val());
		form_data.append('estado', $('#estado').val());
		form_data.append('servicios', JSON.stringify(srv_ids));
		$.ajax({
			url: base_url+'admin/actualizarReserva/'+id_reserva_editar,
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
					cerrar_ventana_reserva();
					bb_reserva_editar = false;
					reserva();
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
function ver_eliminar_reserva(id_reserva, titulo){
	id_reserva_eliminar = id_reserva;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_reserva(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_reserva(){
	$.ajax({
		url: base_url+'admin/eliminarReserva/'+id_reserva_eliminar,
		type: 'post',
		data: {'id_reserva':id_reserva_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_reserva();
			reserva();
		},
		error: function(e){
			alert('Error al eliminar reserva');
			console.log('ERROR:',e);
		}
	});
}


