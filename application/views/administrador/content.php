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


<div id="modulosAdmin" class="container">
	<center>
			<h3>Datos a administrar</h3>
	</center>
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
		<thead>
			<tr>
				
				<th>Estudiantes</th>
				<th>
					Matrículas
				</th>
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
					<a href="<?= base_url() ?>admin_/matricular/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
			</tr>
		</tbody>
		<!--
		<thead>
			<tr>
				
				<th><label class="col-form-label">
					Matrículas
					</label></th>
				<th>Estudiantes</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a href="<?= base_url() ?>admin_/matricular/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
				<td>
					<a href="<?= base_url() ?>admin_/estudiantes/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
			</tr>
		</tbody>
		-->
		
	</table>
</div>
