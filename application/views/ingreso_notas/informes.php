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

		<!--MOSTRAR NOTAS DE CADA ESTUDIANTES POR PARCIAL PARA EDITAR-->
		<input type="hidden" id="urlNotasEdit1" value="<?= base_url()?>ingresar_notas_controller/getDataJsonNotasEdit1">
		<input type="hidden" id="urlNotasEdit2" value="<?= base_url()?>ingresar_notas_controller/getDataJsonNotasEdit2">
		<input type="hidden" id="urlNotasEdit3" value="<?= base_url()?>ingresar_notas_controller/getDataJsonNotasEdit3">

		<!--URL PARA ACTUALIZAR LAS NOTAS DE UN PARCIAL-->
		<input type="hidden" id="urlActualizarParcial1" value="<?= base_url()?>ingresar_notas_controller/actualizar1/">
		<input type="hidden" id="urlActualizarParcial2" value="<?= base_url()?>ingresar_notas_controller/actualizar2/">
		<input type="hidden" id="urlActualizarParcial3" value="<?= base_url()?>ingresar_notas_controller/actualizar3/">
	<!--urls-->
	
	<!--url para las paginas-->
		<input id="urlBuscarAniosLectivosActivo" type="hidden" value="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoActivo">
	<!--url para las paginas-->

	<!--buscar asignaturas segun id del Curso-->
		<input type="hidden" id="urlAsignaturasCurso" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonAsignaturasDeCurso">
	
	<!--CONSULTAR CARGOS Y DATOS ASIGNADOS AL DOCENTE-->
		<input id="urlCargosDocente" type="hidden" value="<?= base_url() ?>docente_cargo_controller/getDataJsonCargoDocente">
		<input id="urlNombreCurso" type="hidden" value="<?= base_url() ?>curso_controller/getDataJsonNombreCurso">
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
		<center><h2>Notas parciales</h2></center>
		<center><h3>Consulta y Edición</h3></center>
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
							<td><label>Año lectivo:</label></td>
							<td colspan="3">
								<div class="form-inline">
									<input name="aniosL" id="aniosL" ng-model="aniosL" type="hidden" value="">
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
							<td><label>Parcial:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="parcial" required>
									<option value="">Seleccione</option>
									<option value="1ero">1ero</option>
									<option value="2do">2do</option>
									<option value="3ero">3ero</option>
								</select>
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
						<td colspan="11" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>	
				</table>
				<table class="table table-bordered table-striped table-sm"
				id="tableToExport" style="font-size: 10pt;">
					
				<thead class="thead-inverse">
					
					<tr>
					<th colspan="12"><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Parcial:</strong></label><label> {{ParcialInfo}}</label>
						</td>
					</tr>
					<tr>
						<td colspan="4"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td colspan="4"><label style="margin-right: 5px;">
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
						<th></th>
						<th colspan="2">
							<center> FALTAS </center>
						</th>
						<th></th>
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
						<th>Evaluación</th>
						<th>Falt. Just.</th>
						<th>Falt. Injus.</th>
						<th>Horas Asis.</th>
						<th>Comportamiento</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="estu in estudiantesInformes">
						<td>{{$index + 1}}</td>
						<td>
							<label style="width: 200px;">{{estu.apellidos_estu}} {{estu.nombres_estu}}</label>
						</td>
						<td>{{estu.parametro1}}</td>
						<td>{{estu.parametro2}}</td>
						<td>{{estu.parametro3}}</td>
						<td>{{estu.parametro4}}</td>
						<td>{{estu.evaluacion}}</td>
						<td>{{estu.faltasJus}}</td>
						<td>{{estu.faltasInjus}}</td>
						<td>{{estu.diasAsis}}</td>
						<td>{{estu.comporta}}</td>
						<td>
							<button style="width: 100px;" class="btn btn-outline-warning editar" 
							ng-click="mostrarNotasEditar($event)" 
							id="{{estu.id_p}}" data-toggle="modal" data-target="#modalEditar">
								Editar
							</button>
						</td>
					</tr>
					
					<tr>
					</tr>
				</tbody>
				</table>
				<table>
					<tr ng-show="mensaje">
						<td colspan="12" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="12" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
					<tr ng-show="mensajeIngreso">
						<td colspan="12" >
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
						<h3 class="modal-title" id="modalEditarLabel">Editar las notas del parcial.</h3>
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
								<form name="fParcialEditar" ng-submit="procesoActualizar()" class="form-horizontal">
									
									<input type="hidden" id="idParcialEdit" value="{{idP}}">

									<div class="form-group row">
											<label class="col-3 col-form-label">Deberes:</label>
											<div class="col-4">
												<input class="form-control" name="deberesP" id="deberesP" ng-model="deberesP"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.deberesP.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.deberesP.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

										<div class="form-group row">
											<label class="col-3 col-form-label">Lecciones orales o escritas:</label>
											<div class="col-4">
												<input class="form-control" name="leccionesP" id="leccionesP" ng-model="leccionesP"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.leccionesP.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.leccionesP.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

										<div class="form-group row">
											<label class="col-3 col-form-label">Trabajos grupales:</label>
											<div class="col-4">
												<input class="form-control" name="trabajosP" id="trabajosP" 
												ng-model="trabajosP"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.trabajosP.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.trabajosP.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

										<div class="form-group row">
											<label class="col-3 col-form-label">Trabajos de Investigación:</label>
											<div class="col-4">
												<input class="form-control" name="investigacionP" id="investigacionP" 
												ng-model="investigacionP"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.investigacionP.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.investigacionP.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

										<div class="form-group row">
											<label class="col-3 col-form-label">Evaluación:</label>
											<div class="col-4">
												<input class="form-control" name="evaluacion" id="evaluacion" 
												ng-model="evaluacion"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.evaluacion.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.evaluacion.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

										<div class="form-group row">
											<label class="col-3 col-form-label">Faltas Justificadas:</label>
											<div class="col-4">
												<input class="form-control" name="faltasJus" id="faltasJus" 
												ng-model="faltasJus"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.faltasJus.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.faltasJus.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label">Faltas Injustificadas:</label>
											<div class="col-4">
												<input class="form-control" name="faltasInjus" id="faltasInjus" 
												ng-model="faltasInjus"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.faltasInjus.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.faltasInjus.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label">Horas asistidas:</label>
											<div class="col-4">
												<input class="form-control" name="diasAsis" id="diasAsis" 
												ng-model="diasAsis"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.diasAsis.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.diasAsis.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label">Comportamiento:</label>
											<div class="col-4">
												<input class="form-control" name="comporta" id="comporta" 
												ng-model="comporta"
												type="text" placeholder="00.00" required>
											</div>
											<div class="col-4" style="color: #28B463" 
												ng-show="fParcialEditar.comporta.$valid">
												<strong> Correcto.</strong>
											</div>
											<div class="col-4" style="color: crimson" 
												ng-show="fParcialEditar.comporta.$invalid">
												* Campo Obligatorio.
											</div>
											
										</div>

									<div class="modal-footer">
										<button class="col-3 btn btn-primary" type="submit" 
										ng-disabled="fParcialEditar.$error.required">
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
