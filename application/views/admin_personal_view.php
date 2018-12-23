<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_personal()"></i></h1>
		<div class="message-view-content height8row scrollableY"></div>
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
			<div class="window-content height7row scrollableY">
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
				<input type="text" name="celular" id="celular" class="inputtext width3colmn" placeholder="" required />
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
				<label class="width3colmn inputlabel">Fecha Nacimiento:</label>
				<label class="width3colmn inputlabel">Fecha Inicio:</label>
				<label class="width3colmn inputlabel">Lugar de Trabajo:</label>
				<input class="width3colmn inputtext" type="date" name="fecha_nacimiento" id="fecha_nacimiento" />
				<input class="width3colmn inputtext" type="date" name="fecha_inicio" id="fecha_inicio" required />
				<span class=" width3colmn custom-dropdown">
					<select data-placeholder="oficio" name="trabajo" id="trabajo" required="true">
						<option id="puesto" value="peluquero" selected>Puesto</option>
						<option id="caja"value="caja">Caja</option>
					</select>
				</span>
				<br/><br/>
				<label class="width1colmn inputlabel">Direcci&oacute;n</label>
				<textarea class="width1colmn inputtextarea" rows="3" name="direccion" id="direccion" required></textarea>
				<br/><br/>
				<label class="width3colmn inputlabel">Usuario:</label>
				<label class="width3colmn inputlabel">Contrase&ntilde;a:</label>
				<label class="width3colmn inputlabel">Generar nuevo QR:</label>
				<input type="text" name="user" id="user" class="inputtext width3colmn" required />
				<input type="text" name="pass" id="pass" class="inputtext width3colmn" required />
				<label for="generar_qr" class="width3colmn inputcheckbox width120px">
					<input type="checkbox" class="check-type-1" name="generar_qr" id="generar_qr" value="Si">
					<i>No</i>
				</label>
				<br/><br/>
				<label class="width1colmn labelgroup">HORARIO DE TRABAJO</label>
				<label class="width1colmn inputlabel">Lunes:</label>
				<br/>
				<label for="lu0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu0700" id="lu0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="lu0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu0800" id="lu0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="lu0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu0900" id="lu0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="lu1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1000" id="lu1000" value="10:00-11:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="lu1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1100" id="lu1100" value="11:00-12:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="lu1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1200" id="lu1200" value="12:00-13:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="lu1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1300" id="lu1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="lu1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1400" id="lu1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="lu1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1500" id="lu1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="lu1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1600" id="lu1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="lu1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1700" id="lu1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="lu1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1800" id="lu1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="lu1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1900" id="lu1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="lu2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu1700" id="lu2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="lu2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="lu2100" id="lu2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Martes:</label>
				<br/>
				<label for="ma0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma0700" id="ma0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="ma0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma0800" id="ma0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="ma0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma0900" id="ma0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="ma1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1000" id="ma1000" value="10:00-11:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="ma1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1100" id="ma1100" value="11:00-12:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="ma1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1200" id="ma1200" value="12:00-13:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="ma1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1300" id="ma1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="ma1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1400" id="ma1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="ma1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1500" id="ma1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="ma1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1600" id="ma1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="ma1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1700" id="ma1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="ma1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1800" id="ma1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="ma1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1900" id="ma1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="ma2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma1700" id="ma2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="ma2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ma2100" id="ma2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Miercoles:</label>
				<br/>
				<label for="mi0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi0700" id="mi0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="mi0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi0800" id="mi0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="mi0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi0900" id="mi0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="mi1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1000" id="mi1000" value="10:00-12:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="mi1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1100" id="mi1100" value="11:00-13:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="mi1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1200" id="mi1200" value="12:00-14:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="mi1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1300" id="mi1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="mi1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1400" id="mi1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="mi1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1500" id="mi1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="mi1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1600" id="mi1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="mi1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1700" id="mi1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="mi1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1800" id="mi1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="mi1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1900" id="mi1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="mi2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi1700" id="mi2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="mi2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="mi2100" id="mi2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Jueves:</label>
				<br/>
				<label for="ju0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju0700" id="ju0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="ju0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju0800" id="ju0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="ju0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju0900" id="ju0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="ju1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1000" id="ju1000" value="10:00-11:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="ju1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1100" id="ju1100" value="11:00-12:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="ju1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1200" id="ju1200" value="12:00-13:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="ju1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1300" id="ju1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="ju1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1400" id="ju1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="ju1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1500" id="ju1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="ju1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1600" id="ju1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="ju1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1700" id="ju1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="ju1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1800" id="ju1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="ju1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1900" id="ju1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="ju2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju1700" id="ju2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="ju2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="ju2100" id="ju2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Viernes:</label>
				<br/>
				<label for="vi0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi0700" id="vi0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="vi0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi0800" id="vi0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="vi0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi0900" id="vi0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="vi1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1000" id="vi1000" value="10:00-11:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="vi1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1100" id="vi1100" value="11:00-12:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="vi1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1200" id="vi1200" value="12:00-13:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="vi1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1300" id="vi1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="vi1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1400" id="vi1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="vi1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1500" id="vi1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="vi1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1600" id="vi1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="vi1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1700" id="vi1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="vi1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1800" id="vi1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="vi1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1900" id="vi1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="vi2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi1700" id="vi2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="vi2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="vi2100" id="vi2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/><br/>
				<label class="width1colmn inputlabel">Sabado:</label>
				<br/>
				<label for="sa0700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa0700" id="sa0700" value="07:00-08:00">
					<i>07:00 - 08:00</i>
				</label>
				<label for="sa0800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa0800" id="sa0800" value="08:00-09:00">
					<i>08:00 - 09:00</i>
				</label>
				<label for="sa0900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa0900" id="sa0900" value="09:00-10:00">
					<i>09:00 - 10:00</i>
				</label>
				<label for="sa1000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1000" id="sa1000" value="10:00-11:00">
					<i>10:00 - 11:00</i>
				</label>
				<label for="sa1100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1100" id="sa1100" value="11:00-12:00">
					<i>11:00 - 12:00</i>
				</label>
				<label for="sa1200" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1200" id="sa1200" value="12:00-13:00">
					<i>12:00 - 13:00</i>
				</label>
				<label for="sa1300" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1300" id="sa1300" value="13:00-14:00">
					<i>13:00 - 14:00</i>
				</label>
				<label for="sa1400" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1400" id="sa1400" value="14:00-15:00">
					<i>14:00 - 15:00</i>
				</label>
				<label for="sa1500" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1500" id="sa1500" value="15:00-16:00">
					<i>15:00 - 16:00</i>
				</label>
				<label for="sa1600" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1600" id="sa1600" value="16:00-17:00">
					<i>16:00 - 17:00</i>
				</label>
				<label for="sa1700" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1700" id="sa1700" value="17:00-18:00">
					<i>17:00 - 18:00</i>
				</label>
				<label for="sa1800" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1800" id="sa1800" value="18:00-19:00">
					<i>18:00 - 19:00</i>
				</label>
				<label for="sa1900" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1900" id="sa1900" value="19:00-20:00">
					<i>19:00 - 20:00</i>
				</label>
				<label for="sa2000" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa1700" id="sa2000" value="20:00-21:00">
					<i>20:00 - 21:00</i>
				</label>
				<label for="sa2100" class="width1colmn inputcheckbox2 width120px">
					<input type="checkbox" class="check-type-2" name="sa2100" id="sa2100" value="21:00-22:00">
					<i>21:00 - 22:00</i>
				</label>
				<br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_personal()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista personal</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>Carnet</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Fecha Inicio</th>
				<th>Direcci&oacute;n</th>
				<th>Usuario</th>
				<th>Contrase&ntilde;a</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($personal)){
			$odd = true;
			foreach($personal as $persona){
				$odd = ($odd) ? false : true;
				echo '<tr class="'.((false) ? "odd" : "").'">';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_personal('<?=$persona->id_personal?>','<?=$persona->id_usuario?>', '<?=$persona->nombre?>')" class="fas fa-trash-alt"></i>
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
				echo '<td>'.$persona->user.'</td>';
				echo '<td>'.$persona->pass.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot>
			<!--
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>Carnet</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Fecha Inicio</th>
				<th>Direcci&oacute;n</th>
			</tr>
			-->
		</tfoot>
	</table>
</div>
