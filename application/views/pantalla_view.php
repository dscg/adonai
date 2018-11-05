<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title class="title-page">Adonai</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/pantalla.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
</head>
<body>
	<nav>
	</nav>
	<section>
		<video width="256" height="192"  id="video" controls autoplay>
		<source src="" id="source" type="video/mp4, video/webm">
		Tu navegador no soporta reproduccion de videos.
		</video>
	</section>
	<aside>
		<article class="article-title">Tickets</article>
	</aside>
	<script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
<!--
	<script src="<?=base_url()?>js/admin.js"></script>
-->
	<script>
		var pos = 0;
		var videos = <?=json_encode($videos)?>;
		console.log('videos',videos);
		$('#video').attr('src', '<?=base_url()?>video/'+videos[pos].ruta);
		document.getElementById('video').load();
		document.getElementById('video').play();
		document.getElementById('video').addEventListener('ended',video_ended,false);
		function video_ended(e){
			if(!e) {e = window.event;}
			pos++;
			console.log('pos',pos);
			console.log('videos.length',videos.length);
			console.log('ruta',videos[pos].ruta);
			$('#video').attr('src', "<?=base_url()?>video/"+videos[pos].ruta);
			document.getElementById('video').load();
			document.getElementById('video').play();
			if(pos >= videos.length-1){
				pos=-1;
				console.log('if', pos);
			}
		}
	</script>
</body>
</html>
