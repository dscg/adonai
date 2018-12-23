
// RECEPCION
var num_ventana_registro_manual = 0;
function ver_ventana_cliente(){
	$('.principal').css('display', 'none');
	$('.window-nuevo-cliente-popup').css('display', 'block');
}
function cerrar_ventana_cliente(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-nuevo-cliente-popup').css('display','none');
	$('.principal').css('display', 'flex');
}
function guardar_cliente(target){
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'recepcion/crearCliente',
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
					alert('Error al guardar cliente vuelva a intentarlo');
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

function ver_ventana_registro_manual(){
	$('.principal').css('display', 'none');
	$('.window-registro-manual-popup').css('display', 'block');
	try{
		$.ajax({
			url: base_url+'recepcion/listaRegistroManual',
			type: 'post',
			data: {},
			contentType: false,
			processData: false,
			beforeSend: function() {},
			success: function(res){
				if(res.servicios.length>0 & res.puestos.length>0){
					var srv_short = "", srv_long = "", c_srv = 0;
					for(const prop in res.servicios){
						c_srv++;
						if(res.servicios[prop]['nombre'].length<15){
							srv_short += '<label for="id_srv_'+res.servicios[prop]['id_servicio']+'" class="width2longcolmn inputcheckbox2">'+
							'<input type="checkbox" class="check-type-2" name="id_srv_'+res.servicios[prop]['id_servicio']+'" id="id_srv_'+res.servicios[prop]['id_servicio']+'" value="'+res.servicios[prop]['id_servicio']+'">'+
							'<i>'+res.servicios[prop]['nombre']+'</i></label>"';
						} else {
							srv_long += '<label for="id_srv_'+res.servicios[prop]['id_servicio']+'" class="width1colmn inputcheckbox2">'+
							'<input type="checkbox" class="check-type-2" name="id_srv_'+res.servicios[prop]['id_servicio']+'" id="id_srv_'+res.servicios[prop]['id_servicio']+'" value="'+res.servicios[prop]['id_servicio']+'">'+
							'<i>'+res.servicios[prop]['nombre']+'</i></label>"';
						}
					}
					$('.content-servicios').html(srv_short+srv_long);
					$('.content-servicios').css('overflow-y', ((c_srv>12) ? 'scroll' : 'none'));
					var pst_short = "", pst_long = "", c_pst = 0;
					for(const prop in res.puestos){
						c_pst++;
						if(res.puestos[prop]['nombre'].length<15){
							pst_short += '<label for="id_pst_'+res.puestos[prop]['id_puesto']+'" class="width2longcolmn inputcheckbox2">'+
							'<input type="checkbox" class="check-type-2" name="id_pst_'+res.puestos[prop]['id_puesto']+'" id="id_pst_'+res.puestos[prop]['id_puesto']+'" value="'+res.puestos[prop]['id_puesto']+'">'+
							'<i>'+res.puestos[prop]['nombre']+' '+res.puestos[prop]['numero']+'</i></label>"';
						}else{
							pst_long += '<label for="id_pst_'+res.puestos[prop]['id_puesto']+'" class="width1colmn inputcheckbox2">'+
							'<input type="checkbox" class="check-type-2" name="id_pst_'+res.puestos[prop]['id_puesto']+'" id="id_pst_'+res.puestos[prop]['id_puesto']+'" value="'+res.puestos[prop]['id_puesto']+'">'+
							'<i>'+res.puestos[prop]['nombre']+' '+res.puestos[prop]['numero']+'</i></label>"';
						}
					}
					$('.content-puestos').html(pst_short+pst_long);
					$('.content-puestos').css('overflow-y', ((c_pst>8) ? 'scroll' : 'none'));
				} else {
					console.log('Error al cargar servicios y puestos',res);
					alert('Error al cargar servicios y puestos');
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
function cerrar_ventana_registro_manual(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-registro-manual-popup').css('display','none');
	$('.principal').css('display', 'flex');
}
function guardar_registro_manual(target){
	if($('div.content-puestos.required :checkbox:checked').length == 0){
		$('#msg_invalid_puestos').css("display", "block");
		$('#msg_invalid_puestos').html("Debe seleccionar un puesto");
		return false;
	} else {
		$('#msg_invalid_puestos').css("display", "none");
		$('#msg_invalid_puestos').html("");
	}
	if($('div.content-servicios.required :checkbox:checked').length == 0){
		$('#msg_invalid_servicios').css("display", "block");
		$('#msg_invalid_servicios').html("Debe seleccionar un servicio");
		return false;
	} else {
		$('#msg_invalid_servicios').css("display", "none");
		$('#msg_invalid_servicios').html("");
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'recepcion/crearCliente',
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
					alert('Error al guardar cliente vuelva a intentarlo');
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



function ver_ventana_registro_qr(){
	$('.principal').css('display', 'none');
	$('.window-registro-qr-popup').css('display', 'block');
}
function cerrar_ventana_registro_qr(){
	document.getElementById('form').reset();
	$("#btn-guardar").html('Guardar');
	$('#btn-guardar').css('color', 'rgba(40, 140, 240, 1)');
	$("#btn-guardar").prop('disabled', false); // enable button
	$('.window-registro-qr-popup').css('display','none');
	$('.principal').css('display', 'flex');
}
