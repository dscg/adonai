<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title class="title-page">Adonai</title>
	<link rel="icon" href="<?=base_url()?>img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin_circular_menu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/chosen.min.css" media="screen" />
<!--
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/datatables.min.css" media="screen" />
-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap-4.1.1.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/dataTables.bootstrap4.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/table.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-clockpicker.min.css" media="screen" />
</head>
<body>
	<nav>
		<ul class="menu" id="menu">
			<li><a class="menu-option" href="javascript: personal()">Personal</a></li>
			<li><a class="menu-option" href="javascript: servicio()">Servicios</a></li>
			<li><a class="menu-option" href="javascript: producto()">Productos</a></li>
			<li><a class="menu-option" href="javascript: cliente()">Clientes</a></li>
			<li><a  class="menu-option" href="javascript: video()">Videos</a></li>
			<li><a  class="menu-option active" href="<?=base_url()?>login/logout">Salir</a></li>
		</ul>
<!--
-->
	</nav>
	<section id="section">
		<img src="<?=base_url()?>img/adonai.jpg" class="img-section"/>
	</section>
	<script>
		var base_url='<?=base_url()?>';
	</script>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>js/datatables.min.js"></script>
	<script src="<?=base_url()?>js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=base_url()?>js/chosen.jquery.min.js"></script>
	<script src="<?=base_url()?>js/jquery-clockpicker.min.js"></script>
	<script src="<?=base_url()?>js/admin.js"></script>
	<script src="<?=base_url()?>js/admin_personal.js"></script>
	<script src="<?=base_url()?>js/admin_puesto.js"></script>
	<script src="<?=base_url()?>js/admin_servicio.js"></script>
	<script src="<?=base_url()?>js/admin_producto.js"></script>
	<script src="<?=base_url()?>js/admin_reserva.js"></script>
	<script src="<?=base_url()?>js/admin_cliente.js"></script>
	<script src="<?=base_url()?>js/admin_asociado.js"></script>
	<script src="<?=base_url()?>js/admin_cuenta_interna_cliente.js"></script>
	<script src="<?=base_url()?>js/admin_punto.js"></script>
	<script src="<?=base_url()?>js/admin_notificacion.js"></script>
	<script src="<?=base_url()?>js/admin_promocion.js"></script>
	<script src="<?=base_url()?>js/admin_configuracion.js"></script>
	<script src="<?=base_url()?>js/admin_video.js"></script>
</body>
</html>
