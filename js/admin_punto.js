
// PUNTO
var id_punto_eliminar = '0';
var id_punto_editar = '0';
var bb_punto_editar = false;
function punto(){
	$('.title-page').html('Punto');
	$.ajax({
		url: base_url+'admin/listaPunto',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_punto();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de puntos del cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_punto(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_punto(\' Nuevo Punto\')"> Nuevo Punto</i>').appendTo('div.dataTables_wrapper');

	$(".chosen-select").chosen({
		allow_single_deselect: true, // permitir quitar seleccion
		disable_search_threshold: 0, //deshabilitar busqueda menos de 10 opciones
		no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
		width: '78%' //ancho selector
	});
}
function ver_ventana_punto(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_punto(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_punto(id_punto){
	var punto_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarPunto',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_punto': id_punto},
		success: function(res){
			if(res.clientes.length>0 & res.punto.length>0){
				res = res.punto[0];
				punto_info += '<label class="width2longcolmn infolabel">Cliente:</label><label class="width2longcolmn infolabeltext">'+res['nombreCliente']+' '+res['apPatCliente']+' '+res['apMatCliente']+'</label>';
				punto_info += '<label class="width2longcolmn infolabel">Descripci&oacute;n:</label><label class="width2longcolmn infolabeltext">'+res['descripcion']+'</label>';
				punto_info += '<label class="width2longcolmn infolabel">Cantidad:</label><label class="width2longcolmn infolabeltext">'+res['cantidad']+'</label>';
				punto_info += '<label class="width2longcolmn infolabel">Estado:</label><label class="width2longcolmn infolabeltext">'+res['estado']+'</label>';
				punto_info += '<label class="width2longcolmn infolabel">Fecha Registro:</label><label class="width2longcolmn infolabeltext">'+res['fecha_registro']+'</label>';
				punto_info += '<label class="width2longcolmn infolabel">Fecha Asignacion:</label><label class="width2longcolmn infolabeltext">'+res['fecha_asignacion']+'</label>';
				$(".message-view-content").html(punto_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_punto(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_punto(target){
	if(bb_punto_editar){
		editar_punto();
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/crearPunto',
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
					cerrar_ventana_punto();
					punto();
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
function ver_editar_punto(id_punto){
	bb_punto_editar = true;
	id_punto_editar = id_punto;
	$.ajax({
		url: base_url+'admin/seleccionarPunto',
		type: 'post',
		dataType: "json",
		cache:false,
		data: {'id_punto': id_punto_editar},
		success: function(res){
			if(res.clientes.length>0 & res.punto.length>0){
				//Create and append the options
				res.punto = res.punto[0];
				var container_select = '';
				for (var i = 0; i < res.clientes.length; i++) {
					container_select += '<option value="'+res.clientes[i]['id_cliente']+'"'+((res.clientes[i]['id_cliente']==res.punto.id_cliente) ? ' selected' : '')+'>';
					container_select += res.clientes[i]['nombre']+' '+res.clientes[i]['ap_pat']+' '+res.clientes[i]['ap_mat'];
					container_select += '</option>';
				}
				$('#id_cliente').html(container_select);
				$("#id_cliente").trigger("chosen:updated");
//				$('#id_cliente').val(res.punto['id_cliente']);
				$('#descripcion').val(res.punto['descripcion']);
				$('#cantidad').val(res.punto['cantidad']);
//				$('#estado').val(res.punto['estado']);
				if(res.punto['estado']=='sin asignar'){
					$("#sin_asignado").attr("selected","selected");
					$("#asignado").removeAttr("selected");
				}else{
					$("#sin_asignar").removeAttr("selected");
					$("#asignado").attr("selected","selected");
				}
				$('#fecha_registro').val(res.punto['fecha_registro']);
				$('#fecha_asignacion').val(res.punto['fecha_asignacion']);
				ver_ventana_punto(' Editar Punto');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_punto(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_punto(){
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'admin/actualizarPunto/'+id_punto_editar,
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
				bb_punto_editar = false;
				if(res == "true"){
					$("#btn-guardar").html('Guardar');
					$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
					$("#btn-guardar").prop('disabled', false); // enable button
					cerrar_ventana_punto();
					punto();
				} else {
					console.log('Error al subir datos',res);
					alert('Error al subir datos');
				}
				$("#btn-guardar").html('Guardar');
				$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
				$("#btn-guardar").prop('disabled', false); // enable button
			},
			error: function(e){
				bb_punto_editar = false;
				$("#btn-guardar").prop('disabled', false); // enable button
				console.log('ERROR:',e);
			}
		});
		return false;
	}catch(e){
		bb_punto_editar = false;
		console.warning('Error de envio:',e);
		return false;
	}
}
function ver_eliminar_punto(id_punto, titulo){
	id_punto_eliminar = id_punto;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_punto(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_punto(){
	$.ajax({
		url: base_url+'admin/eliminarPunto/'+id_punto_eliminar,
		type: 'post',
		data: {'id_punto':id_punto_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_punto();
			punto();
		},
		error: function(e){
			alert('Error al eliminar punto');
			console.log('ERROR:',e);
		}
	});
}
