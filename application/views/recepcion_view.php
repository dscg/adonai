<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title class="title-page">Adonai</title>
	<link rel="icon" href="<?=base_url()?>img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/recepcion.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin_circular_menu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/chosen.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/table.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-clockpicker.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/chosen.min.css" media="screen" />
</head>
<body>
	<section class="principal" id="principal">
		<article class="opcion" onClick="javascript: ver_ventana_registro_qr();">
			<!--
			<img class="img-opcion" src="<?=base_url()?>"/>
			-->
			<i class="fas fa-qrcode img-opcion"></i>
			<div class="texto-opcion"> Registro con QR</div>
		</article>
		<article class="opcion" onClick="javascript: ver_ventana_registro_manual();">
			<!--
			<img class="img-opcion" src="<?=base_url()?>"/>
			-->
			<i class="fas fa-hand-point-up img-opcion"></i>
			<span class="texto-opcion"> Registro Manual</span>
		</article>
		<article class="opcion" onClick="javascript: ver_ventana_cliente();">
			<!--
			<img class="img-opcion" src="<?=base_url()?>"/>
			-->
			<i class="fas fa-user-plus img-opcion"></i>
			<span class="texto-opcion"> Cliente Nuevo</span>
		</article>
	</section>
	<section class="window-nuevo-cliente-popup" id="nuevo-cliente">
		<i class="fas fa-arrow-left button-atras" onClick="cerrar_ventana_cliente()"></i>
		<i class="fas fa-times button-cerrar" onClick="cerrar_ventana_cliente()"></i>
		<form action="<?=base_url()?>admin/crearCliente" onSubmit="return guardar_cliente(this);" method="post" enctype="multipart/form-data" id="form">
			<div class="window">
				<h1 class="window-header">Registro Cliente Nuevo</h1>
				<div class="window-content height7row">
					<label class="width1colmn inputlabel">Dependiente de (opcional):</label>
					<br/>
					<span class="width1colmn">
						<select data-placeholder="Seleccione al padre" class="chosen-select" tabindex="2" name="id_cliente" id="id_cliente" required="true">
							<option value=""></option>
							<?php
							if(!empty($clientes)){
								foreach($clientes as $cliente){
									echo '<option value="'.$cliente->id_cliente.'">';
									echo '['.$cliente->ci.'] '.$cliente->nombre.' '.$cliente->ap_pat.' '.$cliente->ap_mat;
									echo '</option>';
								}
							}
							?>
						</select>
					</span>
					<br/><br/>
					<label class="width3colmn inputlabel">Nombres:</label>
					<label class="width3colmn inputlabel">Apellido Paterno:</label>
					<label class="width3colmn inputlabel">Apellido Materno:</label>
					<input class="width3colmn inputtext" type="text" name="nombre" id="nombre" required/>
					<input class="width3colmn inputtext" type="text" name="ap_pat" id="ap_pat" required/>
					<input class="width3colmn inputtext" type="text" name="ap_mat" id="ap_mat"/>
					<br/><br/><br/>
					<label class="width3colmn inputlabel">Fecha Nacimiento:</label>
					<label class="width3colmn inputlabel">C.I:</label>
					<label class="width3colmn inputlabel">Expedido:</label>
					<input class="width3colmn inputtext" type="date" name="fecha_nac" id="fecha_nac" />
					<input class="width3colmn inputtext" type="text" name="ci" id="ci" placeholder="Nro. carnet" required />
					<span class=" width3colmn custom-dropdown">
						<select data-placeholder="Lugar Expedido" class="inputselect" name="expedido" id="expedido" required />
							<option value="Beni">Beni</option>
							<option value="Chuquisaca">Chuquisaca</option>
							<option value="Cochabamba">Cochabamba</option>
							<option value="La Paz">La Paz</option>
							<option value="Oruro">Oruro</option>
							<option value="Pando">Pando</option>
							<option value="Potosi">Potosi</option>
							<option value="Santa Cruz">Santa Cruz</option>
							<option value="Tarija">Tarija</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</span>
					<br/><br/><br/>
					<label class="width2colmn inputlabel">Celular:</label>
					<label class="width2colmn inputlabel">Telefono:</label>
					<input class="width2colmn inputtext" type="tel" name="celular" id="celular" required />
					<input class="width2colmn inputtext" type="tel" name="telefono" id="telefono" />
					<br/><br/>
				</div>
				<div class="window-buttons">
					<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_cliente()">Salir</button>
					<button class="window-button" id="btn-guardar" type="submit">Guardar</button>
				</div>
			</div>
		</form>
	</section>
	<section class="window-registro-manual-popup" id="registro-manual">
		<i class="fas fa-arrow-left button-atras" onClick="cerrar_ventana_registro_manual()"></i>
		<i class="fas fa-times button-cerrar" onClick="cerrar_ventana_registro_manual()"></i>
		<form action="<?=base_url()?>admin/crearServicioCliente" onSubmit="return guardar_registro_manual(this);" method="post" enctype="multipart/form-data" id="form">
			<div class="window w-i-d">
				<h1 class="window-header">Registro</h1>
				<div class="window-content content-registro-manual-1 height80pct">
					<div class="window-content-izq">
						<br/>
						<label class="width2longcolmn inputlabel">C.I:</label>
						<label class="width2longcolmn inputlabel">Nombres:</label>
						<input class="width2longcolmn inputtext" type="text" name="ci" id="ci" placeholder="Nro. carnet" required />
						<input class="width2longcolmn inputtext" type="text" name="nombre" id="nombre" required/>
						<br/><br/><br/>
						<label class="width1colmn labelgroup">Seleccione Puesto</label>
						<br/><br/>
						<div class="content-puestos required"></div>
						<span class="msg-invalid" id="msg_invalid_puestos"></span>
					</div>
					<div class="window-content-der">
						<label class="width1colmn labelgroup">Seleccione Servicio</label>
						<br/><br/>
						<div class="content-servicios required"></div>
						<span class="msg-invalid" id="msg_invalid_servicios"></span>
					</div>
				</div>
				<div class="window-buttons botones-registro-manual-1">
					<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_registro_manual()">Salir</button>
					<button class="window-button" id="btn-guardar" type="submit">Guardar</button>
				</div>
			</div>
		</form>
	</section>
	<section class="window-registro-qr-popup" id="registro-manual">
		<i class="fas fa-arrow-left button-atras" onClick="cerrar_ventana_registro_qr()"></i>
		<i class="fas fa-times button-cerrar" onClick="cerrar_ventana_registro_qr()"></i>
		<form action="<?=base_url()?>admin/crearServicioCliente" onSubmit="return guardar_servicio_cliente(this);" method="post" enctype="multipart/form-data" id="form">
			<div class="window">
				<h1 class="window-header">Registro QR</h1>
				<div class="window-content height7row">
					<div class="content-qr">
						<br/>
						<label class="inputlabel">Deslice el codigo QR sobre la camara:</label>
						<br/><br/>
						<div class="camara-qr"></div>
					</div>
				</div>
				<div class="window-buttons">
					<button class="window-button salir-unique" id="btn-salir" type="reset" onClick="cerrar_ventana_registro_qr()">Salir</button>
				</div>
			</div>
		</form>
	</section>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>js/chosen.jquery.min.js"></script>
	<script src="<?=base_url()?>js/jquery-clockpicker.min.js"></script>
	<script src="<?=base_url()?>js/recepcion.js"></script>
	<script>
		var base_url='<?=base_url()?>';
		$(".chosen-select").chosen({
			allow_single_deselect: true, // permitir quitar seleccion
			disable_search_threshold: 0, //deshabilitar busqueda menos de 10 opciones
			no_results_text: "Oops, Sin resultados para ", //mensaje si no hay resultados
			width: '78%' //ancho selector
		});
	</script>
</body>
</html>
