<style>
    #contenidoEstudiante {
        
    }
</style>
<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" ng-controller="repoMatriculasCtrl">
	<!--URLS acciones del controlador-->
	<input type="hidden" id="urlCursos" value="<?= base_url()?>Curso_Controller/getDataJsonCursoAll">
	<input type="hidden" id="urlEstudiantes" value="<?= base_url()?>Reporte_Matriculas_Controller/getDataJsonEstudiantesReporte">
		
	<!--URLS acciones del controlador-->

	<!--url para años lectivos-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>Periodoa_Controller/getDataJsonPeriodoAll">
	<!--url para años lectivos-->

	<!-- tabla -->
    <div class="">
		<br>
		<input type="hidden" id="urlEstudiantes" value="<?= base_url()?>Estudiante_Controller/getDataJsonEstudiantesAllInicial">
		
		<center><h4>Reportes por Curso</h4></center>
		
		<div class="col-lg-12">
			
			<form ng-submit="mostrarEstudiantesPorCurso()">
				<label>Seleccione el año lectivo y el curso:</label>
				<input type="hidden" id="nivelEstudiantes" value="Inicial 2">
				<div class="form-inline">
					<!--
					<select class="form-control" style="margin-right: 5px;" name="anioInicio" 
					id="anioInicio" ng-model="anioInicio" required>
						<option value="">Inicio</option>
						<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
					</select>
					<select class="form-control" style="margin-right: 5px;" 
					name="anioFin" id="anioFin" ng-model="anioFin" required>
						<option value="">Fin</option>
						<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
					</select>
					-->
					<select class="form-control" style="margin-right: 5px;" 
					name="aniosL" id="aniosL" ng-model="aniosL" required>
						<option value="">Seleccionar</option>
						<option ng-repeat="a in aniosLectivos" value="{{a.anioinicio_pera}}-{{a.aniofin_pera}}">
						{{a.mesinicio_pera}} {{a.anioinicio_pera}} - {{a.mesfin_pera}} {{a.aniofin_pera}}
						</option>
					</select>
					<select class="form-control" style="margin-right: 5px;" 
					name="cursoEstu" id="cursoEstu" ng-model="cursoEstu" required>
						<option value="">Curso</option>
						<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
					</select>
					<button class="btn btn-info nuevo" type="submit">
						Listar
					</button>
				</div>
			</form>
			
		</div>


		<br>
		<button class="btn btn-success" ng-click="exportToExcel('#tableToExport')"
		data-toggle="tooltip" data-placement="top" title="Exportar la tabla a Excel">
				<span class="glyphicon glyphicon-share"></span>
			Descargar Excel
		</button>
		<br>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sm" id="tableToExport">
				
				<thead class="thead-inverse">
					<tr>
						<th>N°</th>
						<th>Apellidos</th>
						<th>Nombres</th>
						<th>Cédula</th>
						<th>Paralelo</th>
						<th>Dirección Domiciliaria</th>
						<th>N° Matrícula</th>
						<th>N° Folio</th>
						<th>Teléfono</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="repo in datosMatri | orderBy : 'apellidos_estu'">
						<td>{{ $index + 1 }}</td>
						<td>'{{repo.cedula_estu}}</td>
						<td>{{repo.apellidos_estu}}</td>
						<td>{{repo.nombres_estu}}</td>
						<td>{{repo.paralelo_matr}}</td>
						<td>{{repo.direccion_estu}}</td>
						<td>{{repo.id_matr}}</td>
						<td>{{repo.id_matr}}</td>
						<td>'{{repo.telefono_representante_estu}}</td>
					</tr>
				</tbody>
				
			</table>

			<table>
				<tr ng-show="mensajeEstudiantes">
					<td colspan="9" >
						<center>
							<div  class="alert alert-danger" style="color: crimson;">
								<strong>* No existen estudiantes en el año lectivo y curso seleccionados.</strong>
							</div>
						</center>
					</td>
				</tr>
			</table>
		</div>
	<!--fin table-->
	</div>



	</div>
<!--FIN CONTENEDOR-->

<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
</script>
