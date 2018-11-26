<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_punto()"></i></h1>
		<div class="message-view-content height4row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_punto()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_punto()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Punto</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_punto()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_punto()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_punto()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearPunto" onSubmit="return guardar_punto(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Punto</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_punto()"></i></h1>
			<div class="window-content height7row scrollableY">
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
				<label class="width1colmn inputlabel">Descripci&oacute;n</label>
				<input class="width1colmn inputtext" type="text" name="descripcion" id="descripcion" required/>
				<br/><br/>
				<label class="width2colmn inputlabel">Cantidad:</label>
				<label class="width2colmn inputlabel">Estado:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="cantidad" id="cantidad" required/>
				<span class=" width3colmn custom-dropdown">
					<select data-placeholder="Estado" name="estado" id="estado" required="true">
						<option id="sin_asignar" value="sin asignar" selected>Sin asignar</option>
						<option id="asignado"value="asignado">Asignado</option>
					</select>
				</span>
				<br/><br/>
				<label class="width2colmn inputlabel">Fecha Registro:</label>
				<label class="width2colmn inputlabel">Fecha Asignacion:</label>
				<input class="width2colmn inputtext" type="date" name="fecha_registro" id="fecha_registro" required/>
				<input class="width2colmn inputtext" type="date" name="fecha_asignacion" id="fecha_asignacion" />
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_punto()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista puntos del cliente</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Cliente</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Estado</th>
				<th>Fecha Registro</th>
				<th>Fecha Asignaci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($puntos)){
			foreach($puntos as $punto){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_punto('<?=$punto->id_punto?>', '<?=$punto->nombreCliente?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_punto('<?=$punto->id_punto?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_punto('<?=$punto->id_punto?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$punto->nombreCliente.' '.$punto->apPatCliente.' '.$punto->apMatCliente.'</td>';
				echo '<td>'.$punto->descripcion.'</td>';
				echo '<td>'.$punto->cantidad.'</td>';
				echo '<td>'.$punto->estado.'</td>';
				echo '<td>'.$punto->fecha_registro.'</td>';
				echo '<td>'.$punto->fecha_asignacion.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
