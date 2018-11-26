<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_notificacion()"></i></h1>
		<div class="message-view-content height4row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_notificacion()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_notificacion()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Notificacion</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_notificacion()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_notificacion()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_notificacion()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearNotificacion" onSubmit="return guardar_notificacion(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Notificacion</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_notificacion()"></i></h1>
			<div class="window-content height7row scrollableY">
				<label class="width2colmn inputlabel">Titulo:</label>
				<label class="width2colmn inputlabel">Cantidad Avisos Dia:</label>
				<input class="width2colmn inputtext" type="text" name="titulo" id="titulo" required/>
				<input class="width2colmn inputtext" type="number" min="1" name="cantidad_avisos_dia" id="cantidad_avisos_dia" required/>
				<br/><br/>
				<label class="width1colmn inputlabel">Mensaje:</label>
				<input class="width1colmn inputtext" type="text" name="mensaje" id="mensaje" required/>
				<br/><br/>
				<label class="width2colmn inputlabel">Fecha Inicio:</label>
				<label class="width2colmn inputlabel">Fecha Final:</label>
				<input class="width2colmn inputtext" type="date" name="fecha_inicio" id="fecha_inicio" required/>
				<input class="width2colmn inputtext" type="date" name="fecha_final" id="fecha_final" required/>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_notificacion()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista notificaciones del cliente</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Titulo</th>
				<th>Mensaje</th>
				<th>Cantidad de Avisos Dia</th>
				<th>Fecha Inicio</th>
				<th>Fecha Final</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($notificaciones)){
			foreach($notificaciones as $notificacion){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_notificacion('<?=$notificacion->id_notificacion?>', '<?=$notificacion->titulo?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_notificacion('<?=$notificacion->id_notificacion?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_notificacion('<?=$notificacion->id_notificacion?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$notificacion->titulo.'</td>';
				echo '<td>'.$notificacion->mensaje.'</td>';
				echo '<td>'.$notificacion->cantidad_avisos_dia.'</td>';
				echo '<td>'.$notificacion->fecha_inicio.'</td>';
				echo '<td>'.$notificacion->fecha_final.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
