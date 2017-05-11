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
				<th>Periodo Academico</th>
				<th>Asignatura</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a href="<?= base_url() ?>admin_/periodoacademico/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
				<td>
					<a href="<?= base_url() ?>admin_/asignaturas/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th>Cursos</th>
				<th>Docente</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a href="<?= base_url() ?>admin_/curso/" class="btn btn-outline-warning">
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
		<thead>
			<tr>
				
				<th>Estudiante</th>
				<th>Matrícula</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a href="<?= base_url() ?>admin_/periodoacademico/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
				<td>
					<a href="<?= base_url() ?>admin_/periodoacademico/" class="btn btn-outline-warning">
                        Mostrar...
					</a>
				</td>
			</tr>
		</tbody>
		
	</table>
</div>