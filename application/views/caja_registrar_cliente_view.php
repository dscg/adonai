<div class="window-popup">
	<form action="<?=base_url()?>caja/crearCliente" onSubmit="return guardar_cliente(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Cliente</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_cliente()"></i></h1>
			<div class="window-content height8row scrollableY">
				<label class="width3colmn inputlabel">Nombres:</label>
				<label class="width3colmn inputlabel">Apellido Paterno:</label>
				<label class="width3colmn inputlabel">Apellido Materno:</label>
				<input class="width3colmn inputtext" type="text" name="nombre" id="nombre" required/>
				<input class="width3colmn inputtext" type="text" name="ap_pat" id="ap_pat" required/>
				<input class="width3colmn inputtext" type="text" name="ap_mat" id="ap_mat"/>
				<br/><br/>
				<label class="width3colmn inputlabel">Fecha Nacimiento:</label>
				<label class="width3colmn inputlabel">C.I:</label>
				<label class="width3colmn inputlabel">Expedido:</label>
				<input class="width3colmn inputtext" type="date" name="fecha_nac" id="fecha_nac" />
				<input class="width3colmn inputtext" type="text" name="ci" id="ci" placeholder="Numero carnet" required />
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
				<label class="width3colmn inputlabel">Celular:</label>
				<label class="width3colmn inputlabel">Telefono:</label>
				<label class="width3colmn inputlabel">Generar nuevo QR:</label>
				<input class="width3colmn inputtext" type="text" name="celular" id="celular" required />
				<input class="width3colmn inputtext" type="text" name="telefono" id="telefono" />
				<label for="generar_qr" class="width3colmn inputcheckbox width120px">
					<input type="checkbox" class="check-type-1" name="generar_qr" id="generar_qr" value="Si">
					<i>No</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Preferencia:</label>
				<textarea class="width1colmn inputtextarea" rows="3" name="preferencia" id="preferencia"></textarea>
				<br/><br/>
				<label class="width1colmn inputlabel">Observacion:</label>
				<textarea class="width1colmn inputtextarea" rows="3" name="observacion" id="observacion"></textarea>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_cliente()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
