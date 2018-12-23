<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_puesto()"></i></h1>
		<div class="message-view-content height6row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_puesto()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_puesto()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Puesto</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_puesto()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_puesto()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_puesto()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearPuesto" onSubmit="return guardar_puesto(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Puesto</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_puesto()"></i></h1>
			<div class="window-content height4row scrollableY">
				<label class="width3colmn inputlabel">Nombre:</label>
				<label class="width3colmn inputlabel">Numero:</label>
				<label class="width3colmn inputlabel">Tipo:</label>
				<input type="text" name="nombre" id="nombre" class="inputtext width2colmn" required/>
				<input type="number" name="numero" id="numero" min="0" class="inputtext width2colmn" required/>
				<span class=" width3colmn custom-dropdown">
					<select data-placeholder="Tipo" name="tipo" id="tipo" required="true">
						<option value="admin">Administrador</option>
						<option value="peluquero">Peluquero</option>
					</select>
				</span>
				<br/><br/>
				<label class="width1colmn inputlabel fontcenter">Imagen:</label>
				<br/>
				<input type="file" name="file" id="file" class="inputfile inputsize70" accept="image/*"/>
				<label for="file" class="width70pt" id="file-label"><i class="fas fa-upload"></i> Seleccione un Archivo</label>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_puesto()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista puestos</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>numero</th>
				<th>tipo</th>
				<th>Imagen</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($puestos)){
			foreach($puestos as $puesto){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_puesto('<?=$puesto->id_puesto?>', '<?=$puesto->nombre?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_puesto('<?=$puesto->id_puesto?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_puesto('<?=$puesto->id_puesto?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$puesto->nombre.'</td>';
				echo '<td>'.$puesto->numero.'</td>';
				echo '<td>'.$puesto->tipo.'</td>';
				echo '<td>'.$puesto->img.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
