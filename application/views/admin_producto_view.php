<div class="message-view-popup">
	<div class="message-view">
		<h1 class="message-view-header"><span class="message-view-title">Vista Informaci&oacute;n</span><i class="fas fa-times message-view-title-icon" onClick="cerrar_info_producto()"></i></h1>
		<div class="message-view-content height6row scrollableY"></div>
		<div class="message-view-buttons">
			<button class="message-view-button" id="msgv-btn-salir" onClick="cerrar_info_producto()">Salir</button>
			<button class="message-view-button" id="msgv-btn-guardar"onClick="cerrar_info_producto()" autofocus>Cerrar</button>
		</div>
	</div>
</div>
<div class="message-popup">
	<div class="message">
		<h1 class="message-header"><span class="message-title">Eliminar Producto</span><i class="fas fa-times message-title-icon" onClick="cerrar_eliminar_producto()"></i></h1>
		<div class="message-content height1row"></div>
		<div class="message-buttons">
			<button class="message-button" id="msg-btn-salir" onClick="cerrar_eliminar_producto()">Salir</button>
			<button class="message-button" id="msg-btn-guardar"onClick="eliminar_producto()" autofocus>Eliminar</button>
		</div>
	</div>
</div>
<div class="window-popup">
	<form action="<?=base_url()?>admin/crearProducto" onSubmit="return guardar_producto(this);" method="post" enctype="multipart/form-data" id="form">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Producto</span><i class="fas fa-times window-title-icon" onClick="cerrar_ventana_producto()"></i></h1>
			<div class="window-content height4row scrollableY">
				<label class="width3colmn inputlabel">Nombre:</label>
				<label class="width3colmn inputlabel">Codigo:</label>
				<label class="width3colmn inputlabel">Cantidad:</label>
				<input class="width3colmn inputtext" type="text" name="nombre" id="nombre" placeholder="Producto" required/>
				<input class="width3colmn inputtext" type="text" name="codigo" id="codigo" required/>
				<input class="width3colmn inputtext" type="number" min="0" name="cantidad" id="cantidad" required />
				<br/><br/>
				<label class="width2colmn inputlabel">Precio de Compra:</label>
				<label class="width2colmn inputlabel">Precio de Venta:</label>
				<input class="width2colmn inputtext" type="number" min="0" name="precio_compra" id="precio_compra" required />
				<input class="width2colmn inputtext" type="number" min="0" name="precio_venta" id="precio_venta" required />
				<br/><br/>
				<label class="width1colmn inputlabel fontcenter">Imagen:</label>
				<br/>
				<input type="file" name="file" id="file" class="inputfile inputsize70" accept="image/*"/>
				<label for="file" class="width70pt" id="file-label"><i class="fas fa-upload"></i> Seleccione un Archivo</label>
				<br/><br/>
			</div>
			<div class="window-buttons">
				<button class="window-button" id="btn-salir" type="reset" onClick="cerrar_ventana_producto()">Salir</button>
				<button class="window-button" id="btn-guardar" type="submit" autofocus>Guardar</button>
			</div>
		</div>
	</form>
</div>
<div class="container col-12">
	<table id="tabla" class="display cell-border table-striped table-bordered" style="width:100%">
		<caption>Lista productos</caption>
		<thead>
			<tr>
				<th>Acci&oacute;n</th>
				<th>Nombre</th>
				<th>C&oacute;digo</th>
				<th>Cantidad</th>
				<th>Precio Compra</th>
				<th>Precio Venta</th>
				<th>Icono</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($productos)){
			foreach($productos as $producto){
				echo '<tr>';
				echo '<td class="action-setting">'
				?>
				<i onClick="ver_eliminar_producto('<?=$producto->id_producto?>', '<?=$producto->nombre?>')" class="fas fa-trash-alt"></i>
				<i onClick="ver_editar_producto('<?=$producto->id_producto?>')" class="fas fa-pencil-alt"></i>
				<i onClick="ver_info_producto('<?=$producto->id_producto?>')" class="fas fa-eye"></i>
				<?php
				echo '</td>';
				echo '<td>'.$producto->nombre.'</td>';
				echo '<td>'.$producto->codigo.'</td>';
				echo '<td>'.$producto->cantidad.'</td>';
				echo '<td>'.$producto->precio_compra.'</td>';
				echo '<td>'.$producto->precio_venta.'</td>';
				echo '<td>'.$producto->img.'</td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
		<tfoot></tfoot>
	</table>
</div>
