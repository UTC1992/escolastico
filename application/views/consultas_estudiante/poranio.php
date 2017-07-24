<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasEstuCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlBuscarMatricula" value="<?= base_url()?>consultar_notas_controller/getDataJsonMatricula">

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
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasMejora" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotaMejora">
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasRemedial" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotaRemedial">
		<!--buscar nota de mejora-->
		<input type="hidden" id="urlNotasGracia" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotaGracia">
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
			<form ng-submit="buscarMatriculaAnual()">
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
							<td><label>Cédula:</label></td>
							<td>
								<input type="hidden" name="" id="idEstudiante" value="<?= $idEstu ?>">
								<input class="form-control" type="text" style="width: 200px;" 
								name="" value="<?= $cedula ?>" disabled>	
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
		
		<div class="table-responsive">
		  <table class="table table-striped table-bordered table-sm" class="" border="1">
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
						<th>PROMEDIO FIN</th>
						<th>COMPORTAMIENTO</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="n in notasParcial | orderBy : 'asignatura'">
						<td>{{ $index + 1 }}</td>
						<td>{{n.asignatura}}</td>
						<td>{{n.Q1}}</td>
						<td>{{n.Q2}}</td>
						<td>{{n.promedio1}}</td>
						<td>{{n.mejora}}</td>
						<td>{{n.suple}}</td>
						<td>{{n.remedial}}</td>
						<td>{{n.gracia}}</td>
						<td>{{n.promedioFinal}}</td>
						<td><center>{{n.comporLetra}}</center></td>
					</tr>
				</tbody>
			</table>
		</div>


</div>
<!--INICIO CONTENEDOR-->

