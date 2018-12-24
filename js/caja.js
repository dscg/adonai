var lenguaje_es = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
};
// Add active class to the current menu (highlight it)
/*
var menu = document.getElementById('menu');
var opts = menu.getElementsByClassName("menu-option");
for (var i = 0; i < opts.length; i++) {
	opts[i].addEventListener("click", function() {
		var current = document.getElementsByClassName("active");
		current[0].className = current[0].className.replace(" active", "");
		this.className += " active";
	});
}

*/

function crearReloj(formato) {
	var ahora = new Date();
	var h = ahora.getHours();
	var m = ahora.getMinutes();
	var s = ahora.getSeconds();
	var dd = Number(ahora.getDay())+1;
	var mm = Number(ahora.getMonth())+1;
	var yyyy = ahora.getFullYear();
	var dn=" AM";
	if (h > 12 & formato=='12hr'){
		dn = " PM";
		h = h-12;
	}
	m = corregirHora(m);
	s = corregirHora(s);
	dd = corregirHora(dd);
	mm = corregirHora(mm);
	document.getElementById('hora').innerHTML = h+":"+m+":"+s+((formato=='12hr') ? dn : "");
	document.getElementById('fecha').innerHTML = dd+"-"+mm+"-"+yyyy;
	var t = setTimeout(function(){crearReloj(formato)},1000);
} 
function corregirHora(i) {
	if (i<10) {i = "0" + i};
	return i;
}

function apertura_caja(){
	$('#ventana-actual').html('[Apertura Caja]');
	// $('.menuBtn').click();
	$.ajax({
		url: base_url+'caja/aperturaCaja',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('content-accion').innerHTML = res;
		},
		error: function(e){
			document.getElementById('content-accion').innerHTML = '<cente style="color:red;">Errror al generar vista de cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function sumar(bnb){
	var val = $('.val-'+bnb).val();
	try{
		$('.val-'+bnb).val(Number(val)+1);
		var total = $('.val-200').val()*200 + 
			$('.val-100').val()*100 + 
			$('.val-50').val()*50 + 
			$('.val-20').val()*20 + 
			$('.val-10').val()*10+
			$('.val-new50').val()*50 + 
			$('.val-new20').val()*20 + 
			$('.val-new10').val()*10+
			$('.val-5').val()*5+
			$('.val-2').val()*2+
			$('.val-1').val()*1+
			$('.val-05').val()*0.5 + 
			$('.val-02').val()*0.2 + 
			$('.val-01').val()*0.1;
		$('.total-bnb').html('Total: Bs '+total);
	}catch(e){
		return false;
	}
}
function restar(bnb){
	var val = $('.val-'+bnb).val();
	try{
		if (val>0) {
			$('.val-'+bnb).val(Number(val)-1);
			var total = $('.val-200').val()*200 + 
				$('.val-100').val()*100 + 
				$('.val-50').val()*50 + 
				$('.val-20').val()*20 + 
				$('.val-10').val()*10+
				$('.val-new50').val()*50 + 
				$('.val-new20').val()*20 + 
				$('.val-new10').val()*10+
				$('.val-5').val()*5+
				$('.val-2').val()*2+
				$('.val-1').val()*1+
				$('.val-05').val()*0.5 + 
				$('.val-02').val()*0.2 + 
				$('.val-01').val()*0.1;
			$('.total-bnb').html('Total: Bs '+total);
		}
	}catch(e){
		return false;
	}
}
function cierre_caja(){
	$('#ventana-actual').html('[Cierre Caja]');
	// $('.menuBtn').click();
	$.ajax({
		url: base_url+'caja/cierreCaja',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('content-accion').innerHTML = res;
		},
		error: function(e){
			document.getElementById('content-accion').innerHTML = '<cente style="color:red;">Errror al generar vista de cliente</center>';
			console.log('ERROR:',e);
		}
	});
}
function registrar_cliente(){
	$('#ventana-actual').html('[Cliente]');
	// $('.menuBtn').click();
	$.ajax({
		url: base_url+'caja/registrarCliente',
		type: 'post',
		data: {},
		success: function(res){
			document.getElementById('content-accion').innerHTML = res;
		},
		error: function(e){
			document.getElementById('content-accion').innerHTML = '<cente style="color:red;">Errror al generar vista de cliente</center>';
			console.log('ERROR:',e);
		}
	});

}
function cerrar_registro_cliente(){
	$('#ventana-actual').html('');
	$('#content-accion').html('');
}
function guardar_cliente(target){
	if($("#btn-guardar").prop('disabled')){
		return false;
	}
	try{
		//si es solo texto sin archivo
		var formElement = document.getElementById("form");
		var form_data = new FormData(formElement);
		$.ajax({
			url: base_url+'caja/crearCliente',
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

function venta_cliente(){

}
function cobrar_cliente(){

}
function atencion_cliente(){

}
function punto_cliente(){

}
function ticket_cliente(){

}
function atenciones_adonai(){

}
function personal_adonai(){

}
function productos_adonai(){

}
function gatos_adonai(){

}
function clientes_adonai(){

}
function servicios_adonai(){

}
/*
caja_registrar_cliente_view

caja_venta_cliente_view
caja_cobrar_cliente_view
caja_atencion_cliente_view
caja_punto_cliente_view
caja_ticket_cliente_view

caja_lista_clientes_adonai_view

caja_lista_atenciones_adonai_view
caja_lista_personal_adonai_view
caja_lista_productos_adonai_view
caja_lista_gatos_adonai_view
caja_lista_servicios_adonai_view
*/


