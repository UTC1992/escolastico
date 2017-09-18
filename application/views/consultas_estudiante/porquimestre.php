<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasEstuCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>Curso_Controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>Asignaturas_Controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>Ingresar_Notas_Controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>Curso_Controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>Ingresar_Notas_Controller/insertar">

		<!--MOSTRAR INFORMES DE NOTAS-->
		<input type="hidden" id="urlNotasQuimestre" value="<?= base_url()?>Reporte_Notasadmin_Controller/getDataJsonNotasQuimestre">
		
		<input type="hidden" id="urlBuscarMatricula" value="<?= base_url()?>Consultar_Notas_Controller/getDataJsonMatricula">
	<!--urls-->

	<!--url para años lectivos-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>Periodoa_Controller/getDataJsonPeriodoAll">
	<!--url para años lectivos-->
	
	<!--head -->
	<br>
	<div class="container">
		<center><h3>Notas Quimestrales</h3></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<div class="table-responsive">
			<form ng-submit="buscarMatriculaQuimestre()">
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
										<option value="">Seleccione</option>
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
            <form ng-submit="">
				<table style="" class="table table-striped table-bordered table-sm" border="1">
					<thead class="thead-inverse">
						<tr style="background: black; color: white;">
							<th></th>
							<th colspan="3"><center>PARCIALES</center></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr style="background: black; color: white;">
							<th>ASIGNATURAS</th>
							<th>PARCIAL 1</th>
							<th>PARCIAL 2</th>
							<th>PARCIAL 3</th>
							<th>EXAMEN</th>
							<th>PROMEDIO</th>
							<th>COMPORTAMIENTO</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="n in notasParcial" >
							<td>{{n.asignatura}}</td>
							<td>{{n.parcial1}}</td>
							<td>{{n.parcial2}}</td>
							<td>{{n.parcial3}}</td>
							<td>{{n.nota_exa}}</td>
							<td>{{n.Promedio}}</td>
							<td><center>{{n.comporLetra}}</center></td>
						</tr>
					</tbody>
				</table>
            </form>
          </div>
		  <!--tabla de estudiantes-->
</div>
<!--INICIO CONTENEDOR-->

