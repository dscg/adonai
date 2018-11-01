<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
<!--
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/datatables.min.css" media="screen" />
-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap-4.1.1.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/dataTables.bootstrap4.min.css" media="screen" />
</head>
<body>
	<div class="window-popup">
		<div class="window">
			<h1 class="window-header"><span class="window-title">Nuevo Video</span><i class="fas fa-times window-title-icon"></i></h1>
			<div class="window-content height2row">
				<input type="text" name="title" id="title" class="inputtext width70pt" placeholder="Nombre del video" required />
				<br/><br/>
				<input type="file" name="file" id="file" class="inputfile inputsize70" required />
				<label for="file" id="file-label"><i class="fas fa-upload"></i> Seleccione un Archivo</label>
			</div>
			<div class="window-buttons">
				<button class="window-button">Salir</button>
				<button class="window-button" autofocus>Guardar</button>
			</div>
		</div>
	</div>
	<nav>
		<ul class="menu">
			<li><a href="#">Personal</a>
				<ul>
					<li><a href="#"><i class="fas fa-plus-circle"></i><span>Nuevo</span></a></li>
					<li><a href="#"><i class="fas fa-pencil-alt"></i><span>Editar</span></a></li>
					<li><a href="#"><i class="fas fa-trash-alt"></i><span>Eliminar</span></a></li>
				</ul>
			</li>
			<li><a href="#">Videos</a>
				<ul>
					<li><a href="#"><i class="fas fa-plus-circle"></i><span>Nuevo</span></a></li>
					<li><a href="#"><i class="fas fa-pencil-alt"></i><span>Editar</span></a></li>
					<li><a href="#"><i class="fas fa-trash-alt"></i><span>Eliminar</span></a></li>
				</ul>
			</li>
			<li><a href="#">Salir</a></li>
		</ul>
	</nav>
	<section>
		<div class="container_12">
			<table id="tabla-videos" class="display cell-border table-striped table-bordered" style="width:100%">
   				<thead>
					<tr>
						<th>Acci&oacute;n</th>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td  class="acction-setting"><i class="fas fa-trash-alt"></i><i class="fas fa-pencil-alt"></i></td>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
					</tr>
					<tr>
						<td  class="acction-setting"><i class="fas fa-pencil-alt"></i><i class="fas fa-trash-alt"></i></td>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
					</tr>
					<tr>
						<td  class="acction-setting"><i class="fas fa-pencil-alt"></i><i class="fas fa-trash-alt"></i></td>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2009/01/12</td>
						<td>$86,000</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2012/03/29</td>
						<td>$433,060</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2008/11/28</td>
						<td>$162,700</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2012/12/02</td>
						<td>$372,000</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2012/08/06</td>
						<td>$137,500</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2010/10/14</td>
						<td>$327,900</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2009/09/15</td>
						<td>$205,500</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2008/12/13</td>
						<td>$103,600</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Jena Gaines</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>30</td>
						<td>2008/12/19</td>
						<td>$90,560</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Quinn Flynn</td>
						<td>Support Lead</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2013/03/03</td>
						<td>$342,000</td>
					</tr>
					<tr>
						<td><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Charde Marshall</td>
						<td>Regional Director</td>
						<td>San Francisco</td>
						<td>36</td>
						<td>2008/10/16</td>
						<td>$470,600</td>
					</tr>
					<tr>
						<td class="acction-setting"><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Haley Kennedy</td>
						<td>Senior Marketing Designer</td>
						<td>London</td>
						<td>43</td>
						<td>2012/12/18</td>
						<td>$313,500</td>
					</tr>
					<tr>
						<td class="acction-setting"><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Tatyana Fitzpatrick</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>19</td>
						<td>2010/03/17</td>
						<td>$385,750</td>
					</tr>
					<tr>
						<td class="acction-setting"><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Michael Silva</td>
						<td>Marketing Designer</td>
						<td>London</td>
						<td>66</td>
						<td>2012/11/27</td>
						<td>$198,500</td>
					</tr>
					<tr>
						<td class="acction-setting"><i class="fas fa-pencil-alt"/><i class="fas fa-trash-alt"/></td>
						<td>Paul Byrd</td>
						<td>Chief Financial Officer (CFO)</td>
						<td>New York</td>
						<td>64</td>
						<td>2010/06/09</td>
						<td>$725,000</td>
					</tr>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
<!--
			<div class="grid_12">
				<h1 style="text-align: center">Bienvenido de nuevo <?=$this->session->userdata('perfil')?></h1>
				<?=anchor(base_url().'login/logout_ci', 'Cerrar sesión')?>
			</div>
		 <script src="<?=base_url()?>js/jquery.dataTables-1.10.19.min.js"></script>
-->
		</div>
		 <script src="<?=base_url()?>js/jquery-1.12.4.min.js"></script>
		 <script src="<?=base_url()?>js/datatables.min.js"></script>
		 <script src="<?=base_url()?>js/dataTables.bootstrap4.min.js"></script>
		<script>
			$(document).ready(function() {
				var screen_height = $(window).height()-250;
				var table = $('#tabla-videos').DataTable({
					bProcessing: true,
					scrollY: screen_height,
					lengthMenu: [
						[10, 25, 50, -1],
						['10 Lineas', '25 Lineas', '50 Lineas', 'Mostrar Todo']
					],
					language: {
						"sProcessing":     "Procesando...",
						"sLengthMenu":     "Mostrar _MENU_ registros",
						"sZeroRecords":    "No se encontraron resultados",
						"sEmptyTable":     "Ningún dato disponible en esta tabla",
						"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":    "",
						"sSearch":         "Buscar:",
						"sUrl":            "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "Primero",
							"sLast":     "Último",
							"sNext":     "Siguiente",
							"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					}
				});
				$('<i class="fas fa-plus-circle new-video"> Subir Video</i>').appendTo('div.dataTables_wrapper');

				var inputfile = 2;
				document.getElementById("file").onchange = function () {
					var label = document.getElementById("file-label");
					var size_name = this.value.length;
					label.innerHTML = (size_name > 1) ? this.value.split( '\\' ).pop() : "<i class=\"fas fa-upload\"></i> Seleccione un Archivo";
					label.style.backgroundColor = (size_name > 1) ? "rgba(44, 124, 222, 0.8)" : "rgba(111, 122, 133, 0.8)";
				};
			});
		</script>
	</section>
</body>
</html>
