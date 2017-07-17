<style>
    #contenidoEstudiante {
        
    }
</style>
<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" ng-controller="repoMatriculasCtrl">
	
	<!--URLS acciones del controlador-->
	<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
	<input type="hidden" id="urlEstudiantes" value="<?= base_url()?>reporte_matriculas_controller/getDataJsonEstudiantesRepoCP">
		
	<!--URLS acciones del controlador-->

	<!--url para años lectivos-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoAll">
	<!--url para años lectivos-->

	<!-- tabla -->
    <div class="">
		<br>
		
		<center><h4>Reportes por Curso y Paralelo</h4></center>
		
		<div class="col-lg-12">
			
			<form ng-submit="mostrarEstudiantesPorCursoP()">
				<label>Seleccione el año lectivo, el curso y el paralelo:</label>
				<input type="hidden" id="nivelEstudiantes" value="Inicial 2">
				<div class="form-inline">
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
					<select class="form-control" style="margin-right: 5px;" 
					name="paraleloRepo" id="paraleloRepo" ng-model="paraleloRepo" required>
						<option value="">Paralelo</option>
						<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
					</select>
					<button class="btn btn-info nuevo" type="submit">
						Listar
					</button>
				</div>
			</form>
			
		</div>
		<br>
		<button class="btn btn-success" ng-click="exportToExcel('#tableToExport')">
				<span class="glyphicon glyphicon-share"></span>
			Descargar Excel
		</button>
		<br>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sm" id="tableToExport">
				
				<thead class="thead-inverse">
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="4"><center>Representante</center></th>
					</tr>
					<tr>
						<th>N°</th>
						<th>Nombre</th>
						<th>Cédula</th>
						<th>Fecha de Nacimiento</th>
						<th>Dirección</th>
						<th>Nombre</th>
						<th>Cédula</th>
						<th>Teléfono</th>
						<th>Correo Electrónico</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="repo in datosMatri">
						<td>{{ $index + 1 }}</td>
						<td>{{repo.apellidos_estu}} {{repo.nombres_estu}}</td>
						<td>'{{repo.cedula_estu}}</td>
						<td>{{repo.fechanacimiento_estu}}</td>
						<td>{{repo.direccion_estu}}</td>
						<td>{{repo.representante_estu}}</td>
						<td>'{{repo.cedula_representante_estu}}</td>
						<td>'{{repo.telefono_representante_estu}}</td>
						<td>{{repo.correo_repre_estu}}</td>
					</tr>
				</tbody>
				
			</table>
			<table>
				<tr ng-show="mensajeEstudiantes">
					<td colspan="9" >
						<center>
							<div  class="alert alert-danger" style="color: crimson;">
								<strong>* No existen estudiantes en el año lectivo, curso y paralelo seleccionados.</strong>
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
