<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasIngresoCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>ingresar_notas_controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>curso_controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>ingresar_notas_controller/insertar">

		<!--MOSTRAR INFORMES DE NOTAS-->
		<input type="hidden" id="urlInformes1" value="<?= base_url()?>ingresar_notas_controller/getDataJsonInformesParcial1">
		<input type="hidden" id="urlInformes2" value="<?= base_url()?>ingresar_notas_controller/getDataJsonInformesParcial2">
		<input type="hidden" id="urlInformes3" value="<?= base_url()?>ingresar_notas_controller/getDataJsonInformesParcial3">
	<!--urls-->
	
	<!--head -->
	<div class="container">
		<center><h4>Informes por parciales</h4></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<div class="table-responsive">
			<form ng-submit="mostrarDatosInformes()">
				<table class="table table-striped table-bordered table-sm">
					<thead class="thead-inverse">
						<tr>
							<th colspan="4">
								LLene el siguiente formulario porfavor:
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label>Curso:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="cursoId" required>
									<option value="">Seleccione</option>
									<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
								</select>
							</td>
							<td><label>Paralelo:</label></td>
							<td>
								<select class="form-control" style="width: 150px;" ng-model="paralelo" required>
									<option value="">Seleccione</option>
									<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Año lectivo:</label></td>
							<td>
								<div class="form-inline">
									<select class="form-control" style="width: 97px; margin-right: 5px;" ng-model="anioI" required>
										<option value="">Inicio</option>
										<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
									</select>
									<select class="form-control" style="width: 97px;" ng-model="anioF" required>
										<option value="">Fin</option>
										<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
									</select>
								</div>
							</td>
							<td><label>Materia:</label></td>
							<td>
								<select class="form-control" style="width: 350px;" ng-model="materia" required>
									<option value="">Seleccione</option>
									<option ng-repeat="a in asignatura" style="font-size: 10pt;" value="{{a.nombre_asig}}">{{a.nombre_asig}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Parcial:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="parcial" required>
									<option value="">Seleccione</option>
									<option value="1ero">1ero</option>
									<option value="2do">2do</option>
									<option value="3ero">3ero</option>
								</select>
							</td>
							</td>
							<td><label>Quimestre:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="quimestre" required>
									<option value="">Seleccione</option>
									<option value="1ero">1ero</option>
									<option value="2do">2do</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<center>
									<button type="submit" class="btn btn-outline-warning">Enviar Datos</button>
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	<!--datos consultar-->
		
		<!--tabla de estudiantes-->
          <div class="table-responsive">
            <form ng-submit="">
				<table class="table table-bordered table-striped table-sm">
					
				<thead class="thead-inverse">
					<tr ng-show="mensaje">
						<td colspan="9" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
					<th colspan="9"><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Parcial:</strong></label><label> {{ParcialInfo}}</label>
						</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Materia:</strong></label><label> {{MateriaInfo}}</label>
						</td>
						<td colspan="3">
							<label style="margin-right: 5px;">
							<strong>Quimestre:</strong></label><label> {{QuimestreInfo}}</label>
						</td>
						<td></td>
					</tr>

					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="4">
							<center> Parámetros </center>
						</th>
						<th colspan="2">
							<center>Totalizados</center>
						</th>
					</tr>
					<tr>
						<th rowspan="2">N°</th>
						<th rowspan="2" style="width: 300px;">Estudiantes</th>
						<th>Materia</th>
						<th>Deberes</th>
						<th>Lecciones orales o escritas</th>
						<th>Trabajos grupales</th>
						<th>Trabajos de investigación</th>
						<th>Sumatoria</th>
						<th>Promedio</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="estu in estudiantesInformes">
						<td>{{$index + 1}}</td>
						<td>
							<label style="width: 400px;">{{estu.apellidos_estu}} {{estu.nombres_estu}}</label>
						</td>
						<td>{{estu.asignatura_p1}}</td>
						<td>{{estu.parametro1_p1}}</td>
						<td>{{estu.parametro2_p1}}</td>
						<td>{{estu.parametro3_p1}}</td>
						<td>{{estu.parametro4_p1}}</td>
						<td>{{estu.sumatoria}}</td>
						<td>{{estu.promedio}}</td>
					</tr>
					<tr ng-show="mensaje">
						<td colspan="9" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="9" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
					<tr ng-show="mensajeIngreso">
						<td colspan="9" >
							<center>
								<div  class="alert alert-success">
									<strong>* Las notas fueron ingresadas con exito.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<!--
						<td colspan="9">
							<center>
								<button type="submit" class="btn btn-outline-warning">Enviar Datos</button>
							</center>
						</td>
						-->
					</tr>
				</tbody>
				</table>
            </form>
          </div>
		  <!--tabla de estudiantes-->

</div>
<!--INICIO CONTENEDOR-->
