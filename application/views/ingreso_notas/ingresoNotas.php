<style>
    #contenidoEstudiante {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="notasIngresoCtrl">
	
	<!--urls-->
		<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
		<input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
	<!--urls-->
	
	<!--head -->
	<div class="container">
		<center><h4>Ingreso de Calificaciones</h4></center>
	</div>
	<br>
	<!--head -->

	<!--datos consultar-->
		<fieldset class="form-control">
			<legend class="form-control">LLene el siguiente formulario porfavor:</legend>
			<div class="row col-6" style="margin: 5px;">
				<form ng-submit="mostrarEstudiantes()">
					<div class="form-group">
						<label>Curso:</label>
						<select class="form-control" style="margin: 5px;" ng-model="curso" required>
							<option value="">Seleccione</option>
							<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
						</select>
						<label>Paralelo:</label>
						<select class="form-control" style="margin: 5px;" ng-model="paralelo" required>
							<option value="">Seleccione</option>
							<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
						</select>
						<label>Año lectivo:</label>
						<div class="form-inline">
							<select class="form-control" style="margin: 5px;" ng-model="anioI" required>
								<option value="">Inicio</option>
								<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
							</select>
							<select class="form-control" style="margin: 5px;" ng-model="anioF" required>
								<option value="">Fin</option>
								<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
							</select>
						</div>
						<label>Materia:</label>
						<select class="form-control" style="margin: 5px;" ng-model="materia" required>
							<option value="">Seleccione</option>
							<option ng-repeat="a in asignatura" value="{{a.nombre_asig}}">{{a.nombre_asig}}</option>
						</select>
					</div>
					<div class="form-group" >
						<a href="#estudiantes">
							<button type="button" class="btn btn-outline-warning">Siguiente</button>
						</a>
					</div>
				</form>
			</div>
		</fieldset>
		<!--datos consultar-->

		<!--datos del curso a ingresar notas-->
		<br>
		<div class="row col-6" id="estudiantes">
			<fieldset  class="form-control">
				<legend class="form-control">Se ingresaran las notas a los estudiantes matriculados con los siguientes datos:</legend>
					<div class="form-group">
						<label>Curso:</label><label>..............</label><br>
						<label>Paralelo:</label><label>...........</label><br>
						<label>Año lectivo:</label><label>...............</label><br>
						<label>Materia:</label><label>........</label><br>
					</div>
			</fieldset>
		</div>
		<!--datos del curso a ingresar notas-->

		<!--tabla de estudiantes-->
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
              </tbody>
            </table>
          </div>
		  <!--tabla de estudiantes-->

</div>
<!--INICIO CONTENEDOR-->
