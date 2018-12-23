
// PERSONAL
var id_personal_eliminar = '0';
var id_usuario_eliminar = '0';
var id_personal_editar = '0';
var id_usuario_editar = '0';
var bb_personal_editar = false;
function personal(){
	$('.title-page').html('Personal');
	id_usuario_editar = '0';
	id_usuario_eliminar = '0';
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
	$('<i class="fas fa-plus-circle new-record" onClick="ver_ventana_personal()"> Nuevo Personal</i>').appendTo('div.dataTables_wrapper');
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
				personal_info += '<label class="width2longcolmn infolabel">Direcci&oacute;n:</label><label class="width2longcolmn infolabeltext">'+res['direccion']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Usuario:</label><label class="width2longcolmn infolabeltext">'+res['user']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">Contrase&ntilde;a:</label><label class="width2longcolmn infolabeltext">'+res['pass']+'</label>';
				personal_info += '<label class="width2longcolmn infolabel">QR:</label><label class="width2longcolmn infolabeltext"> </label>';
				personal_info += '<center style="max-width:100%;"><img style="max-width:50%;height:auto;" src="'+base_url+'img/personal/'+res['id_personal']+'_qr.png"></img></center>';
				var tabla_horarios = '<label class="width2longcolmn infolabel">Horarios:</label><label class="width2longcolmn infolabeltext"></label><br/>';
				var trabajo = JSON.parse(res['trabajo']);
				if(trabajo!=null){
					for (const index in trabajo) {
						tabla_horarios += '<center><table id="tabla-horario" class="tabla-horario width1colmn">'+
						'<caption>Lista horarios dia '+index+'</caption>'+
						'<thead><tr><th style="text-transform:capitalize;">'+index+'</th></tr></thead>'+
						'<tbody>';
						for(var i=0; i<trabajo[index].length; i++){
							tabla_horarios += '<tr>';
							tabla_horarios +=  '<td class="tabla-td colordarkslategray">'+trabajo[index][i]+'</td>';
						tabla_horarios +=  '</tr>';
						}
						tabla_horarios += '</tbody><tfoot></tfoot></table></center>';
					}
				}
				personal_info += tabla_horarios;
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
		// si es solo texto sin archivos
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		var arg_lun = ['lu0700', 'lu0800', 'lu0900', 'lu1000', 'lu1100', 'lu1200', 'lu1300', 'lu1400', 'lu1500', 'lu1600', 'lu1700', 'lu1800', 'lu1900', 'lu2000', 'lu2100'];
		var arg_mar = ['ma0700', 'ma0800', 'ma0900', 'ma1000', 'ma1100', 'ma1200', 'ma1300', 'ma1400', 'ma1500', 'ma1600', 'ma1700', 'ma1800', 'ma1900', 'ma2000', 'ma2100'];
		var arg_mie = ['mi0700', 'mi0800', 'mi0900', 'mi1000', 'mi1100', 'mi1200', 'mi1300', 'mi1400', 'mi1500', 'mi1600', 'mi1700', 'mi1800', 'mi1900', 'mi2000', 'mi2100'];
		var arg_jue = ['ju0700', 'ju0800', 'ju0900', 'ju1000', 'ju1100', 'ju1200', 'ju1300', 'ju1400', 'ju1500', 'ju1600', 'ju1700', 'ju1800', 'ju1900', 'ju2000', 'ju2100'];
		var arg_vie = ['vi0700', 'vi0800', 'vi0900', 'vi1000', 'vi1100', 'vi1200', 'vi1300', 'vi1400', 'vi1500', 'vi1600', 'vi1700', 'vi1800', 'vi1900', 'vi2000', 'vi2100'];
		var arg_sab = ['sa0700', 'sa0800', 'sa0900', 'sa1000', 'sa1100', 'sa1200', 'sa1300', 'sa1400', 'sa1500', 'sa1600', 'sa1700', 'sa1800', 'sa1900', 'sa2000', 'sa2100'];
		var lunes = '', martes = '', miercoles = '', jueves = '', viernes = '',  sabado = '';
		var trabajo = '{';
		arg_lun.forEach(function(element){lunes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(lunes.length>0 & lunes.substr(-1) == ','){trabajo += '"lunes": ['+lunes.slice(0, -1)+'],';}
		arg_mar.forEach(function(element){martes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(martes.length>0 & martes.substr(-1) == ','){trabajo += '"martes": ['+martes.slice(0, -1)+'],';}
		arg_mie.forEach(function(element){miercoles += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(miercoles.length>0 & miercoles.substr(-1) == ','){trabajo += '"miercoles": ['+miercoles.slice(0, -1)+'],';}
		arg_jue.forEach(function(element){jueves += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(jueves.length>0 & jueves.substr(-1) == ','){trabajo += '"jueves": ['+jueves.slice(0, -1)+'],';}
		arg_vie.forEach(function(element){viernes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(viernes.length>0 & viernes.substr(-1) == ','){trabajo += '"viernes": ['+viernes.slice(0, -1)+'],';}
		arg_sab.forEach(function(element){sabado += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(sabado.length>0 & sabado.substr(-1)==','){trabajo += '"sabado": ['+sabado.slice(0, -1)+'],';}
		if(trabajo.length>1 & trabajo.substr(-1) == ','){trabajo = trabajo.slice(0, -1);}
		form_data.set('trabajo', trabajo+'}');
		/*form_data.append('celular', document.getElementById('nombre').value);*/
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
				$('#user').val(res['user']);
				$('#pass').val(res['pass']);
				id_usuario_editar = res['id_usuario'];
				var trabajo = JSON.parse(res['trabajo']);
				if(trabajo!=null){
					for (const index in trabajo) {
						for(var i=0; i<trabajo[index].length; i++){
							$('#'+index.slice(0, 2)+trabajo[index][i].slice(0, 2)+'00').prop( "checked", true );
						}
					}
				}
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
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		var arg_lun = ['lu0700', 'lu0800', 'lu0900', 'lu1000', 'lu1100', 'lu1200', 'lu1300', 'lu1400', 'lu1500', 'lu1600', 'lu1700', 'lu1800', 'lu1900', 'lu2000', 'lu2100'];
		var arg_mar = ['ma0700', 'ma0800', 'ma0900', 'ma1000', 'ma1100', 'ma1200', 'ma1300', 'ma1400', 'ma1500', 'ma1600', 'ma1700', 'ma1800', 'ma1900', 'ma2000', 'ma2100'];
		var arg_mie = ['mi0700', 'mi0800', 'mi0900', 'mi1000', 'mi1100', 'mi1200', 'mi1300', 'mi1400', 'mi1500', 'mi1600', 'mi1700', 'mi1800', 'mi1900', 'mi2000', 'mi2100'];
		var arg_jue = ['ju0700', 'ju0800', 'ju0900', 'ju1000', 'ju1100', 'ju1200', 'ju1300', 'ju1400', 'ju1500', 'ju1600', 'ju1700', 'ju1800', 'ju1900', 'ju2000', 'ju2100'];
		var arg_vie = ['vi0700', 'vi0800', 'vi0900', 'vi1000', 'vi1100', 'vi1200', 'vi1300', 'vi1400', 'vi1500', 'vi1600', 'vi1700', 'vi1800', 'vi1900', 'vi2000', 'vi2100'];
		var arg_sab = ['sa0700', 'sa0800', 'sa0900', 'sa1000', 'sa1100', 'sa1200', 'sa1300', 'sa1400', 'sa1500', 'sa1600', 'sa1700', 'sa1800', 'sa1900', 'sa2000', 'sa2100'];
		var lunes = '', martes = '', miercoles = '', jueves = '', viernes = '',  sabado = '';
		var trabajo = '{';
		arg_lun.forEach(function(element){lunes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(lunes.length>0 & lunes.substr(-1) == ','){trabajo += '"lunes": ['+lunes.slice(0, -1)+'],';}
		arg_mar.forEach(function(element){martes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(martes.length>0 & martes.substr(-1) == ','){trabajo += '"martes": ['+martes.slice(0, -1)+'],';}
		arg_mie.forEach(function(element){miercoles += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(miercoles.length>0 & miercoles.substr(-1) == ','){trabajo += '"miercoles": ['+miercoles.slice(0, -1)+'],';}
		arg_jue.forEach(function(element){jueves += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(jueves.length>0 & jueves.substr(-1) == ','){trabajo += '"jueves": ['+jueves.slice(0, -1)+'],';}
		arg_vie.forEach(function(element){viernes += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(viernes.length>0 & viernes.substr(-1) == ','){trabajo += '"viernes": ['+viernes.slice(0, -1)+'],';}
		arg_sab.forEach(function(element){sabado += ($('#'+element).is(':checked')) ? '"'+$('#'+element).val()+'",' : '';});
		if(sabado.length>0 & sabado.substr(-1)==','){trabajo += '"sabado": ['+sabado.slice(0, -1)+'],';}
		if(trabajo.length>1 & trabajo.substr(-1) == ','){trabajo = trabajo.slice(0, -1);}
		form_data.set('id_usuario', id_usuario_editar+'}');
		form_data.set('trabajo', trabajo+'}');
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
					cerrar_ventana_personal();
					bb_personal_editar = false;
					personal();
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
function ver_eliminar_personal(id_personal, id_usuario, titulo){
	id_personal_eliminar = id_personal;
	id_usuario_eliminar = id_usuario;
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
		data: {'id_usuario':id_usuario_eliminar},
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


