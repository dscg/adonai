
// CLIENTE
var id_cuenta_interna_cliente_eliminar = '0';
var id_cuenta_interna_cliente_editar = '0';
var bb_cuenta_interna_cliente_editar = false;
function cuenta_interna_cliente(){
	$('.title-page').html('Cuenta Interna Cliente');
	$.ajax({
		url: base_url+'admin/listaCuentaInternaCliente',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('section').innerHTML = res;
			lista_cuenta_interna_cliente();
		},
		error: function(e){
			document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de cuenta interna cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function lista_cuenta_interna_cliente(){
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_cuenta_interna_cliente(\' Nueva Cuenta Interna Cliente\')"> Nueva Cuenta</i>').appendTo('div.dataTables_wrapper');
	$(".chosen-select").chosen({
		allow_single_deselect: true, // permitir quitar seleccion
		disable_search_threshold: 0, //deshabilitar busqueda menos de 10 opciones
		no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
		width: '78%' //ancho selector
	});
}
function ver_ventana_cuenta_interna_cliente(titulo_ventana){
	$('.window-popup').css('display', 'block');
	$('.window-title').html(titulo_ventana);
}
function cerrar_ventana_cuenta_interna_cliente(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-popup').css('display','none');
}
function ver_info_cuenta_interna_cliente(id_cuenta_interna_cliente){
	var cuenta_interna_cliente_info = "";
	$.ajax({
		url: base_url+'admin/seleccionarCuentaInternaCliente',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_cuenta_interna_cliente': id_cuenta_interna_cliente},
		success: function(res){
			if(res.cuenta_interna_cliente.length>0 & res.productos.length>0 & res.servicios.length>0){
				res.cuenta_interna_cliente = res.cuenta_interna_cliente[0];
				console.log('res',res);
				cuenta_interna_cliente_info += '<label class="width2longcolmn infolabel">Cliente:</label><label class="width2longcolmn infolabeltext">'+res.cuenta_interna_cliente['nombreCliente']+' '+res.cuenta_interna_cliente['apPatCliente']+' '+res.cuenta_interna_cliente['apMatCliente']+'</label>';
				cuenta_interna_cliente_info += '<label class="width2longcolmn infolabel">Monto:</label><label class="width2longcolmn infolabeltext">'+res.cuenta_interna_cliente['monto']+'</label>';
				cuenta_interna_cliente_info += '<label class="width2longcolmn infolabel">Fecha Ingreso:</label><label class="width2longcolmn infolabeltext">'+res.cuenta_interna_cliente['fecha_ingreso']+'</label>';
				var tabla_productos = '<label class="width2longcolmn infolabel">Productos:</label><label class="width2longcolmn infolabeltext"></label><br/>'+
				'<center><table id="tabla-producto" class="tabla-producto width1colmn">'+
				'<caption>Lista productos</caption>'+
				'<thead><tr><th>Nombre</th><th>Cantidad</th></tr></thead>'+
				'<tbody>';
				var bb_prd = false;
				res.productos.forEach(function(element) {
					res.cuenta_interna_cliente_productos.forEach(function(index) {
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
					res.cuenta_interna_cliente_servicios.forEach(function(index) {
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
				cuenta_interna_cliente_info += ((bb_prd) ? tabla_productos : '')+((bb_srv) ? tabla_servicios : '');
				$(".message-view-content").html(cuenta_interna_cliente_info);
			} else {alert('No es posible monstrar mas informacion');}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
	$('.message-view-popup').css('display','block');
}
function cerrar_info_cuenta_interna_cliente(){
	$(".message-view-content")[0].innerHTML = '';
	$('.message-view-popup').css('display','none');
}

function guardar_cuenta_interna_cliente(target){
	if(bb_cuenta_interna_cliente_editar){
		editar_cuenta_interna_cliente();
		return false;
	}
	try{
		//si es solo texto sin archivo
		//var formElement = document.getElementById("form");
		//var form_data = new FormData(formElement);
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
		var form_data = new FormData();
		form_data.append('id_cliente', $('#id_cliente').val());
		form_data.append('monto', $('#monto').val());
		form_data.append('fecha_ingreso', $('#fecha_ingreso').val());
		form_data.append('productos', JSON.stringify(prod_ids));
		form_data.append('servicios', JSON.stringify(serv_ids));
		$.ajax({
			url: base_url+'admin/crearCuentaInternaCliente',
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
					cerrar_ventana_cuenta_interna_cliente();
					cuenta_interna_cliente();
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
function ver_editar_cuenta_interna_cliente(id_cuenta_interna_cliente){
	bb_cuenta_interna_cliente_editar = true;
	id_cuenta_interna_cliente_editar = id_cuenta_interna_cliente;
	$.ajax({
		url: base_url+'admin/seleccionarCuentaInternaCliente',
		type: 'post',
		dataType: "json",  
		cache:false,
		data: {'id_cuenta_interna_cliente': id_cuenta_interna_cliente_editar},
		success: function(res){
			if(res.cuenta_interna_cliente.length & res.clientes.length>0 & res.productos.length>0 & res.servicios.length>0){
				res.cuenta_interna_cliente = res.cuenta_interna_cliente[0];
				var container_select = '';
				for (var i = 0; i < res.clientes.length; i++) {
					container_select += '<option value="'+res.clientes[i]['id_cliente']+'"'+((res.clientes[i]['id_cliente']==res.cuenta_interna_cliente.id_cliente) ? ' selected' : '')+'>';
					container_select += '['+res.clientes[i]['ci']+'] '+res.clientes[i]['nombre']+' '+res.clientes[i]['ap_pat']+' '+res.clientes[i]['ap_mat'];
					container_select += '</option>';
				}
				$('#id_cliente').html(container_select);
				$("#id_cliente").trigger("chosen:updated");
				$('#monto').val(res.cuenta_interna_cliente['monto']);
				$('#fecha_ingreso').val(res.cuenta_interna_cliente['fecha_ingreso']);
				var tabla_productos = '';
				res.productos.forEach(function(element) {
					var valor = '0';
					res.cuenta_interna_cliente_productos.forEach(function(index) {
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
				$('#tabla-tbody-producto').html(tabla_productos);
				$('#arg_prod_ids').html(JSON.stringify(res.productos));
				var tabla_servicios = '';
				res.servicios.forEach(function(element) {
					var valor = '0';
					res.cuenta_interna_cliente_servicios.forEach(function(index) {
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
				ver_ventana_cuenta_interna_cliente(' Editar Cuenta Interna Cliente');
			} else {alert('No es posible editar'); console.log(res);}
		},
		error: function(e){
			console.log('ERROR:',e);
		}
	});
}
function cerrar_editar_cuenta_interna_cliente(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function editar_cuenta_interna_cliente(){
	try{
		//si es solo texto sin archivo
		//var formElement = document.getElementById("form");
		//var form_data = new FormData(formElement);
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
		$('input.checkbox_check').is(':checked')
		var form_data = new FormData();
		form_data.append('id_cliente', $('#id_cliente').val());
		form_data.append('monto', $('#monto').val());
		form_data.append('fecha_ingreso', $('#fecha_ingreso').val());
		form_data.append('productos', JSON.stringify(prod_ids));
		form_data.append('servicios', JSON.stringify(serv_ids));
		$.ajax({
			url: base_url+'admin/actualizarCuentaInternaCliente/'+id_cuenta_interna_cliente_editar,
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
					cerrar_ventana_cuenta_interna_cliente();
					bb_cuenta_interna_cliente_editar = false;
					cuenta_interna_cliente();
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
function ver_eliminar_cuenta_interna_cliente(id_cuenta_interna_cliente, titulo){
	id_cuenta_interna_cliente_eliminar = id_cuenta_interna_cliente;
	$('.message-popup').css('display','block');
	$(".message-content").html('Realmente desea eliminar '+titulo+'?');
}
function cerrar_eliminar_cuenta_interna_cliente(){
	$(".message-content")[0].innerHTML = '';
	$('.message-popup').css('display','none');
}
function eliminar_cuenta_interna_cliente(){
	$.ajax({
		url: base_url+'admin/eliminarCuentaInternaCliente/'+id_cuenta_interna_cliente_eliminar,
		type: 'post',
		data: {'id_cuenta_interna_cliente':id_cuenta_interna_cliente_eliminar},
		contentType: false,
		processData: false,
		success: function(res){
			cerrar_eliminar_cuenta_interna_cliente();
			cuenta_interna_cliente();
		},
		error: function(e){
			alert('Error al eliminar cuenta interna cliente');
			console.log('ERROR:',e);
		}
	});
}
function msg(c){
	alert(c);
}


