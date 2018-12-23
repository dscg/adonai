
// CONFIGURACION
var id_configuracion_editar = '0';
function configuracion(){
	$('.title-page').html('Configuracion');
	$.ajax({
		url: base_url+'admin/listaConfiguracion',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_configuracion();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de configuracion del cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_configuracion(){
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
function ver_ventana_configuracion(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_configuracion(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_configuracion(id_configuracion){
	var configuracion_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarConfiguracion',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_configuracion': id_configuracion},
		success: function(res){
			if(res.length>0){
				res = res[0];
				console.log('res',res);
				configuracion_info += '<label class="width2longcolmn infolabel">Meses de Antiguedad:</label><label class="width2longcolmn infolabeltext">'+res['prom_meses_antiguedad']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Cantidad de Dependientes para Pormociones:</label><label class="width2longcolmn infolabeltext">'+res['prom_cantidad_dependientes']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Cantidad para Bloqueo:</label><label class="width2longcolmn infolabeltext">'+res['res_cantidad_bloqueo']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Tiempo para Recordatorio:</label><label class="width2longcolmn infolabeltext">'+res['res_tiempo_recordatorio']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Tiempo Cancelar Reserva:</label><label class="width2longcolmn infolabeltext">'+res['res_tiempo_cancelar']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Avisos D&iacute;a:</label><label class="width2longcolmn infolabeltext">'+res['res_cantidad_avisos_dia']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Titulo:</label><label class="width2longcolmn infolabeltext">'+res['res_titulo']+'</label>';
				configuracion_info += '<label class="width2longcolmn infolabel">Mensaje:</label><label class="width2longcolmn infolabeltext">'+res['res_mensaje']+'</label>';
				$(".message-view-content").html(configuracion_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_configuracion(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function ver_editar_configuracion(id_configuracion){
	id_configuracion_editar = id_configuracion;
	$.ajax({
		url: base_url+'admin/seleccionarConfiguracion',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_configuracion': id_configuracion_editar},
		success: function(res){
			if(res.length>0){
				res = res[0];
				$('#prom_meses_antiguedad').val(res['prom_meses_antiguedad']);
				$('#prom_cantidad_dependientes').val(res['prom_cantidad_dependientes']);
				$('#res_cantidad_bloqueo').val(res['res_cantidad_bloqueo']);
				$('#res_tiempo_recordatorio').val(res['res_tiempo_recordatorio']);
				$('#res_tiempo_cancelar').val(res['res_tiempo_cancelar']);
				$('#res_cantidad_avisos_dia').val(res['res_cantidad_avisos_dia']);
				$('#res_titulo').val(res['res_titulo']);
				$('#res_mensaje').val(res['res_mensaje']);
				ver_ventana_configuracion(' Editar Configuracion');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_configuracion(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_configuracion(that){
	try{
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarConfiguracion/'+id_configuracion_editar,
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
					cerrar_ventana_configuracion();
					configuracion();
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
		console.warning('Error de envio:',e);
		return false;
	}
}
