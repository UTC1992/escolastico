<style>
    #contenidoEstudiante {
        
    }
</style>
<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" ng-controller="repoMatriculasCtrl">
	
	<!-- tabla -->
    <div class="">
		<br>
		<input type="hidden" id="urlEstudiantes" value="<?= base_url()?>estudiante_controller/getDataJsonEstudiantesAllInicial">
		
		<center><h4>Reportes por Curso y Paralelo</h4></center>
		
		<div class="col-lg-6">
			
			<form ng-submit="mostrarEstudiantes()">
				<label>Seleccione el año lectivo, el curso y el paralelo:</label>
				<input type="hidden" id="nivelEstudiantes" value="Inicial 2">
				<div class="form-inline">
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
					<select class="form-control" style="margin-right: 5px;" 
					name="anioFin" id="anioFin" ng-model="anioFin" required>
						<option value="">Curso</option>
						<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
					</select>
					<select class="form-control" style="margin-right: 5px;" 
					name="anioFin" id="anioFin" ng-model="anioFin" required>
						<option value="">Paralelo</option>
						<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
					</select>
					<button class="btn btn-info nuevo" type="submit">
						Listar
					</button>
				</div>
			</form>
			
		</div>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sm">
				
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
					<tr ng-repeat="e in $data">
						<td>{{ $index + 1 }}</td>
						<td>{{e.cedula_estu}}</td>
						<td>{{e.apellidos_estu}}</td>
						<td>{{e.nombres_estu}}</td>
						
					</tr>
				</tbody>
				<tr ng-show="mensajeEstudiantes">
					<td colspan="6" >
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
