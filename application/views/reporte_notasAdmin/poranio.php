<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="repoNotasAdminCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>ingresar_notas_controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>curso_controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>ingresar_notas_controller/insertar">

		<!--MOSTRAR INFORMES DE NOTAS-->
		<input type="hidden" id="urlNotasAnual" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasFinales">
		
		<!--buscar asignaturas segun id del Curso-->
		<input type="hidden" id="urlAsignaturasCurso" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonAsignaturasDeCurso">
		
		<!--buscar datos de boletin-->
		<input type="hidden" id="urlDatosBoletin" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonDatosBoletin">

		<!--buscar nota de supletorio-->
		<input type="hidden" id="urlNotasSuple" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotaSuple">
	<!--urls-->

	<!--url para años lectivos-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoAll">
	<!--url para años lectivos-->
	
	<!--head -->
	<br>
	<div class="container">
		<center><h3>Notas Finales</h3></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<div class="table-responsive">
			<form ng-submit="mostrarEstudiantesNotas()">
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
							<td>
								<div class="form-inline">
									<select class="form-control" style="margin-right: 5px;" 
									name="aniosL" id="aniosL" ng-model="aniosL" required>
										<option value="">Seleccionar</option>
										<option ng-repeat="a in aniosLectivos" value="{{a.anioinicio_pera}}-{{a.aniofin_pera}}">
										{{a.mesinicio_pera}} {{a.anioinicio_pera}} - {{a.mesfin_pera}} {{a.aniofin_pera}}
										</option>
									</select>
								</div>
							</td>
							
							<td><label>Curso:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="cursoId" required>
									<option value="">Seleccione</option>
									<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Paralelo:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="paralelo" required>
									<option value="">Seleccione</option>
									<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
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
						<td colspan="5" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
					<th colspan="5"><center>ALUMNOS</center></th>
					</tr>
					<tr>
						<td colspan="2"><label style="margin-right: 5px;">
							<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
						</td>
						<td><label style="margin-right: 5px;">
							<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
						</td>
						
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">
							<label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
						<td></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<th>N°</th>
						<th>Cédula</th>
						<th colspan="2">Estudiante</th>
						<th>Mostrar Notas</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="e in estudiantesMatriculados | orderBy : apellidos_estu">
						<td style="width: 50px;">{{$index + 1}}</td>
						<td>{{e.cedula_estu}}</td>
						<td colspan="2">
							<label style="width: 400px;">
								{{e.apellidos_estu}} {{e.nombres_estu}}
							</label>
						</td>
						
						<td>
							<button  class="btn btn-outline-warning editar" 
							ng-click="verificarNotasFinales($event)" 
							id="{{e.id_curs}}/{{e.id_estu}}" data-toggle="modal" data-target="#modalEditar">
								Mostrar Notas
							</button>
						</td>
					</tr>
					<tr ng-show="mensaje">
						<td colspan="5" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="5" >
							<center>
								<img ng-if="mostrarCargando" src="<?= base_url()?>disenio/img/cargando.gif">
							</center>
						</td>
					</tr>
				</tbody>
				</table>
            </form>
          </div>
		  <!--tabla de estudiantes-->

		  <!--INICIO MODAL EDITAR-->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="modalEditarLabel">Notas Finales</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<input type="hidden" value="">
							<div class="">
								<div class="col-12 row justify-content-lg-center">
								<fieldset class="form-control" id="printSectionId"
									 style="color: black; font-size: 10pt;">
										
										<link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                                    	<link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">
										<center>
											<div class="">
												<img class="img-fluid" style="width: 70px; height: 100px;" src="<?= base_url() ?>disenio/img/logo.png">
												<h4>UNIDAD EDUCATIVA FICAL</h4>
												<h4>PATRIA</h4>
												<br>
												<h4>LIBRETA DE CALIFICACIONES FINAL</h4>
												<br>
											</div>
										</center>
										<center>
										<table border="1" style=" font-size: 10pt; width: 700px;">
											<tbody>
												<tr>
													<td>CADETE: {{cadete}}</td>
													<td>CÉDULA: {{cedula}}</td>
												</tr>
												<tr>
													<td>CURSO Y PARALELO: {{cursoParalelo}}</td>
													<td>AÑO LECTIVO: {{anioLectivo}}</td>
												</tr>
												<tr>
													<td>ESPECIALIDAD: {{especialidad}}</td>
													<td>NIVEL / SECCIÓN: {{nivel}}</td>
												</tr>
												<tr>
													<td>FECHA DE EMISIÓN: {{fechaActual}}</td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<br>
									<table style="font-size: 8pt; width: 500px;" class="" border="1">
										<thead class="thead-inverse">
											<tr>
												<th>N°</th>
												<th>ASIGNATURAS</th>
												<th>I QUIM</th>
												<th>II QUIM</th>
												<th>PROM</th>
												<th>MEJORA</th>
												<th>SUPLE</th>
												<th>REMEDIAL</th>
												<th>GRACIA</th>
												<th>PROM FIN</th>
												<th>EQUIVALENCIA</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="n in notasParcial track by $index">
												<td>{{ $index + 1 }}</td>
												<td>{{n.asignatura}}</td>
												<td>{{n.Q1}}</td>
												<td>{{n.Q2}}</td>
												<td>{{n.promedioF}}</td>
												<td>{{mejora}}</td>
												<td>{{suple}}</td>
												<td>{{remedial}}</td>
												<td>{{gracia}}</td>
												<td>{{promedioFinal}}</td>
												<td>{{equivalencia}}</td>
											</tr>
										</tbody>
									</table>
									<br>
										</center>
										<label>OBSERVACIONES:</label>
										<center>
											<textarea class="form-control"></textarea>
										<br>
										<br>
										<br>
										<table>
											<tr>
                                                <td><hr style="width: 15em; background: black; border-top: 1px solid;"></td>
                                                <td style="width: 50px;"></td>
                                                <td><hr style="width: 15em; background: black; border-top: 1px solid;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <center><label class="col-form-label" style="font-size: 10pt;">EL RECTOR</label></center>
                                                </td>
                                                <td style="width: 50px;"></td>
                                                <td>
                                                    <center><label class="col-form-label" style="font-size: 10pt;">EL SECRETARIO GENERAL</label></center>
                                                </td>
                                            </tr>
										</table>
										</center>
									</fieldset>
								</div>
								<br>
								<div class="modal-footer">
									<button class="col-3 btn btn-primary" ng-click="printToCart('printSectionId')">
                                        <span class="glyphicon glyphicon-floppy-saved"></span>
                                        Imprimir
                                    </button>
									<button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
					</div>
					
					</div>
				</div>
			</div>
			<!--FIN MODAL EDITAR-->


</div>
<!--INICIO CONTENEDOR-->

