<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Adonai Barberia">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/caja.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
 	<div class="nav">
 		<article class="content-puesto">
 			<article class="item-puesto">
 				<div class="num-puesto">Puesto 1</div>
 				<div class="estado-puesto">LIBRE</div>
 				<div class="espera-puesto">En Espera (2)</div>
 				<div class="espera-puesto">Tiempo Estimado Libre (02:09)</div>
 			</article>
 			<article class="item-puesto">
 				<div class="num-puesto">Puesto 2</div>
 			</article>
 			<article class="item-puesto">
 				<div class="num-puesto">Puesto 3</div>
 			</article>
 			<article class="item-puesto">
 				<div class="num-puesto">Puesto 4</div>
 			</article>
 		</article>
 	</div>
 	<section class="section">
		<article class="panel-izq">
				<div class="titulo-espera">Lista de Clientes en Espera</div>
				<div class="content-espera"></div>
		</article>
		<article class="panel-cen">
			<div class="panel-top">
				<div class="btn-sound">
					<i class="material-icons volume-icon">volume_up</i>
					<span class="volume-label">Llamar</span>
				</div>
				<div id="reloj">
					<div id="fecha"></div>
					<div id="hora"></div>
				</div>
				<div class="menu-cliente">
					<input type="checkbox" id="toggle-cliente" checked="true" disabled="true" />
					<label id="show-menu-cliente" for="toggle-cliente">
						<div class="btn">
							<i class="material-icons md-36 toggleBtn menuBtn">menu</i>
							<i class="material-icons md-36 toggleBtn closeBtn">menu</i>
							<span class="label-cliente">Cliente</span>
						</div>
						<div class="btn" onclick="javascript: registrar_cliente();">
							<i class="material-icons md-36">R</i>
							<span>Registrar</span>
						</div>
						<div class="btn" onclick="javascript: venta_cliente();">
							<i class="material-icons md-36">V</i>
							<span>Venta</span>
						</div>
						<div class="btn" onclick="javascript: cobrar_cliente();">
							<i class="material-icons md-36">C</i>
							<span>Cobrar</span>
						</div>
						<div class="btn" onclick="javascript: atencion_cliente();">
							<i class="material-icons md-36">A</i>
							<span>Atencion</span>
						</div>
						<div class="btn" onclick="javascript: punto_cliente();">
							<i class="material-icons md-36">P</i>
							<span>Puntos</span>
						</div>
						<div class="btn" onclick="javascript: ticket_cliente();">
							<i class="material-icons md-36">T</i>
							<span>Tickets</span>
						</div>
						<div class="btn">
							<i class="material-icons md-36"></i>
						</div>
						<div class="btn">
							<i class="material-icons md-36"></i>
						</div>
					</label>
				</div>
				<div class="menu-adonai">
					<input type="checkbox" id="toggle-adonai" checked="true" />
					<label id="show-menu-adonai" for="toggle-adonai">
						<div class="btn">
							<i class="material-icons md-36 toggleBtn menuBtn">menu</i>
							<i class="material-icons md-36 toggleBtn closeBtn">menu</i>
							<span class="label-adonai">Adonai</span>
						</div>
						<div class="btn" onclick="javascript: atenciones_adonai();">
							<i class="material-icons md-36">A</i>
							<span>Atenciones</span>
						</div>
						<div class="btn" onclick="javascript: personal_adonai();">
							<i class="material-icons md-36">P</i>
							<span>Personal</span>
						</div>
						<div class="btn">
							<i class="material-icons md-36">cloud</i>
							<span></span>
						</div>
						<div class="btn">
							<i class="material-icons md-36">cloud</i>
							<span></span>
						</div>
						<div class="btn" onclick="javascript: productos_adonai();">
							<i class="material-icons md-36">P</i>
							<span>Productos</span>
						</div>
						<div class="btn" onclick="javascript: gatos_adonai();">
							<i class="material-icons md-36">G</i>
							<span>Gastos</span>
						</div>
						<div class="btn" onclick="javascript: clientes_adonai();">
							<i class="material-icons md-36">C</i>
							<span>Clientes</span>
						</div>
						<div class="btn" onclick="javascript: servicios_adonai();">
							<i class="material-icons md-36">S</i>
							<span>Servicios</span>
						</div>
					</label>
				</div>
			</div>
			<div class="panel-bottom">
				<div class="titulo-reserva">Lista de Reservas</div>
				<div class="content-reserva"></div>
			</div>
			<dir class="content-action">
				<a class="button-action" href="javascript: apertura_caja();">Apertura Caja</a>
				<a class="button-action" href="javascript: cierre_caja();">Cierre Caja</a>
				<a class="button-action" href="<?=base_url()?>login/logout">Cerrar Sessi&oacute;n</a>
			</dir>
		</article>
		<article class="panel-der">
				<div class="titulo-accion">Panel Acciones y Operaciones <span id="ventana-actual"></span></div>
				<div class="content-accion" id="content-accion"></div>
		</article>
	</section>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>js/caja.js"></script>
	<script type="text/javascript">
		var base_url='<?=base_url()?>';
		$(document).ready(function(){
			crearReloj('12hr');
		});
	</script>
</body>
</html>
