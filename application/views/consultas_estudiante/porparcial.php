<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasEstuCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
		<input type="hidden" id="urlEstudiantesMatriculados" value="<?= base_url()?>ingresar_notas_controller/getDataJsonEstudiantesMatriculados">
		<input type="hidden" id="urlConsultarCurso" value="<?= base_url() ?>curso_controller/getDataJsonCursoId/">
		<input type="hidden" id="urlIngresarNotasParcial" value="<?= base_url() ?>ingresar_notas_controller/insertar">

		<!--MOSTRAR INFORMES DE NOTAS-->
		<input type="hidden" id="urlNotasParcial1" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasParcial1">
		<input type="hidden" id="urlNotasParcial2" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasParcial2">
		<input type="hidden" id="urlNotasParcial3" value="<?= base_url()?>reporte_notasadmin_controller/getDataJsonNotasParcial3">
		
	<!--urls-->
	
	<!--head -->
	<br>
	<div class="container">
		<center><h3>Notas parciales</h3></center>
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
							
							<td><label>Cédula:</label></td>
							<td>
								<input class="form-control" ng-model="cedulaEstu" type="text" style="width: 200px;" name="" value="<?= $cedula?>" disabled>	
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
		
		<!--tabla de estudiantes-->
          <div class="table-responsive">
            <form ng-submit="">
				<table style="" class="table table-striped table-bordered table-sm" border="1">
					<thead class="thead-inverse">
						<tr>
							<th></th>
							<th colspan="4"><center>Parámetros</center></th>
							<th></th>
						</tr>
						<tr>
							<th>Asignaturas</th>
							<th>Deberes</th>
							<th>Lecciones orales o escritas</th>
							<th>Trabajos grupales</th>
							<th>Trabajos de investigación</th>
							<th>Promedio</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="n in notasParcial">
							<td>{{n.asignatura}}</td>
							<td>{{n.p1}}</td>
							<td>{{n.p2}}</td>
							<td>{{n.p3}}</td>
							<td>{{n.p4}}</td>
							<td>{{n.Promedio}}</td>
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
            </form>
          </div>
		  <!--tabla de estudiantes-->
</div>
<!--INICIO CONTENEDOR-->

