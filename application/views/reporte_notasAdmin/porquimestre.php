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
		<input type="hidden" id="urlNotasQuimestre1" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasQuimestre1">
		<input type="hidden" id="urlNotasQuimestre2" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasQuimestre2">
		
	<!--urls-->
	
	<!--head -->
	<br>
	<div class="container">
		<center><h3>Notas Quimestrales</h3></center>
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
							
							<td><label>Curso:</label></td>
							<td>
								<select class="form-control" style="width: 200px;" ng-model="cursoId" required>
									<option value="">Seleccione</option>
									<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
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
							<strong>Quimestre:</strong></label><label> {{QuimestreInfo}}</label>
						</td>
						<td><label style="margin-right: 5px;">
							<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
						</td>
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
							ng-click="verificarQuimestre($event)" 
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
						<h3 class="modal-title" id="modalEditarLabel">Notas parciales</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<input type="hidden" value="">
							<div class="">
								<div class="col-12 row justify-content-lg-center">
									<table style="font-size: 8pt; width: 500px;" class="" border="1">
										<thead class="thead-inverse">
											<tr>
												<th></th>
												<th colspan="4"><center>Parámetros</center></th>
											</tr>
											<tr>
												<th>Asignaturas</th>
												<th>Parcial 1</th>
												<th>Parcial 2</th>
												<th>Parcial 3</th>
												<th>Examen</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="n in notasParcial">
												<td>{{n.asignatura}}</td>
												<td>{{n.parcial1}}</td>
												<td>{{n.parcial2}}</td>
												<td>{{n.parcial3}}</td>
												<td>{{n.nota_exa}}</td>
											</tr>
										</tbody>
										<tr ng-show="mensajeNotas">
											<td colspan="6" >
												<center>
													<div  class="alert alert-danger" style="color: crimson;">
														<strong>* No existen notas registradas por el momento.</strong>
													</div>
												</center>
											</td>
										</tr>
									</table>
								</div>
								<br>
								<div class="modal-footer">
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

