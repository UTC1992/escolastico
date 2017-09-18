<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasIngresoExaCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>Curso_Controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>Asignaturas_Controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>Ingresar_Notas_Controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>Curso_Controller/getDataJsonCursoId/">

		<input type="hidden" id="urlIngresarNotasExamen" value="<?= base_url() ?>Ingresar_Notas_Controller/insertarExa">

		<input type="hidden" id="urlNumRegistros1" value="<?= base_url() ?>Ingresar_Notas_Controller/getDataJsonContarExa1">
	<!--urls-->

	<!--url para las paginas-->
		<input id="urlBuscarAniosLectivosActivo" type="hidden" value="<?= base_url() ?>Periodoa_Controller/getDataJsonPeriodoActivo">
	<!--url para las paginas-->

	<!--buscar asignaturas segun id del Curso-->
		<input type="hidden" id="urlAsignaturasCurso" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonAsignaturasDeCurso">
	
	<!--CONSULTAR CARGOS Y DATOS ASIGNADOS AL DOCENTE-->
		<input id="urlCargosDocente" type="hidden" value="<?= base_url() ?>Docente_Cargo_Controller/getDataJsonCargoDocente">
		<input id="urlNombreCurso" type="hidden" value="<?= base_url() ?>Curso_Controller/getDataJsonNombreCurso">
	<!--url para las paginas-->

	<!--ID DEL DOCENTE-->
	<?php
		$docenteCargo = $this->session->userdata('docenteCargo_doce');
		$idDocente = $this->session->userdata('id_doce');
		?>
		<input name="nombreDoce" id="nombreDoce" type="hidden" value="<?= $docenteCargo?>">

	<!--ID DEL DOCENTE-->
	
	<!--head -->
	<div class="container">
		<center><h2>Exámenes Quimestrales</h2></center>
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
								LLene el siguiente formulario por favor:
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label>Año lectivo:</label></td>
							<td colspan="3">
								<div class="form-inline">
									<input name="aniosL" id="aniosL" ng-model="aniosL" type="hidden" 
									value="{{AL.anioinicio_pera}}-{{AL.aniofin_pera}}">
									 <input  type="text" class="form-control" style="width: 600px;" ng-disabled="true"
									 value="{{AL.mesinicio_pera}} {{AL.anioinicio_pera}} - {{AL.mesfin_pera}} {{AL.aniofin_pera}}">
									
								</div>
							</td>
						</tr>
						<tr>
							<td><label>Cursos, paralelo y materia:</label></td>
							<td colspan="3">
								<select class="form-control" ng-model="cargoCPM" style="width: 600px;" required>
									<option value="">Seleccione</option>
									<option ng-repeat="dc in datosCargo" 
									value="{{dc.curso_cargo}}-{{dc.paralelo_cargo}}-{{dc.asignatura_cargo}}">
									{{dc.curso_cargo}} - {{dc.paralelo_cargo}} - {{dc.asignatura_cargo}}</option>
								</select>
							</td>
						</tr>
						<tr>	
							<td><label>Quimestre:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="quimestre" required>
									<option value="">Seleccione</option>
									<option value="1ero">1ero</option>
									<option value="2do">2do</option>
								</select>
							</td>
							<td></td>
							<td></td>
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
            <form name="fIngresoNotas" ng-submit="enviarDatosExa()">
				<table class="table table-bordered table-striped table-sm">
				<thead class="thead-inverse">
					<tr ng-show="mensajeNumRegistros">
						<td colspan="6" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>Le informamos que las notas ya se registraron, puede consultarlas 
									dando clic en el menú lateral en la sección Consulta y Edición.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr ng-show="mensaje">
						<td colspan="6" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
					<th colspan="6"><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
						<td colspan="2">
							<label style="margin-right: 5px;">
							<strong>Quimestre:</strong></label><label> {{QuimestreInfo}}</label>
						</td>
					</tr>
					<tr>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Materia:</strong></label><label> {{MateriaInfo}}</label>
						</td>
						<td colspan="2">
						</td>
					</tr>
					<tr>
						<th>N°</th>
						<th colspan="2">Estudiantes</th>
						<th colspan="2">Exámen Quimestral</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="estu in estudiantesMatriculados">
						<td >{{$index + 1}}</td>
						<td colspan="2">
							<label>{{estu.apellidos_estu}} {{estu.nombres_estu}}</label>
							<input type="hidden" value="{{estu.id_estu}}" name="notaE">
						</td>
						<td colspan="2">
							<input class="form-control" name="notaE" type="text" value="" placeholder="00.00" style="width: 100px;" required>
						</td>
						
					</tr>
					<tr ng-show="mensaje">
						<td colspan="6" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="6" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
					<tr ng-show="mensajeIngreso">
						<td colspan="6" >
							<center>
								<div  class="alert alert-success">
									<strong>* Las notas fueron ingresadas con éxito.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="6">
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
