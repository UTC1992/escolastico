<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="ingresoExaGraciaCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>Curso_Controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>Asignaturas_Controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>Ingresar_Notas_Controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>Curso_Controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>Ingresar_Notas_Controller/insertar">

		<input type="hidden" id="urlNotasTotalesGracia" value="<?= base_url() ?>Ingresar_Notas_Controller/getDataJsonConsultaNotasTotalesGracia">
		
		<!--MOSTRAR INFORMES DE NOTAS-->
		<!---->
		<input type="hidden" id="urlNotasGraciaEdit" value="<?= base_url()?>Ingresar_Notas_Controller/getDataJsonNotasEditGracia">

		<!---->
		<input type="hidden" id="urlActualizarGracia" value="<?= base_url()?>Ingresar_Notas_Controller/actualizarGracia/">
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
		<center><h2>Exámen Gracia</h2></center>
		<center><h3>Consulta y edición</h3></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<div class="table-responsive">
			<form ng-submit="consultaExaMejora()">
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
		<button class="btn btn-success" ng-click="exportToExcel('#tableToExport')">
				<span class="glyphicon glyphicon-share"></span>
			Descargar Excel
		</button>
		<br>
		<br>
		<!--tabla de estudiantes-->
          <div class="table-responsive">
            <form ng-submit="">
				<table>
					<tr ng-show="mensaje">
						<td colspan="7" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
				</table>
				<table class="table table-bordered table-striped table-sm"
				id="tableToExport">
					
				<thead class="thead-inverse">
					
					<tr>
					<th colspan=7><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
					</tr>
					<tr>
						<td colspan="3"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Materia:</strong></label><label> {{MateriaInfo}}</label>
						</td>
					</tr>
					<tr>
						<th>N°</th>
						<th colspan="3">Estudiantes</th>
						<!--
						<th>Nota Q1</th>
						<th>Nota Q2</th>
						-->
						<th colspan="2">Examen Gracia</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="estu in estudiantesMatriculados | orderBy: 'apellidos_estu'">
						<td>{{$index + 1}}</td>
						<td colspan="3">
							<label>{{estu.apellidos_estu}} {{estu.nombres_estu}}</label>
							<input type="hidden" value="{{estu.id_estu}}" name="notaE">
						</td>
						<!--
						<td>
							<label>{{estu.NotaQ1}}</label>
						</td>
						<td>
							<label>{{estu.NotaQ2}}</label>
						</td>
						-->
						<td colspan="2">
							<!--
								<input class="form-control" name="notaE" type="text" value="{{estu.notaSuple}}" placeholder="00.00" style="width: 100px;" required>
								-->
							{{estu.notaGracia}}
						</td>
						<td>
							<button style="width: 100px;" class="btn btn-outline-warning editar" 
							ng-click="mostrarNotasGraciaEditar($event)" 
							id="{{estu.id_gra}}" data-toggle="modal" data-target="#modalEditar">
								Editar
							</button>
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
				<table>
					<tr ng-show="mensaje">
						<td colspan="7" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="7" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
					<tr ng-show="mensajeIngreso">
						<td colspan="7" >
							<center>
								<div  class="alert alert-success">
									<strong>* Las notas fueron ingresadas con exito.</strong>
								</div>
							</center>
						</td>
					</tr>	
				</table>
            </form>
          </div>
		  <!--tabla de estudiantes-->

		  <!--INICIO MODAL EDITAR-->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="modalEditarLabel">Editar la nota del Exámen.</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<input type="hidden" value="">
						
							<div class="row justify-content-md-center">
								<div class="col-12">
								
								<div  class="alert alert-success" ng-show="edicionExitosa">
									<strong>* Las notas fueron actualizadas con éxito.</strong>
								</div>
								<div  class="alert alert-danger" ng-show="edicionFallida">
									<strong>* Error al actualizar las notas.</strong>
								</div>
								<form name="fExaEditar" ng-submit="procesoActualizar()" class="form-horizontal">
									
									<input type="hidden" id="idGraciaEdit" value="{{idSuple}}">

									<div class="form-group row">
											<label class="col-3 col-form-label">Nota de Exámen de gracia:</label>
											<div class="col-4">
												<input class="form-control" name="notaSuple" id="notaSuple" ng-model="notaSuple"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fExaEditar.notaSuple.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fExaEditar.notaSuple.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>
									<div class="modal-footer">
										<button class="col-3 btn btn-primary" type="submit" 
										ng-disabled="fExaEditar.$error.required">
											<span class="glyphicon glyphicon-floppy-saved"></span>
											Actualizar
										</button>
										<button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Cerrar</button>
									</div>
								</form>
								</div>
							</div>
					</div>
					
					</div>
				</div>
			</div>
			<!--FIN MODAL EDITAR-->


</div>
<!--INICIO CONTENEDOR-->
