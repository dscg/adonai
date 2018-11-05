<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Adonai Barberia">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/caja.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen"/>
</head>
<body>
	<nav>
		<article class="menu-left">
			<article><img src="<?=base_url()?>img/caja/adonai.jpg"/><span>Menu</span></article>
			<article><img src="<?=base_url()?>img/caja/lista.png"/><span>Atenciones</span></article>
			<article><img src="<?=base_url()?>img/caja/collaboration.png"/></i><span>Personal</span></article>
			<article><img src="<?=base_url()?>img/caja/team.png"/></i><span>Clientes</span></article>
			<article><img src="<?=base_url()?>img/caja/barber.png"/><span>Servicios</span></article>
			<article><img src="<?=base_url()?>img/caja/lotion.png"/><span>Productos</span></article>
			<article><img src="<?=base_url()?>img/caja/pay.png"/><span>Pagos y Gastos</span></article>
			<article><img src="<?=base_url()?>img/caja/newspaper.png"/><span>Reportes</span></article>
			<article><img src="<?=base_url()?>img/caja/settings.png"/><span>Config</span></article>
		</article>
		<article class="menu-right">
			<article><img src="<?=base_url()?>img/caja/add-user.png"/><span>Registrar</span></article>
			<article><img src="<?=base_url()?>img/caja/money.png"/><span>Cobrar Servicio</span></article>
			<article><img src="<?=base_url()?>img/caja/cash-register.png"/><span>Tickets Cobrados</span></article>
			<article><img src="<?=base_url()?>img/caja/entrepreneur.png"/><span>Ventas Directas</span></article>
		</article>
	</nav>
	<section class="section">
		<article>
			<a class="close-session" href="<?=base_url()?>login/logout">cerrar session</a>
		</article>
	</section>
	<footer>
		<article class="menu-footer">
			<article><img/><span>Operaciones</span></article>
			<article><img src="<?=base_url()?>img/caja/notebook.png"/><span>Registrar Atencion</span></article>
			<article><img src="<?=base_url()?>img/caja/money.png"/><span>Cobrar Servicios</span></article>
			<article><img src="<?=base_url()?>img/caja/no-stopping.png"/><span>No Atendidos</span></article>
			<article><img src="<?=base_url()?>img/caja/chair.png"/><span>Atenciones Puestos</span></article>
			<article><img src="<?=base_url()?>img/caja/debit-card.png"/><span>Tickets Cobrados</span></article>
		</article>
	</footer>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var height = $(window).height()-120;
			$('.section').height(height);
		});
	</script>
</body>
</html>
