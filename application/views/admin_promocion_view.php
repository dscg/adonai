<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_promocion()"></i></h1>
		<div class="message-view-content height8row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_promocion()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_promocion()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Promocion</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_punto()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_promocion()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_promocion()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearPromocion" onSubmit="return guardar_promocion(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Promocion</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_promocion()"></i></h1>
			<div class="window-content height8row scrollableY">
				<label class="width2colmn inputlabel">Titulo</label>
				<label class="width2colmn inputlabel">Autonotificar</label>
				<input class="width2colmn inputtext" type="text" name="titulo" id="titulo" required/>
				<label for="auto_notificar" class="width2colmn inputcheckbox">
					<input type="checkbox" name="auto_notificar" id="auto_notificar" value="Si">
					<i>No </i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Mensaje</label>
				<input class="width1colmn inputtext" type="text" name="mensaje" id="mensaje" required/>
				<br/><br/>
				<label class="width3colmn inputlabel">Monto Descuento:</label>
				<label class="width3colmn inputlabel">Fecha Inicio:</label>
				<label class="width3colmn inputlabel">Fecha Final:</label>
				<input class="width3colmn inputtext" type="number" min="0" name="monto_descuento" id="monto_descuento" required/>
				<input class="width3colmn inputtext" type="date" name="fecha_inicio" id="fecha_inicio" required/>
				<input class="width3colmn inputtext" type="date" name="fecha_final" id="fecha_final" />
				<br/><br/>
				<label class="width3colmn inputlabel">Desc. Antiguedad:</label>
				<label class="width3colmn inputlabel">Desc. Cumplea&ntilde;os:</label>
				<label class="width3colmn inputlabel">Desc. Familia:</label>
				<label class="width3colmn inputcheckbox" for="por_antiguedad">
					<input type="checkbox" name="por_antiguedad" id="por_antiguedad" value="Si">
					<i>No </i>
				</label>
				<label class="width3colmn inputcheckbox" for="por_cumpleanios">
					<input type="checkbox" name="por_cumpleanios" id="por_cumpleanios" value="Si">
					<i>No </i>
				</label>
				<label class="width3colmn inputcheckbox" for="por_familiar">
					<input type="checkbox" name="por_familiar" id="por_familiar" value="Si">
					<i>No </i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Productos:</label>
				<br/>
				<span class="width1colmn">
					<span style="display:none;" id="arg_prod_ids"><?php echo ((!empty($productos)) ? json_encode($productos) : "null");?></span>
					<table id="tabla-producto" class="tabla-producto width1colmn">
						<caption>Lista productos</caption>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody id="tabla-tbody-producto">
						<?php
						if(!empty($productos)){
							foreach($productos as $producto){
								echo '<tr>';
								echo '<td>'.$producto->nombre.'</td>';
								echo '<td class="tabla-td"><input  type="number" class="tabla-input-number" id="prd'.$producto->id_producto.'" value="0" required/></td>';
								echo '</tr>';
							}
						}
						?>
						</tbody>
						<tfoot></tfoot>
					</table>
				</span>
				<br/><br/>
				<label class="width1colmn inputlabel">Servicios:</label>
				<br/>
				<span class="width1colmn">
					<span style="display:none;" id="arg_serv_ids"><?php echo ((!empty($servicios)) ? json_encode($servicios) : "null");?></span>
					<table id="tabla-servicio" class="tabla-servicio width1colmn">
						<caption>Lista servicios</caption>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody id="tabla-tbody-servicio">
						<?php
						if(!empty($servicios)){
							foreach($servicios as $servicio){
								echo '<tr>';
								echo '<td>'.$servicio->nombre.'</td>';
								echo '<td class="tabla-td"><input  type="number" class="tabla-input-number" id="srv'.$servicio->id_servicio.'" value="0" required/></td>';
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
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_promocion()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista promociones del cliente</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Titulo</th>
				<th>Mensaje</th>
				<th>Autonotificar</th>
				<th>Fecha Inicio</th>
				<th>Fecha Final</th>
				<th>Monto Descuento</th>
				<th>Por Antiguedad</th>
				<th>Por Cumplea&ntilde;os</th>
				<th>Por Familia</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($promociones)){
			foreach($promociones as $promocion){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_promocion('<?=$promocion->id_promocion?>', '<?=$promocion->titulo?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_promocion('<?=$promocion->id_promocion?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_promocion('<?=$promocion->id_promocion?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$promocion->titulo.'</td>';
				echo '<td>'.$promocion->mensaje.'</td>';
				echo '<td>'.$promocion->auto_notificar.'</td>';
				echo '<td>'.$promocion->fecha_inicio.'</td>';
				echo '<td>'.$promocion->fecha_final.'</td>';
				echo '<td>'.$promocion->monto_descuento.'</td>';
				echo '<td>'.$promocion->por_antiguedad.'</td>';
				echo '<td>'.$promocion->por_cumpleanios.'</td>';
				echo '<td>'.$promocion->por_familiar.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
