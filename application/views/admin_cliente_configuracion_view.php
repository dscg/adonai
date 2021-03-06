<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_configuracion()"></i></h1>
		<div class="message-view-content height5row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_configuracion()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_configuracion()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/actualizarConfiguracion" onSubmit="return editar_configuracion(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Editar Configuracion</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_configuracion()"></i></h1>
			<div class="window-content height8row scrollableY">
				<label class="width1colmn labelgroup">PROMOCIONES</label>
				<br/>
				<label class="width2colmn inputlabel">Meses de antiguedad:</label>
				<label class="width2colmn inputlabel">Cantidad Dependientes para Promociones:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="prom_meses_antiguedad" id="prom_meses_antiguedad" required/>
				<input class="width2colmn inputtext" type="number" min="0" name="prom_cantidad_dependientes" id="prom_cantidad_dependientes" required/>
				<br/><br/>
				<label class="width1colmn labelgroup">RESERVAS</label>
				<br/>
				<label class="width2colmn inputlabel">Cantidad de Fallas del Cliente para ser Bloqueado:</label>
				<label class="width2colmn inputlabel">Minutos Antes de la Reserva para la Notificacion:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="res_cantidad_bloqueo" id="res_cantidad_bloqueo" placeholder="#"/>
				<input class="width2colmn inputtext" type="number" min="0" name="res_tiempo_recordatorio" id="res_tiempo_recordatorio" placeholder="#"/>
				<br/><br/>
				<label class="width2colmn inputlabel">Minutos Antes para Cancelar una Reserva:</label>
				<label class="width2colmn inputlabel">Cantidad de Avisos en el Dia de Reserva:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="res_tiempo_cancelar" id="res_tiempo_cancelar" placeholder="#" />
				<input class="width2colmn inputtext" type="number" min="0" name="res_cantidad_avisos_dia" id="res_cantidad_avisos_dia" placeholder="#" />
				<br/><br/>
				<label class="width1colmn inputlabel">Titulo de la Notificacion:</label>
				<input class="width1colmn inputtext" type="textr" name="res_titulo" id="res_titulo" placeholder="Titulo" />
				<br/><br/>
				<label class="width1colmn inputlabel">Mensaje de la Notificacion:</label>
				<input class="width1colmn inputtext" type="text" name="res_mensaje" id="res_mensaje" placeholder="Mensaje" />
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_configuracion()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th colspan="2" class="tabla-font-center">Promociones</th>
				<th colspan="7" class="tabla-font-center">Reservas</th>
			</tr>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Meses de Antiguedad</th>
				<th>Cantidad de Dependientes</th>
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
		if(!empty($configuraciones)){
			foreach($configuraciones as $configuracion){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_editar_configuracion('<?=$configuracion->id_configuracion_cliente?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_configuracion('<?=$configuracion->id_configuracion_cliente?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$configuracion->prom_meses_antiguedad.'</td>';
				echo '<td>'.$configuracion->prom_cantidad_dependientes.'</td>';
				echo '<td>'.$configuracion->res_cantidad_bloqueo.'</td>';
				echo '<td>'.$configuracion->res_tiempo_recordatorio.'</td>';
				echo '<td>'.$configuracion->res_tiempo_cancelar.'</td>';
				echo '<td>'.$configuracion->res_cantidad_avisos_dia.'</td>';
				echo '<td>'.$configuracion->res_titulo.'</td>';
				echo '<td>'.$configuracion->res_mensaje.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
