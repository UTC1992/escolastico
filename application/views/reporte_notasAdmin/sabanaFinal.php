<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="repoSabanaCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>Curso_Controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>Asignaturas_Controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>Ingresar_Notas_Controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>Curso_Controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>Ingresar_Notas_Controller/insertar">

		<!--MOSTRAR INFORMES DE NOTAS-->
		<input type="hidden" id="urlNotasAnual" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotasFinales">
		
		<!--buscar asignaturas segun id del Curso-->
		<input type="hidden" id="urlAsignaturasCurso" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonAsignaturasDeCurso">
		
		<!--buscar datos de boletin-->
		<input type="hidden" id="urlDatosBoletin" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonDatosBoletin">

		<!--buscar nota de supletorio-->
		<input type="hidden" id="urlNotasSuple" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotaSuple">
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasMejora" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotaMejora">
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasRemedial" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotaRemedial">
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasGracia" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotaGracia">
	<!--urls-->

	<!--url para años lectivos-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>Periodoa_Controller/getDataJsonPeriodoAll">
	<!--url para años lectivos-->
	
	<!--head -->
	<br>
	<div class="container">
		<center><h3>Sábana Final</h3></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
	<div class="container">
		<div class="table-responsive">
			<form ng-submit="mostrarEstudiantesNotas()">
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
				<table class="table table-bordered table-striped table-sm">
					
					<thead class="thead-inverse">
						
						<tr>
							<th colspan="14"><center>ALUMNOS</center></th>
						</tr>
						<tr>
							<td colspan="7"><label style="margin-right: 5px;">
								<strong>Año lectivo:</strong></label><label> {{anioIInfo}} - {{anioFInfo}}</label>
							</td>
							<td colspan="7"><label style="margin-right: 5px;">
								<strong>Curso:</strong></label><label> {{CursoInfo}}</label>
							</td>
						</tr>
						<tr>
							<td colspan="7">
								<label style="margin-right: 5px;">
								<strong>Paralelo:</strong></label><label> {{ParaleloInfo}}</label>
							</td>
							<td colspan="7"></td>
						</tr>
						<tr>
							<th colspan="14"><center>SÁBANA FINAL</center></th>
						</tr>
					</thead>
				</table>
			</form>
		</div>
	</div>
	
	<!--datos consultar
		<button class="btn btn-success" ng-click="exportToExcel('#tableToExport')">
				<span class="glyphicon glyphicon-share"></span>
			Descargar Excel
		</button>
		<br>
		<br>
	-->
		<!--tabla de estudiantes-->
          <div class="table-responsive" id="scroll">
			  <table>
				  <tr ng-show="mensaje">
						<td colspan="5" >
							<center>
								<div  class="alert alert-danger" style="color: crimson;">
									<strong>* No existen estudiantes relacionados con los datos ingresados.</strong>
								</div>
							</center>
						</td>
					</tr>
			  </table>
            <form ng-submit="">
			<div class="container">
			
			<center>
				<img style="height: 100px; width: 100px;" src="<?=base_url()?>disenio/img/cargando.gif" ng-show="cargando">
			</center>
			</div>
				<table class="table table-bordered table-striped table-sm" id="tableToExport" ng-show="tablaMostrar" >
				<tbody>
					
					<tr ng-repeat="e in sabanaFinal | orderBy : apellidos_estu">
						<td style="width: 50px;">{{$index + 1}}</td>
						<td>
							<label style="width: 200px;">
								{{e.apellidos_estu}} {{e.nombres_estu}}
							</label>
						</td>
						<td ng-repeat="notas in e.arrayNotas | orderBy : asignatura">
							<div>
								<table style="font-size: 8pt;">
									
									<thead class="thead-inverse">
										<tr>
											<th colspan="9" >
												<label style="width: 200px;">
													<strong>{{notas.asignatura}}</strong>
												</label>
											</th>
										</tr>
										<tr>
											<th>Q1</th>
											<th>Q2</th>
											<th>PRO</th>
											<th>ME</th>
											<th>SU</th>
											<th>RE</th>
											<th>GR</th>
											<th>PF</th>
											<th>COM</th>
										</tr>
									</thead>
										<tr>
											<td>
												<label>
													{{notas.Q1}}
												</label>
											</td>
											<td>
												<label>
													{{notas.Q2}}
												</label>
											</td>
											<td>
												<label>
													{{notas.promedio1}}
												</label>
											</td>
											<td>
												<label>
													{{notas.mejora}}
												</label>
											</td>
											<td>
												<label>
													{{notas.suple}}
												</label>
											</td>
											<td>
												<label>
													{{notas.remedial}}
												</label>
											</td>
											<td>
												<label>
													{{notas.gracia}}
												</label>
											</td>
											<td>
												<label>
													{{notas.promedioFinal}}
												</label>
											</td>
											<td>
												<label>
													{{notas.comporLetra}}
												</label>
											</td>
										</tr>	
								</table>
								
							</div>
							
							
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

		<style>
			#scroll {
				overflow:scroll;
				height:300px;
				width:100%;
			}

			#scroll table {
				width:100%;
			}
		</style>

		  

</div>
<!--INICIO CONTENEDOR-->

