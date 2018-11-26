
// RESERVA
var id_reserva_editar = '0';
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
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de reserva</center>';
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
		data: {'id_reserva_config': id_reserva},
		success: function(res){
			if(res.length>0){
				res = res[0];
				reserva_info += '<label class="width2longcolmn infolabel">Cantidad para Bloqueo:</label><label class="width2longcolmn infolabeltext">'+res['cantidad_bloqueo']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Tiempo para Recordatorio:</label><label class="width2longcolmn infolabeltext">'+res['tiempo_recordatorio']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Tiempo Cancelar Reserva:</label><label class="width2longcolmn infolabeltext">'+res['tiempo_cancelar']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Avisos D&iacute;a:</label><label class="width2longcolmn infolabeltext">'+res['cantidad_avisos_dia']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Titulo:</label><label class="width2longcolmn infolabeltext">'+res['titulo']+'</label>';
				reserva_info += '<label class="width2longcolmn infolabel">Mensaje:</label><label class="width2longcolmn infolabeltext">'+res['mensaje']+'</label>';
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

function ver_editar_reserva(id_reserva){
	id_reserva_editar = id_reserva;
	$.ajax({
		url: base_url+'admin/seleccionarReserva',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_reserva_config': id_reserva_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#cantidad_bloqueo').val(res['cantidad_bloqueo']);
				$('#tiempo_recordatorio').val(res['tiempo_recordatorio']);
				$('#tiempo_cancelar').val(res['tiempo_cancelar']);
				$('#cantidad_avisos_dia').val(res['cantidad_avisos_dia']);
				$('#titulo').val(res['titulo']);
				$('#mensaje').val(res['mensaje']);
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
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
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
		console.warning('Error de envio:',e);
		return false;
	}
}
