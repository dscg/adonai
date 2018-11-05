<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_personal()"></i></h1>
		<div class="message-view-content height4row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_personal()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_personal()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Personal</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_personal()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_personal()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_personal()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearPersonal" onSubmit="return guardar_personal(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Personal</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_personal()"></i></h1>
			<div class="window-content height4row scrollableY">
				<label class="width1colmn inputlabel">Nombre Completo:</label>
				<input type="text" name="nombre" id="nombre" class="inputtext width3colmn" placeholder="Nombres" required />
				<input type="text" name="ap_pat" id="ap_pat" class="inputtext width3colmn" placeholder="Apellido Paterno" required />
				<input type="text" name="ap_mat" id="ap_mat" class="inputtext width3colmn" placeholder="Apellido Materno"/>
				<br/><br/>
				<label class="width3colmn inputlabel">Email:</label>
				<label class="width3colmn inputlabel">Telefono:</label>
				<label class="width3colmn inputlabel">Celular:</label>
				<input type="text" name="email" id="email" class="inputtext width3colmn" placeholder="Correo electronico"/>
				<input type="text" name="telefono" id="telefono" class="inputtext width3colmn" placeholder=""/>
				<input type="text" name="celular" id="celular" class="inputtext width3colmn" placeholder=""/>
				<br/><br/>
				<label class="width3colmn inputlabel">Genero:</label>
				<label class="width3colmn inputlabel">C.I:</label>
				<label class="width3colmn inputlabel">Expedido:</label>
				<span class="width3colmn inputradio">
					<label class="label-radio">
						<input type="radio" class="option-input radio" name="genero" id="genero_m" value="Masculino" required="true"/>
						Masculino
					</label>
					<label class="label-radio">
						<input type="radio" class="option-input radio" name="genero" id="genero_f" value="Femenino" required="true"/>
						Femenino
					</label>
				</span>
				<input type="text" name="ci" id="ci" class="width3colmn inputtext" placeholder="Numero carnet" required />
				<span class=" width3colmn custom-dropdown">
					<select data-placeholder="Lugar Expedido" name="expedido" id="expedido" required="true">
						<option value="Beni">Beni</option>
						<option value="Chuquisaca">Chuquisaca</option>
						<option value="Cochabamba">Cochabamba</option>
						<option value="La Paz">La Paz</option>
						<option value="Oruro">Oruro</option>
						<option value="Pando">Pando</option>
						<option value="Potosi">Potosi</option>
						<option value="Santa Cruz">Santa Cruz</option>
						<option value="Tarija">Tarija</option>
						<option value="Extranjero">Extranjero</option>
					</select>
				</span>
				<br/><br/>
				<label class="width2colmn inputlabel">Fecha Nacimiento:</label>
				<label class="width2colmn inputlabel">Fecha Inicio:</label>
				<input class="width2colmn inputtext" type="date" name="fecha_nacimiento" id="fecha_nacimiento" />
				<input class="width2colmn inputtext" type="date" name="fecha_inicio" id="fecha_inicio" required />
				<br/><br/>
				<label class="width1colmn inputlabel">Direcci&oacute;n</label>
				<input class="width1colmn inputtext" type="text" name="direccion" id="direccion" required />
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_personal()">Salir</button>
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
				<th>Nombre</th>
				<th>Carnet</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Fecha Inicio</th>
				<th>Direcci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($personal)){
			foreach($personal as $persona){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_personal('<?=$persona->id_personal?>', '<?=$persona->nombre?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_personal('<?=$persona->id_personal?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_personal('<?=$persona->id_personal?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$persona->nombre.' '.$persona->ap_pat.' '.$persona->ap_mat.'</td>';
				echo '<td>'.$persona->ci.' '.$persona->expedido.'</td>';
				echo '<td>'.$persona->telefono.'</td>';
				echo '<td>'.$persona->celular.'</td>';
				echo '<td>'.$persona->fecha_inicio.'</td>';
				echo '<td>'.$persona->direccion.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
