<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_servicio()"></i></h1>
		<div class="message-view-content height6row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_servicio()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_servicio()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Servicio</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_servicio()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_servicio()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_servicio()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearServicio" onSubmit="return guardar_servicio(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Servicio</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_servicio()"></i></h1>
			<div class="window-content height4row scrollableY">
				<label class="width2colmn inputlabel">Nombre:</label>
				<label class="width2colmn inputlabel">Precio:</label>
				<input type="text" name="nombre" id="nombre" class="inputtext width2colmn" placeholder="Servicio"/>
				<input type="number" name="precio" id="precio" class="inputtext width2colmn" placeholder="#"/>
				<br/><br/>
				<label class="width2colmn inputlabel">Precio de Reserva:</label>
				<label class="width2colmn inputlabel">Puntos cliente:</label>
				<input class="width2colmn inputtext" type="number" min="1" name="precio_reserva" id="precio_reserva" required />
				<input class="width2colmn inputtext" type="number" min="0" name="puntos_cliente" id="puntos_cliente" step="0.1" required />
				<br/><br/>
				<label class="width1colmn inputlabel fontcenter">Imagen:</label>
				<br/>
				<input type="file" name="file" id="file" class="inputfile inputsize70" required="true" accept="image/*"/>
				<label for="file" class="width70pt" id="file-label"><i class="fas fa-upload"></i> Seleccione un Archivo</label>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_servicio()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista servicios</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Icono</th>
				<th>Precio Reserva</th>
				<th>Puntos Cliente</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($servicios)){
			foreach($servicios as $servicio){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_servicio('<?=$servicio->id_servicio?>', '<?=$servicio->nombre?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_servicio('<?=$servicio->id_servicio?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_servicio('<?=$servicio->id_servicio?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$servicio->nombre.'</td>';
				echo '<td>'.$servicio->precio.'</td>';
				echo '<td>'.$servicio->img.'</td>';
				echo '<td>'.$servicio->precio_reserva.'</td>';
				echo '<td>'.$servicio->puntos_cliente.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
