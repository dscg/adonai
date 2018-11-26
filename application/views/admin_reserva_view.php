<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_reserva()"></i></h1>
		<div class="message-view-content height6row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_reserva()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_reserva()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/actualizarReserva" onSubmit="return editar_reserva(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nueva Reserva</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_reserva()"></i></h1>
			<div class="window-content height6row scrollableY">
				<label class="width2colmn inputlabel">Cantidad de Fallas del Cliente para ser Bloqueado:</label>
				<label class="width2colmn inputlabel">Minutos Antes de la Reserva para la Notificacion:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="cantidad_bloqueo" id="cantidad_bloqueo" placeholder="#"/>
				<input class="width2colmn inputtext" type="number" min="0" name="tiempo_recordatorio" id="tiempo_recordatorio" placeholder="#"/>
				<br/><br/><br/>
				<label class="width2colmn inputlabel">Minutos Antes para Cancelar una Reserva:</label>
				<label class="width2colmn inputlabel">Cantidad de Avisos en el Dia de Reserva:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="tiempo_cancelar" id="tiempo_cancelar" placeholder="#" />
				<input class="width2colmn inputtext" type="number" min="0" name="cantidad_avisos_dia" id="cantidad_avisos_dia" placeholder="#" />
				<br/><br/><br/>
				<label class="width2colmn inputlabel">Titulo de la Notificacion:</label>
				<label class="width2colmn inputlabel">Mensaje de la Notificacion:</label>
				<input class="width2colmn inputtext" type="textr" name="titulo" id="titulo" placeholder="Titulo" />
				<input class="width2colmn inputtext" type="text" name="mensaje" id="mensaje" placeholder="Mensaje" />
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_reserva()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista reservas</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Cantidad para Bloqueo</th>
				<th>Tiempo para Recordatorio</th>
				<th>Tiempo Cancelar Reserva</th>
				<th>Avisos D&iacute;a</th>
				<th>Titulo</th>
				<th>Mensaje</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($reservas)){
			foreach($reservas as $reserva){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_editar_reserva('<?=$reserva->id_reserva_config?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_reserva('<?=$reserva->id_reserva_config?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$reserva->cantidad_bloqueo.'</td>';
				echo '<td>'.$reserva->tiempo_recordatorio.'</td>';
				echo '<td>'.$reserva->tiempo_cancelar.'</td>';
				echo '<td>'.$reserva->cantidad_avisos_dia.'</td>';
				echo '<td>'.$reserva->titulo.'</td>';
				echo '<td>'.$reserva->mensaje.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
