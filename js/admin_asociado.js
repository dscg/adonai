
// ASOCIADOS
var id_asociado_eliminar = '0';
var id_asociado_editar = '0';
var bb_asociado_editar = false;
function asociado(){
	$('.title-page').html('Asociado');
	$.ajax({
		url: base_url+'admin/listaAsociado',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_asociado();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de asociados</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_asociado(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_asociado(\' Nuevo Asociado\')"> Nuevo Asociado</i>').appendTo('div.dataTables_wrapper');
	$(".chosen-select").chosen({
		allow_single_deselect: true, // permitir quitar seleccion
		disable_search_threshold: 0, //deshabilitar busqueda menos de 10 opciones
		no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
		width: '78%' //ancho selector
	});
}
function ver_ventana_asociado(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_asociado(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_asociado(id_asociado){
	var asociado_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarAsociado',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_asociado': id_asociado},
		success: function(res){
			if(res.length>0){
				res = res[0];
				asociado_info += '<label class="width2longcolmn infolabel">Nombre:</label><label class="width2longcolmn infolabeltext">'+res['nombre']+'</label>';
				asociado_info += '<label class="width2longcolmn infolabel">Fecha Inicio:</label><label class="width2longcolmn infolabeltext">'+res['fecha_inicio']+'</label>';
				asociado_info += '<label class="width2longcolmn infolabel">Fecha Final:</label><label class="width2longcolmn infolabeltext">'+res['fecha_final']+'</label>';
				asociado_info += '<label class="width2longcolmn infolabel">Total integrantes:</label><label class="width2longcolmn infolabeltext">'+res['total_integrantes']+'</label>';
				$(".message-view-content").html(asociado_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_asociado(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_asociado(target){
	if(bb_asociado_editar){
		editar_asociado();
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/crearAsociado',
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
					cerrar_ventana_asociado();
					asociado();
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
function ver_editar_asociado(id_asociado){
	bb_asociado_editar = true;
	id_asociado_editar = id_asociado;
	$.ajax({
		url: base_url+'admin/seleccionarAsociado',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_asociado': id_asociado_editar},
		success: function(res){
			if(res.length){
				res = res[0];
				$('#nombre').val(res['nombre']);
				$('#fecha_inicio').val(res['fecha_inicio']);
				$('#fecha_final').val(res['fecha_final']);
				$('#total_integrantes').val(res['total_integrantes']);
				ver_ventana_asociado(' Editar Asociado');
			} else {alert('No es posible editar'); console.log(res);}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_asociado(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_asociado(){
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarAsociado/'+id_asociado_editar,
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
					cerrar_ventana_asociado();
					bb_asociado_editar = false;
					asociado();
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
function ver_eliminar_asociado(id_asociado, titulo){
	id_asociado_eliminar = id_asociado;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_asociado(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_asociado(){
	$.ajax({
		url: base_url+'admin/eliminarAsociado/'+id_asociado_eliminar,
		type: 'post',
		data: {'id_asociado':id_asociado_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_asociado();
			asociado();
		},
		error: function(e){
			alert('Error al eliminar asociado');
			console.log('ERROR:',e);
		}
	});
}
function msg(c){
	alert(c);
}


