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
	<form action="<?=base_url()?>admin/crearReserva" onSubmit="return guardar_reserva(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nueva Reserva</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_reserva()"></i></h1>
			<div class="window-content height8row scrollableY">
				<label class="width1colmn inputlabel">Cliente:</label>
				<br/>
				<span class="width1colmn">
					<select data-placeholder="Seleccione un Cliente" class="chosen-select" tabindex="2" name="id_cliente" id="id_cliente" required="true">
						<option value=""></option>
						<?php
						if(!empty($clientes)){
							foreach($clientes as $cliente){
								echo '<option value="'.$cliente->id_cliente.'">';
								echo '['.$cliente->ci.'] '.$cliente->nombre.' '.$cliente->ap_pat.' '.$cliente->ap_mat;
								echo '</option>';
							}
						}
						?>
					</select>
				</span>
				<br/><br/>
				<label class="width1colmn inputlabel">Puesto:</label>
				<br/>
				<span class="width1colmn">
					<select data-placeholder="Seleccione un Puesto" class="chosen-select" tabindex="2" name="id_puesto" id="id_puesto" required="true">
						<option value=""></option>
						<?php
						if(!empty($puestos)){
							foreach($puestos as $puesto){
								echo '<option value="'.$puesto->id_puesto.'">';
								echo $puesto->nombre;
								echo '</option>';
							}
						}
						?>
					</select>
				</span>
				<br/><br/>
				<label class="width3colmn inputlabel">Fecha:</label>
				<label class="width3colmn inputlabel">Hora:</label>
				<label class="width3colmn inputlabel">Estado:</label>
				<input class="width3colmn inputtext" type="date" name="fecha" id="fecha" required />
				<input class="width3colmn inputtext" type="time" name="hora" id="hora" required />
				<span class="width3colmn custom-dropdown">
					<select data-placeholder="Estado" name="estado" id="estado" required="true">
						<option value="Reservado" selected>Reservado</option>
						<option value="Atendido">Atendido</option>
						<option value="Sin Atencion">Sin Atencion</option>
						<option value="Cancelado">Cancelado</option>
					</select>
				</span>
				<br/><br/>
				<label class="width1colmn inputlabel">Servicios:</label>
				<br/>
				<span class="width1colmn">
					<span style="display:none;" id="arg_srv_ids"><?php echo ((!empty($servicios)) ? json_encode($servicios) : "null");?></span>
					<table id="tabla-servicio" class="tabla-servicio width1colmn">
						<caption>Lista servicios</caption>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody id="tabla-tbody-servicio">
						<?php
						if(!empty($servicios)){
							foreach($servicios as $servicio){
								echo '<tr>';
								echo '<td>'.$servicio->nombre.'</td>';
								echo '<td class="tabla-td">'.
								'<label for="id_srv'.$servicio->id_servicio.'" class="width2colmn inputcheckbox">'.
								'<input type="checkbox" class="check-type-1" name="id_srv'.$servicio->id_servicio.'" id="id_srv'.$servicio->id_servicio.'" value="Si">'.
								'<i>No </i>';
								echo '</tr>';
							}
						}
						?>
						</tbody>
						<tfoot></tfoot>
					</table>
				</span>
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
				<th>Cliente</th>
				<th>Puesto</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($reservas)){
			foreach($reservas as $reserva){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_reserva('<?=$reserva->id_reserva?>', '<?=$reserva->nombreCliente?> <?=$reserva->apPatCliente?>'.\')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_reserva('<?=$reserva->id_reserva?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_reserva('<?=$reserva->id_reserva?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$reserva->nombreCliente.' '.$reserva->apPatCliente.' '.$reserva->apMatCliente.'</td>';
				echo '<td>'.$reserva->nombrePuesto.'</td>';
				echo '<td>'.$reserva->fecha.'</td>';
				echo '<td>'.$reserva->hora.'</td>';
				echo '<td>'.$reserva->estado.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
