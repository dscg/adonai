<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Videos</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
<!--
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/datatables.min.css" media="screen" />
-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap-4.1.1.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/dataTables.bootstrap4.min.css" media="screen" />
</head>
<body>
	<nav>
		<ul class="menu">
			<li><a href="#">Personal</a>
				<ul>
					<li><a href="#"><i class="fas fa-plus-circle"></i><span>Nuevo</span></a></li>
					<li><a href="#"><i class="fas fa-pencil-alt"></i><span>Editar</span></a></li>
					<li><a href="#"><i class="fas fa-trash-alt"></i><span>Eliminar</span></a></li>
				</ul>
			</li>
			<li><a href="javascript: video()">Videos</a></li>
			<li><a href="#">Salir</a></li>
		</ul>
	</nav>
	<section id="section">
	</section>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>js/datatables.min.js"></script>
	<script src="<?=base_url()?>js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=base_url()?>js/admin.js"></script>
	<script>
		var base_url='<?=base_url()?>';
		function video(){
			$.ajax({
				url: '<?=base_url()?>admin/listaVideo',
				type: 'post',
				data: {},
				success: function(res){
					document.getElementById('section').innerHTML = res;
					lista_video();
				},
				error: function(e){
					document.getElementById('section').innerHTML = '<cente style="color:red;">Errror al generar vista de videos</center>';
					console.log('ERROR:',e);
				}
			});
		}
	</script>
</body>
</html>
