<style>
    table{
        text-align: center;
    }

    th{
        text-align: center;
    }

	#modulosAdmin {
		margin-top: 50px;
	}
</style>

<link href="<?= base_url() ?>disenio/css/jquery-ui-v12.css" rel="stylesheet">
<script src="<?= base_url() ?>disenio/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?= base_url() ?>disenio/js/jquery-ui-1.9.2.custom.js" type="text/javascript" ></script>

<!--activar boton de inicio-->
<script>
	$( function() {
		$('#inicioMenu').addClass('active');
	});
</script>

<div id="modulosAdmin" class="container">
	 <script>
	$( function() {
		$( "#tabs" ).tabs();
	} );
	</script>
	<center>
			<h3>Menú de la Administración</h3>
	</center>
	<br>
	<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Tablas y Datos</a></li>
		<li><a href="#tabs-2">Reportes</a></li>
	</ul>
	<div id="tabs-1">
		<table class="table">
			<thead>
				<tr>
					<th>Asignaturas</th>
					<th>Cursos</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<a href="<?= base_url() ?>admin_/asignaturas/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
					<td>
						<a href="<?= base_url() ?>admin_/curso/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
				</tr>
			</tbody>
			<thead>
				<tr>
					
					<th>Estudiantes</th>
					<th>Docentes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<a href="<?= base_url() ?>admin_/estudiantes/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
					<td>
						<a href="<?= base_url() ?>admin_/docente/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
				</tr>
			</tbody>
			<!--
			<thead>
				<tr>
					<th>Docentes</th>
					
					<th>
						Docente y Cargos
					</th>
					
				</tr>
			</thead>
			
			<tbody>
				<tr>
					<td>
						<a href="<?= base_url() ?>admin_/docente/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
					
					<td>
						<a href="<?= base_url() ?>admin_/docente_cargo/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
					
				</tr>
			</tbody>
			-->
			
		</table>

	</div>
	<div id="tabs-2">
		<table class="table">
			<thead>
				<tr>
					<th>Matrículas</th>
					<th>Notas</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<a href="<?= base_url() ?>admin_/reportes/matriculas/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
					<td>
						<a href="<?= base_url() ?>admin_/curso/" class="btn btn-outline-warning">
							Mostrar...
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	</div>
	<br>

	
    
</div>
