<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_cuenta_interna_cliente()"></i></h1>
		<div class="message-view-content height8row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_cuenta_interna_cliente()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_cuenta_interna_cliente()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Cuenta Interna Cliente</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_cuenta_interna_cliente()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_cuenta_interna_cliente()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_cuenta_interna_cliente()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearCuentaInternaCliente" onSubmit="return guardar_cuenta_interna_cliente(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nueva Cuenta Interna Cliente</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_cuenta_interna_cliente()"></i></h1>
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
				<label class="width2colmn inputlabel">Monto:</label>
				<label class="width2colmn inputlabel">Fecha Ingreso:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="monto" id="monto" required/>
				<input class="width2colmn inputtext" type="date" name="fecha_ingreso" id="fecha_ingreso" required/>
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
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_cuenta_interna_cliente()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista Cuentas Internas de clientes</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Cliente</th>
				<th>Monto</th>
				<th>Fecha Ingreso</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($cuentas_internas)){
			foreach($cuentas_internas as $cuenta_interna){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_cuenta_interna_cliente('<?=$cuenta_interna->id_cuenta_interna_cliente?>', '<?=$cuenta_interna->nombreCliente?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_cuenta_interna_cliente('<?=$cuenta_interna->id_cuenta_interna_cliente?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_cuenta_interna_cliente('<?=$cuenta_interna->id_cuenta_interna_cliente?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$cuenta_interna->nombreCliente.' '.$cuenta_interna->apPatCliente.' '.$cuenta_interna->apMatCliente.'</td>';
				echo '<td>'.$cuenta_interna->monto.'</td>';
				echo '<td>'.$cuenta_interna->fecha_ingreso.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
