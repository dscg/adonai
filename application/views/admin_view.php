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
		<ul class="menu" id="menu">
			<li><a class="menu-option" href="javascript: personal()">Personal</a></li>
			<li><a  class="menu-option" href="javascript: video()">Videos</a></li>
			<li><a  class="menu-option active" href="<?=base_url()?>login/logout">Salir</a></li>
		</ul>
<!--
-->
	</nav>
	<section id="section">
	</section>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>js/datatables.min.js"></script>
	<script src="<?=base_url()?>js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=base_url()?>js/admin.js"></script>
	<script>
		// Add active class to the current menu (highlight it)
		var menu = document.getElementById('menu');
		var opts = menu.getElementsByClassName("menu-option");
		for (var i = 0; i < opts.length; i++) {
			opts[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
			});
		}
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
		function personal(){
			$.ajax({
				url: '<?=base_url()?>admin/listaPersonal',
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
	</script>
</body>
</html>
