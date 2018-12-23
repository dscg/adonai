<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_asociado()"></i></h1>
		<div class="message-view-content height3row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_asociado()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_asociado()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Asociado</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_asociado()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_asociado()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_asociado()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearCliente" onSubmit="return guardar_asociado(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Asociado</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_asociado()"></i></h1>
			<div class="window-content height3row scrollableY">
				<label class="width2colmn inputlabel">Nombres:</label>
				<label class="width2colmn inputlabel">Total Integrantes:</label>
				<input class="width2colmn inputtext" type="text" name="nombre" id="nombre" required/>
				<input class="width2colmn inputtext" type="number" min="0" name="total_integrantes" id="total_integrantes" required/>
				<br/><br/>
				<label class="width2colmn inputlabel">Fecha Inicio:</label>
				<label class="width2colmn inputlabel">Fecha Final:</label>
				<input class="width2colmn inputtext" type="date" name="fecha_inicio" id="fecha_inicio" required/>
				<input class="width2colmn inputtext" type="date" name="fecha_final" id="fecha_final" required/>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_asociado()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista Asociados</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>Fecha Inicio</th>
				<th>Fecha Final</th>
				<th>Total Integrantes</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($asociados)){
			foreach($asociados as $asociado){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_asociado('<?=$asociado->id_asociado?>', '<?=$asociado->nombre?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_asociado('<?=$asociado->id_asociado?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_asociado('<?=$asociado->id_asociado?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$asociado->nombre.'</td>';
				echo '<td>'.$asociado->fecha_inicio.'</td>';
				echo '<td>'.$asociado->fecha_final.'</td>';
				echo '<td>'.$asociado->total_integrantes.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
