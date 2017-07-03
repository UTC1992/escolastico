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

		<input type="hidden" id="urlIngresarNotasParcial1" value="<?= base_url() ?>ingresar_notas_controller/insertar1">
		<input type="hidden" id="urlIngresarNotasParcial2" value="<?= base_url() ?>ingresar_notas_controller/insertar2">
		<input type="hidden" id="urlIngresarNotasParcial3" value="<?= base_url() ?>ingresar_notas_controller/insertar3">

		<input type="hidden" id="urlNumRegistros1" value="<?= base_url() ?>ingresar_notas_controller/getDataJsonContar1">
		<input type="hidden" id="urlNumRegistros2" value="<?= base_url() ?>ingresar_notas_controller/getDataJsonContar2">
		<input type="hidden" id="urlNumRegistros3" value="<?= base_url() ?>ingresar_notas_controller/getDataJsonContar3">
	<!--urls-->

	<!--buscar asignaturas segun id del Curso-->
		<input type="hidden" id="urlAsignaturasCurso" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonAsignaturasDeCurso">
		
	<!--url para las paginas-->
		<input id="urlBuscarAniosLectivosActivo" type="hidden" value="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoActivo">
	<!--url para las paginas-->
	
	<!--head -->
	<div class="container">
		<center><h2>Notas parciales</h2></center>
		<center><h3>Registro</h3></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<div class="table-responsive">
			<form  ng-submit="verificarRegistro()">
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
								<select class="form-control" style="width: 200px;" ng-model="cursoId" ng-change="cargarAsignaturas()" required>
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
									<input name="aniosL" id="aniosL" ng-model="aniosL" type="hidden" value="">
									 <input  type="text" class="form-control" style="width: 300px;" ng-disabled="true"
									 value="{{AL.mesinicio_pera}} {{AL.anioinicio_pera}} - {{AL.mesfin_pera}} {{AL.aniofin_pera}}">
								</div>
							</td>
							<td><label>Materia:</label></td>
							<td>
								<select class="form-control" style="width: 350px;" ng-model="materia" required>
									<option value="">Seleccione</option>
									<option ng-repeat="a in asignatura | orderBy: 'asig'" 
									style="font-size: 10pt;" value="{{a.asig}}">{{a.asig}}</option>
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
            <form name="fIngresoNotas" ng-submit="mostrarDatos()">
				<table class="table table-bordered table-striped table-sm" style="font-size: 10pt;">
				<thead class="thead-inverse">
					<tr ng-show="mensajeNumRegistros">
						<td colspan="10" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>La informamos que las notas ya se registraron, puede consultarlo 
									dando clic en el menú (superior o lateral) en opción Consulta y Edición.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr ng-show="mensaje">
						<td colspan="10" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
					<th colspan="10"><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Parcial:</strong></label><label> {{ParcialInfo}}</label>
						</td>
					</tr>
					<tr>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Materia:</strong></label><label> {{MateriaInfo}}</label>
						</td>
						<td colspan="4">
							<label style="margin-right: 5px;">
							<strong>Quimestre:</strong></label><label> {{QuimestreInfo}}</label>
						</td>
					</tr>

					<tr>
						<th></th>
						<th></th>
						<th colspan="4">
							<center> PARÁMETROS </center>
						</th>
						<th colspan="2">
							<center> FALTAS </center>
						</th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>N°</th>
						<th style="width: 200px;">Estudiantes</th>
						<th>Deberes</th>
						<th>Lecciones orales o escritas</th>
						<th>Trabajos grupales</th>
						<th>Trabajos de investigación</th>
						<th>Falt. Just.</th>
						<th>Falt. Injus.</th>
						<th>Dias Asis.</th>
						<th>Comportamiento</th>
					</tr>
				</thead>
				<tbody >
					<tr ng-repeat="estu in estudiantesMatriculados">
						<td>{{$index + 1}}</td>
						<td>
							<label style="width: 200px;">{{estu.apellidos_estu}} {{estu.nombres_estu}}</label>
							<input type="hidden" value="{{estu.id_estu}}" name="notaE">
						</td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
						<td><input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 70px;" required></td>
					</tr>
					<tr ng-show="mensaje">
						<td colspan="10" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="10" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
					<tr ng-show="mensajeIngreso">
						<td colspan="10" >
							<center>
								<div  class="alert alert-success">
									<strong>* Las notas fueron ingresadas con exito.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="10">
							<center>
								<button ng-disabled="ingresarDesactivar" type="submit" class="btn btn-outline-warning">Enviar Datos</button>
							</center>
						</td>
					</tr>
				</tbody>
				</table>
            </form>
          </div>
		  <!--tabla de estudiantes-->

</div>
<!--INICIO CONTENEDOR-->
