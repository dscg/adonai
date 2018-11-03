<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="window-title">Eliminar Video</span><i class="fas fa-times window-title-icon" onClick="cerrar_mensaje_video()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_mensaje_video()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_video()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/subirVideo" onSubmit="return subir_video(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Video</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_video()"></i></h1>
			<div class="window-content height2row">
				<input type="text" name="title" id="title" class="inputtext width70pt" placeholder="Titulo del video" required />
				<br/><br/>
				<input type="file" name="file" id="file" class="inputfile inputsize70" required="true" accept="*" />
				<label for="file" class="width70pt" id="file-label"><i class="fas fa-upload"></i> Seleccione Archivo de Video</label>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_video()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container_12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Titulo</th>
				<th>Ruta</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($videos)){
			foreach($videos as $video){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_mensaje_video('<?=$video->id_video?>', '<?=$video->titulo?>')" class="fas fa-trash-alt"></i>
				<?php
				echo '</td>';
				echo '<td>'.$video->titulo.'</td>';
				echo '<td>'.$video->ruta.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
