// PROOCION
var id_promocion_eliminar = '0';
var id_promocion_editar = '0';
var bb_promocion_editar = false;
function promocion(){
	$('.title-page').html('Promocion');
	$.ajax({
		url: base_url+'admin/listaPromocion',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_promocion();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de promociones del cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_promocion(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_promocion(\' Nueva Promocion\')"> Nueva Promocion</i>').appendTo('div.dataTables_wrapper');

	$(".chosen-select").chosen({
		allow_single_deselect: true, // permitir quitar seleccion
		disable_search_threshold: 5, //deshabilitar busqueda menos de 10 opciones
		no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
		width: '78%', //ancho selector
		height: '5px' //alto selector
	});

	// Add select/deselect all toggle to optgroups in chosen
	$(document).on('click', '.group-result', function() {
		// Get unselected items in this group
		var unselected = $(this).nextUntil('.group-result').not('.result-selected');
		if(unselected.length) {
			// Select all items in this group
			unselected.trigger('mouseup');
		} else {
			$(this).nextUntil('.group-result').each(function() {
				// Deselect all items in this group
				$('a.search-choice-close[data-option-array-index="' + $(this).data('option-array-index') + '"]').trigger('click');
			});
		}
	});
}
function ver_ventana_promocion(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_promocion(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_promocion(id_promocion){
	var promocion_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarPromocion',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_promocion': id_promocion},
		success: function(res){
			if(res.promocion.length>0 & res.productos.length>0 & res.servicios.length>0){
				res.promocion = res.promocion[0];
				promocion_info += '<label class="width2longcolmn infolabel">Titulo:</label><label class="width2longcolmn infolabeltext">'+res.promocion['titulo']+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Mensaje:</label><label class="width2longcolmn infolabeltext">'+res.promocion['mensaje']+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Autonotificar:</label><label class="width2longcolmn infolabeltext">'+((res.promocion['auto_notificar']=='Si') ? 'Si' : 'No')+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Fecha Inicio:</label><label class="width2longcolmn infolabeltext">'+res.promocion['fecha_inicio']+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Fecha Final:</label><label class="width2longcolmn infolabeltext">'+res.promocion['fecha_final']+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Monto Descuento:</label><label class="width2longcolmn infolabeltext">'+res.promocion['monto_descuento']+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Descuento por Antiguedad:</label><label class="width2longcolmn infolabeltext">'+((res.promocion['por_antiguedad']=='Si') ? 'Si' : 'No')+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Descuento por Cumpleanios:</label><label class="width2longcolmn infolabeltext">'+((res.promocion['por_cumpleanios']=='Si') ? 'Si' : 'No')+'</label>';
				promocion_info += '<label class="width2longcolmn infolabel">Descuento por Familia:</label><label class="width2longcolmn infolabeltext">'+((res.promocion['por_familiar']=='Si') ? 'Si' : 'No')+'</label>';
				var tabla_productos = '<label class="width2longcolmn infolabel">Productos:</label><label class="width2longcolmn infolabeltext"></label><br/>'+
				'<center><table id="tabla-producto" class="tabla-producto width1colmn">'+
				'<caption>Lista productos</caption>'+
				'<thead><tr><th>Nombre</th><th>Cantidad</th></tr></thead>'+
				'<tbody>';
				var bb_prd = false;
				res.productos.forEach(function(element) {
					res.promocion_productos.forEach(function(index) {
						if(index.id_producto == element.id_producto){
							bb_prd = true;
							tabla_productos += '<tr>';
							tabla_productos +=  '<td class="tabla-td colordarkslategray">'+element.nombre+'</td>';
							tabla_productos +=  '<td class="tabla-td colordarkslategray">'+index.cantidad+'</td>';
							tabla_productos +=  '</tr>';
						}
					});
				});
				tabla_productos += '</tbody><tfoot></tfoot></table></center>';
				var tabla_servicios = '<label class="width2longcolmn infolabel">Servicios:</label><label class="width2longcolmn infolabeltext"></label><br/>'+
				'<center><table id="tabla-servicio" class="tabla-servicio width1colmn">'+
				'<caption>Lista servicios</caption>'+
				'<thead><tr><th>Nombre</th><th>Cantidad</th></tr></thead>'+
				'<tbody>';
				var bb_srv = false;
				res.servicios.forEach(function(element) {
					res.promocion_servicios.forEach(function(index) {
						if(index.id_servicio == element.id_servicio){
							bb_srv = true;
							tabla_servicios += '<tr>';
							tabla_servicios +=  '<td class="tabla-td colordarkslategray">'+element.nombre+'</td>';
							tabla_servicios +=  '<td class="tabla-td colordarkslategray">'+index.cantidad+'</td>';
							tabla_servicios +=  '</tr>';
						}
					});
				});
				tabla_servicios += '</tbody><tfoot></tfoot></table></center>';
				promocion_info += ((bb_prd) ? tabla_productos : '')+((bb_srv) ? tabla_servicios : '');
				$(".message-view-content").html(promocion_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_promocion(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_promocion(target){
	if(bb_promocion_editar){
		editar_promocion();
		return false;
	}
	try{
		//si es solo texto sin archivo
//		var formElement = document.getElementById("form");
//		var form_data = new FormData(formElement);
		var arg_prod_ids = JSON.parse($('#arg_prod_ids').html());
		var arg_serv_ids = JSON.parse($('#arg_serv_ids').html());
		var prod_ids = [];
		var serv_ids = [];
		arg_prod_ids.forEach(function(element) {
			if (Number($('#prd'+element.id_producto).val()) > 0){
				prod_ids.push({'id_producto':element.id_producto, 'cantidad':$('#prd'+element.id_producto).val()});
			}
		});
		arg_serv_ids.forEach(function(element) {
			if (Number($('#srv'+element.id_servicio).val()) > 0){
				serv_ids.push({'id_servicio':element.id_servicio, 'cantidad':$('#srv'+element.id_servicio).val()});
			}
		});
		console.log('$("#titulo").val()',$('#titulo').val());
		var form_data = new FormData();
		form_data.append('titulo', $('#titulo').val());
		form_data.append('auto_notificar', (($('#auto_notificar').is(':checked')) ? 'Si' : 'No'));
		form_data.append('mensaje', $('#mensaje').val());
		form_data.append('monto_descuento', $('#monto_descuento').val());
		form_data.append('fecha_inicio', $('#fecha_inicio').val());
		form_data.append('fecha_final', $('#fecha_final').val());
		form_data.append('por_antiguedad', (($('#por_antiguedad').is(':checked')) ? 'Si' : 'No'));
		form_data.append('por_cumpleanios', (($('#por_cumpleanios').is(':checked')) ? 'Si' : 'No'));
		form_data.append('por_familiar', (($('#por_familiar').is(':checked')) ? 'Si' : 'No'));
		form_data.append('productos', JSON.stringify(prod_ids));
		form_data.append('servicios', JSON.stringify(serv_ids));
		console.log('==>prod_ids',prod_ids);
		console.log('\n==>serv_ids',serv_ids);
		console.log('\n==>form_data',form_data);
		$.ajax({
			url: base_url+'admin/crearPromocion',
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
					cerrar_ventana_promocion();
					promocion();
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
function ver_editar_promocion(id_promocion){
	bb_promocion_editar = true;
	id_promocion_editar = id_promocion;
	$.ajax({
		url: base_url+'admin/seleccionarPromocion',
		type: 'post',
		dataType: "json",
		cache:false,
		data: {'id_promocion': id_promocion_editar},
		success: function(res){
			if(res.promocion.length>0 & res.productos.length>0 & res.servicios.length>0){
				console.log('res',res);
				res.promocion = res.promocion[0];
				$('#titulo').val(res.promocion['titulo']);
				$('#auto_notificar').prop('checked', ((res.promocion['auto_notificar'] == 'Si') ? true : false));
				$('#mensaje').val(res.promocion['mensaje']);
				$('#monto_descuento').val(res.promocion['monto_descuento']);
				$('#fecha_inicio').val(res.promocion['fecha_inicio']);
				$('#fecha_final').val(res.promocion['fecha_final']);
				$('#por_antiguedad').prop('checked', ((res.promocion['por_antiguedad'] == 'Si') ? true : false));
				$('#por_cumpleanios').prop('checked', ((res.promocion['por_cumpleanios'] == 'Si') ? true : false));
				$('#por_familiar').prop('checked', ((res.promocion['por_familiar'] == 'Si') ? true : false));
				var tabla_productos = '';
				res.productos.forEach(function(element) {
					var valor = '0';
					res.promocion_productos.forEach(function(index) {
						if(index.id_producto == element.id_producto){
							valor = index.cantidad;
							return;
						}
					});
					tabla_productos += '<tr>';
					tabla_productos +=  '<td>'+element.nombre+'</td>';
					tabla_productos +=  '<td class="tabla-td"><input  type="number" class="tabla-input-number" id="prd'+element.id_producto+'" value="'+valor+'" required/></td>';
					tabla_productos +=  '</tr>';
				});
				console.log('tabla_productos',tabla_productos);
				$('#tabla-tbody-producto').html(tabla_productos);
				$('#arg_prod_ids').html(JSON.stringify(res.productos));
				var tabla_servicios = '';
				res.servicios.forEach(function(element) {
					var valor = '0';
					res.promocion_servicios.forEach(function(index) {
						if(index.id_servicio == element.id_servicio){
							valor = index.cantidad;
							return;
						}
					});
					tabla_servicios += '<tr>';
					tabla_servicios +=  '<td>'+element.nombre+'</td>';
					tabla_servicios +=  '<td class="tabla-td"><input  type="number" class="tabla-input-number" id="srv'+element.id_servicio+'" value="'+valor+'" required/></td>';
					tabla_servicios +=  '</tr>';
				});
				$('#tabla-tbody-servicio').html(tabla_servicios);
				$('#arg_serv_ids').html(JSON.stringify(res.servicios));
				ver_ventana_promocion(' Editar Promocion');
			} else {alert('No es posible editar');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_promocion(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_promocion(){
	try{
		var arg_prod_ids = JSON.parse($('#arg_prod_ids').html());
		var arg_serv_ids = JSON.parse($('#arg_serv_ids').html());
		var prod_ids = [];
		var serv_ids = [];
		arg_prod_ids.forEach(function(element) {
			if (Number($('#prd'+element.id_producto).val()) > 0){
				prod_ids.push({'id_producto':element.id_producto, 'cantidad':$('#prd'+element.id_producto).val()});
			}
		});
		arg_serv_ids.forEach(function(element) {
			console.log('element',element);
			if (Number($('#srv'+element.id_servicio).val()) > 0){
				console.log('en el if id_servicio',element.id_servicio);
				serv_ids.push({'id_servicio':element.id_servicio, 'cantidad':$('#srv'+element.id_servicio).val()});
			}
		});
		$('input.checkbox_check').is(':checked')
		var form_data = new FormData();
		form_data.append('titulo', $('#titulo').val());
		form_data.append('auto_notificar', (($('#auto_notificar').is(':checked')) ? 'Si' : 'No'));
		form_data.append('mensaje', $('#mensaje').val());
		form_data.append('monto_descuento', $('#monto_descuento').val());
		form_data.append('fecha_inicio', $('#fecha_inicio').val());
		form_data.append('fecha_final', $('#fecha_final').val());
		form_data.append('por_antiguedad', (($('#por_antiguedad').is(':checked')) ? 'Si' : 'No'));
		form_data.append('por_cumpleanios', (($('#por_cumpleanios').is(':checked')) ? 'Si' : 'No'));
		form_data.append('por_familiar', (($('#por_familiar').is(':checked')) ? 'Si' : 'No'));
		form_data.append('productos', JSON.stringify(prod_ids));
		form_data.append('servicios', JSON.stringify(serv_ids));
		console.log('==>prod_ids',prod_ids);
		console.log('\n==>serv_ids',serv_ids);
		console.log('\n==>form_data',form_data);
		$.ajax({
			url: base_url+'admin/actualizarPromocion/'+id_promocion_editar,
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
					bb_promocion_editar = false;
					cerrar_ventana_promocion();
					promocion();
				} else {
					console.log('Error al subir datos',res);
					alert('Error al subir datos');
				}
				$("#btn-guardar").html('Guardar');
				$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
				$("#btn-guardar").prop('disabled', false); // enable button
			},
			error: function(e){
//				bb_promocion_editar = false;
				$("#btn-guardar").prop('disabled', false); // enable button
				console.log('ERROR:',e);
			}
		});
		return false;
	}catch(e){
		bb_promocion_editar = false;
		console.warning('Error de envio:',e);
		return false;
	}
}
function ver_eliminar_promocion(id_promocion, titulo){
	id_promocion_eliminar = id_promocion;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_promocion(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_promocion(){
	$.ajax({
		url: base_url+'admin/eliminarPromocion/'+id_promocion_eliminar,
		type: 'post',
		data: {'id_promocion':id_promocion_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_promocion();
			promocion();
		},
		error: function(e){
			alert('Error al eliminar promocion');
			console.log('ERROR:',e);
		}
	});
}

