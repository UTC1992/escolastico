<style>
    #contenidoEstudiante {
        
    }
</style>
<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" ng-controller="estudianteCtrl">
	
	<!--url para las paginas-->
		<input id="urlBuscarAniosLectivos" type="hidden" value="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoAll">
	<!--url para las paginas-->

	<!-- tabla -->
    <div class="">
		<br>
		<input type="hidden" id="urlEstudiantes" value="<?= base_url()?>estudiante_controller/getDataJsonEstudiantesAllInicial">
		
		<center><h4>Educación General Básica</h4></center>
		
		<div class="col-lg-6">
			<label>Seleccione el año lectivo:</label>
			<form ng-submit="mostrarEstudiantes()">
				<input type="hidden" id="nivelEstudiantes" value="Educacion General Basica">
				<div class="form-inline">
					<select class="form-control" style="margin-right: 5px;" 
					name="aniosL" id="aniosL" ng-model="aniosL" required>
						<option value="">Seleccionar</option>
						<option ng-repeat="a in aniosLectivos" value="{{a.anioinicio_pera}}-{{a.aniofin_pera}}">
						{{a.mesinicio_pera}} {{a.anioinicio_pera}} - {{a.mesfin_pera}} {{a.aniofin_pera}}
						</option>
					</select>
					<button class="btn btn-info nuevo" type="submit">
						Listar
					</button>
				</div>
			</form>
		</div>
		<br>
		<center>
			<button class="btn btn-primary nuevo" ng-click="inicializarInput()" data-toggle="modal" data-target="#modalNuevo">
				Registrar Estudiante
			</button>
		</center>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sm"
			ng-table ="estudiantesTable" show-filter="true">
				<!--
				<thead class="thead-inverse">
					<tr>
						<th>N°</th>
						<th>Cédula</th>
						<th>Apellidos</th>
						<th>Nombres</th>
						<th>Acción</th>
					</tr>
				</thead>
				-->
				<tbody>
					<tr ng-repeat="e in $data">
						<td data-title="'N°'">{{ $index + 1 }}</td>
						<td data-title="'Cédula'"  filter="{cedula_estu: 'text'}">{{e.cedula_estu}}</td>
						<td data-title="'Apellidos'" sortable="'apellidos_estu'" filter="{apellidos_estu: 'text'}">{{e.apellidos_estu}}</td>
						<td data-title="'Nombres'"  filter="{nombres_estu: 'text'}">{{e.nombres_estu}}</td>
						<td data-title="'Acciones'">
							<div style="width: 350px;" class="form-inline">
								<button style="width: 100px; margin-right: 5px;" class="btn btn-outline-info editar" for="inlineFormInput" 
								ng-click="mostrarFormEditar($event)" 
								id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}" 
								name="<?= base_url()?>matricula_controller/getDataJsonCertiImprimir/{{e.id_estu}}/{{e.fechainicio_matr}}/{{e.fechafin_matr}}"
								data-toggle="modal" data-target="#modalMostrarDatos">
									Datos
								</button>
								<button style="width: 100px; margin-right: 5px;" class="btn btn-outline-warning editar" for="inlineFormInput"
								ng-click="mostrarFormEditar($event)" 
								id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}"
								name="<?= base_url()?>matricula_controller/getDataJsonCertiImprimir/{{e.id_estu}}/{{e.fechainicio_matr}}/{{e.fechafin_matr}}"
								data-toggle="modal" data-target="#modalEditar">
									Editar
								</button>
								<button style="margin-right: 5px;" class="btn btn-outline-success" 
									ng-click="generarCerti($event)" for="inlineFormInput" 
									id="{{e.id_estu}}" name="<?= base_url()?>matricula_controller/getDataJsonCertiImprimir/{{e.id_estu}}/{{e.fechainicio_matr}}/{{e.fechafin_matr}}"
									data-toggle="modal" data-target="#modalCertificado">
									Certíficado
								</button>
							</div>
						</td>
					</tr>
				</tbody>
				<tr ng-show="mensajeEstudiantes">
					<td colspan="6" >
						<center>
							<div  class="alert alert-danger" style="color: crimson;">
								<strong>* No existen estudiantes en el año lectivo seleccionado.</strong>
							</div>
						</center>
					</td>
				</tr>
			</table>
		</div>
	<!--fin table-->
	</div>

	<!--INICIO MODAL NUEVO-->
		<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo estudiante.</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					
						<div class="row justify-content-md-center">
								<h4>Ingreso y Matrícula.</h4>
								<div class="col-12">
									
								<form name="fEstudiante" ng-submit="registrarNuevo()" class="form-horizontal" >
									
									<input type="hidden" id="urlInsertarE" value="<?= base_url()?>estudiante_controller/insertar">
									<fieldset class="form-control">
									<legend class="form-control"><strong>Información Personal</strong></legend>
									<div class="form-group row">
										<label class="col-3 col-form-label">Cédula:</label>
										<div class="col-5">
											<input class="form-control" name="cedula" id="cedula" 
											ng-model="cedula"
											type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
										</div>
										<div class="col-4" style="color: #28B463"  
											ng-show="fEstudiante.cedula.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.cedula.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-3 col-form-label">Nombres:</label>
										<div class="col-5">
											<input class="form-control" name="nombres" id="nombres" ng-model="nombres"
											type="text" ng-minlength="5" placeholder="Ingrese los nombres" required>
										</div>
										<div class="col-4" style="color: #28B463"  
											ng-show="fEstudiante.nombres.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.nombres.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Apellidos:</label>
										<div class="col-5">
											<input class="form-control" name="apellidos" id="apellidos" ng-model="apellidos"
											type="text" ng-minlength="5" placeholder="Ingrese los apellidos" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.apellidos.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.apellidos.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Fecha de nacimiento:</label>
										<div class="col-5 form-inline">
											<select class="form-control" name="anioNacimiento" id="anioNacimiento" 
											ng-model="anioNacimiento" required>
												<option value="">Año</option>
												<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
											</select>
											
											<select class="form-control" name="mesNacimiento" id="mesNacimiento" 
											ng-model="mesNacimiento" required>
												<option value="">Mes</option>
												<option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
											</select>
											
											<select class="form-control" name="diaNacimiento" id="diaNacimiento" 
											ng-model="diaNacimiento" required>
												<option value="">Día</option>
												<option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
											</select>
										</div>
										<div class="col-3" style="color: #28B463"  
											ng-show="fEstudiante.diaNacimiento.$valid && 
											fEstudiante.mesNacimiento.$valid && 
											fEstudiante.anioNacimiento.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.diaNacimiento.$invalid && 
											fEstudiante.mesNacimiento.$invalid && 
											fEstudiante.anioNacimiento.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Dirección domiciliaria:</label>
										<div class="col-5">
											<input class="form-control" name="domicilio" 
											id="domicilio" ng-model="domicilio"
											type="text" placeholder="Domicilio" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.domicilio.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.domicilio.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Lugar de nacimiento:</label>
										<div class="col-5">
											<input class="form-control" name="lugarNacimiento" 
											id="lugarNacimiento" ng-model="lugarNacimiento"
											type="text" placeholder="Lugar de nacimiento" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.lugarNacimiento.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.lugarNacimiento.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Representante:</label>
										<div class="col-5">
											<input class="form-control" name="representante" id="representante" 
											ng-model="representante"
											type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.representante.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.representante.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Cédula del Representante:</label>
										<div class="col-5">
											<input class="form-control" name="cedulaRepre" id="cedulaRepre" 
											ng-model="cedulaRepre"
											type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.cedulaRepre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.cedulaRepre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									</fieldset>
									<br>
									<fieldset class="form-control">
									<legend class="form-control"><strong>Información de los padres</strong></legend>
									<div class="form-group row">
										<label class="col-3 col-form-label">Padre:</label>
										<div class="col-5">
											<input class="form-control" name="padre" id="padre" ng-model="padre"
											type="text" ng-minlength="2" placeholder="Apellidos y nombres" required>
										</div>
										<div class="col-4" style="color: #28B463"  
											ng-show="fEstudiante.padre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.padre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Cédula del padre:</label>
										<div class="col-5">
											<input class="form-control" name="cedulaPadre" id="cedulaPadre" 
											ng-model="cedulaPadre"
											type="text"  ng-minlength="2" placeholder="Ingrese la cédula" required>
										</div>
										<div class="col-4" style="color: #28B463"  
											ng-show="fEstudiante.cedulaPadre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.cedulaPadre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Madre:</label>
										<div class="col-5">
											<input class="form-control" name="madre" id="madre" ng-model="madre"
											type="text" ng-minlength="2" placeholder="Apellidos y nombres" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.madre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.madre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Cédula de la madre:</label>
										<div class="col-5">
											<input class="form-control" name="cedulaMadre" id="cedulaMadre" 
											ng-model="cedulaMadre"
											type="text" ng-minlength="2" ng-maxlength="10" placeholder="Ingrese la cédula" required>
										</div>
										<div class="col-4" style="color: #28B463"
											ng-show="fEstudiante.cedulaMadre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.cedulaMadre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Teléfono del representante:</label>
										<div class="col-5">
											<input class="form-control" name="telefonoRepre" 
											id="telefonoRepre" ng-model="telefonoRepre"
											type="text" ng-minlength="6" ng-maxlength="15" placeholder="Teléfono" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.telefonoRepre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.telefonoRepre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Correo electrónico del representante:</label>
										<div class="col-5">
											<input class="form-control" name="correoRepre" 
											id="correoRepre" ng-model="correoRepre"
											type="email" placeholder="Correo Electrónico" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.correoRepre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.correoRepre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									</fieldset>
									<br>
									  <!--obtener los cursos disponibles en el colegio-->
									<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
									
									<input type="hidden" id="urlInsertarM" value="<?= base_url()?>matricula_controller/insertar">
									
									<input type="hidden" id="urlBuscarIdEstu" value="<?= base_url()?>estudiante_controller/getDataJsonBuscarIdEstu">

									<fieldset class="form-control">
									<legend class="form-control"><strong>Información de la Matrícula:</strong></legend>
								

									<div class="form-group row">
										<label class="col-3 col-form-label">Año lectivo, fecha de inicio:</label>
										<div class="col-5 form-inline">
											<select class="form-control" name="anioInicio" id="anioInicio" 
											ng-model="anioInicio" required>
												<option value="">Año</option>
												<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="mesInicio" id="mesInicio" 
											ng-model="mesInicio" required>
												<option value="">Mes</option>
												<option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="diaInicio" id="diaInicio" 
											ng-model="diaInicio" required>
												<option value="">Día</option>
												<option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
											</select>
										</div>
										<div class="col-3" style="color: #28B463"
											ng-show="fEstudiante.anioInicio.$valid && 
											fEstudiante.mesInicio.$valid && 
											fEstudiante.diaInicio.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.anioInicio.$invalid || 
											fEstudiante.mesInicio.$invalid ||
											fEstudiante.diaInicio.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Año lectivo, fecha de finalización:</label>
										<div class="col-5 form-inline">
											<select class="form-control" name="anioFin" id="anioFin" 
											ng-model="anioFin" required>
												<option value="">Año</option>
												<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="mesFin" id="mesFin" 
											ng-model="mesFin" required>
												<option value="">Mes</option>
												<option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="diaFin" id="diaFin" 
											ng-model="diaFin" required>
												<option value="">Día</option>
												<option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
											</select>
										</div>
										<div class="col-3" style="color: #28B463"
											ng-show="fEstudiante.anioFin.$valid && 
											fEstudiante.mesFin.$valid && 
											fEstudiante.diaFin.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.anioFin.$invalid ||
											fEstudiante.mesFin.$invalid ||
											fEstudiante.diaFin.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-3 col-form-label">Nivel:</label>
										<div class="col-5">
											<select class="form-control" name="categoriaNivel" id="categoriaNivel" 
											ng-model="categoriaNivel" required>
												<option value="">Seleccionar</option>
												<option value="Inicial 2">Inicial 2</option>
												<option value="Preparatoria">Preparatoria</option>
												<option value="Educacion General Basica">Educación General Básica</option>
												<option value="Educacion General Superior">Educación General Superior</option>
												
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.categoriaNivel.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudiante.categoriaNivel.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-3 col-form-label">Curso:</label>
										<div class="col-5">
											<select class="form-control" name="cursosID" id="cursosID" 
											ng-model="cursosID" required>
												<option value="">Seleccionar</option>
												<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.cursosID.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson"
											ng-show="fEstudiante.cursosID.$invalid">
										<strong>* Campo obligatorio.</strong>
										</div>
										
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Paralelo:</label>
										<div class="col-5">
											<select class="form-control" name="paralelo" id="paralelo" 
											ng-model="paralelo" required>
												<option value="">Seleccionar</option>
												<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudiante.paralelo.$valid">
										<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson"
											ng-show="fEstudiante.paralelo.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									</fieldset>
									<br>
									<div class="col-12 alert alert-success" 
										ng-show="confirmarMatri">
										* Se registró y matriculó al estudiante correctamente.
									</div>
									
									<div class="modal-footer">
										<button class="col-3 btn btn-primary" type="submit"
										ng-disabled="fEstudiante.$error.required">
											<span class="glyphicon glyphicon-floppy-saved"></span>
											Guardar
										</button>
										<button type="button" class="col-3 btn btn-warning" data-dismiss="modal">
										Cerrar</button>
										
									</div>
								</form>
								</div>
							</div> 
							
					</div>
				
				</div>
			</div>
		</div>
	<!-- FIN MODAL NUEVO-->

	<!--INICIO MODAL EDITAR-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalEditarLabel">Editar datos del estudiante.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fEstudianteEdit" ng-submit="actualizar()" class="form-horizontal" >
                                
                                <input type="hidden" id="urlActualizarE" value="<?= base_url()?>estudiante_controller/actualizar/">
                                <input type="hidden" id="idEstu" value="{{idEstu}}">

                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Personal</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedula" id="cedula" 
                                        ng-model="cedula"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463" 
                                        ng-show="fEstudianteEdit.cedula.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.cedula.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombres:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="nombres" id="nombres" ng-model="nombres"
                                         type="text" ng-minlength="5" placeholder="Ingrese los nombres" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.nombres.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.nombres.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Apellidos:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="apellidos" id="apellidos" ng-model="apellidos"
                                         type="text" ng-minlength="5" placeholder="Ingrese los apellidos" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.apellidos.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.apellidos.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Fecha de nacimiento:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioNacimiento" id="anioNacimiento" 
                                        ng-model="anioNacimiento" required>
                                            <option value="">Año</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="mesNacimiento" id="mesNacimiento" 
                                        ng-model="mesNacimiento" required>
                                            <option value="">Mes</option>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="diaNacimiento" id="diaNacimiento" 
                                        ng-model="diaNacimiento" required>
                                            <option value="">Día</option>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.diaNacimiento.$valid && 
                                        fEstudianteEdit.mesNacimiento.$valid && 
                                        fEstudianteEdit.anioNacimiento.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.diaNacimiento.$invalid || 
                                        fEstudianteEdit.mesNacimiento.$invalid ||
                                        fEstudianteEdit.anioNacimiento.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Dirección domiciliaria:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="domicilio" 
                                        id="domicilio" ng-model="domicilio"
                                         type="text" placeholder="Domicilio" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.domicilio.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.domicilio.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Lugar de nacimiento:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="lugarNacimiento" 
                                        id="lugarNacimiento" ng-model="lugarNacimiento"
                                         type="text" placeholder="Lugar de nacimiento" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.lugarNacimiento.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.lugarNacimiento.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="representante" id="representante" 
                                        ng-model="representante"
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.representante.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.representante.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaRepre" id="cedulaRepre" 
                                        ng-model="cedulaRepre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.cedulaRepre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.cedulaRepre.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información de los padres</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Padre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="padre" id="padre" ng-model="padre"
                                         type="text" ng-minlength="2" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.padre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.padre.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del padre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaPadre" id="cedulaPadre" 
                                        ng-model="cedulaPadre"
                                         type="text"  ng-minlength="2" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.cedulaPadre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.cedulaPadre.$invalid">
                                       <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="madre" id="madre" ng-model="madre"
                                         type="text" ng-minlength="2" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.madre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.madre.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula de la madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaMadre" id="cedulaMadre" 
                                        ng-model="cedulaMadre"
                                         type="text" ng-minlength="2" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.cedulaMadre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.cedulaMadre.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono del representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="telefonoRepre" 
                                        id="telefonoRepre" ng-model="telefonoRepre"
                                         type="text" ng-minlength="6" ng-maxlength="15" placeholder="Teléfono" required>
                                    </div>
                                    <div class="col-3" style="color: #28B463"
                                        ng-show="fEstudianteEdit.telefonoRepre.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudianteEdit.telefonoRepre.$invalid">
                                        <strong>* Campo obligatorio.</strong>
                                    </div>
                                </div>
								<div class="form-group row">
										<label class="col-3 col-form-label">Correo electrónico del representante:</label>
										<div class="col-5">
											<input class="form-control" name="correoRepre" 
											id="correoRepre" ng-model="correoRepre"
											type="email" placeholder="Correo Electrónico" required>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudianteEdit.correoRepre.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudianteEdit.correoRepre.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
                                </fieldset>
								<br>
									  <!--obtener los cursos disponibles en el colegio-->
									 <!--obtener los cursos disponibles en el colegio-->
									<input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
									
									<input type="hidden" id="urlActualizarM" value="<?= base_url()?>matricula_controller/actualizar/">
									
									<input type="hidden" id="idMatri" value="">

									<input type="hidden" id="urlBuscarCertiActualizado" value="<?= base_url()?>matricula_controller/getDataJsonMatriculaActualizada">


									<fieldset class="form-control">
									<legend class="form-control"><strong>Información de la Matrícula:</strong></legend>
								

									<div class="form-group row">
										<label class="col-3 col-form-label">Año lectivo, fecha de inicio:</label>
										<div class="col-5 form-inline">
											<select class="form-control" name="anioInicio" id="anioInicio" 
											ng-model="anioInicio" required>
												<option value="">Año</option>
												<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="mesInicio" id="mesInicio" 
											ng-model="mesInicio" required>
												<option value="">Mes</option>
												<option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="diaInicio" id="diaInicio" 
											ng-model="diaInicio" required>
												<option value="">Día</option>
												<option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
											</select>
										</div>
										<div class="col-3" style="color: #28B463"
											ng-show="fEstudianteEdit.anioInicio.$valid && 
											fEstudianteEdit.mesInicio.$valid && 
											fEstudianteEdit.diaInicio.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudianteEdit.anioInicio.$invalid || 
											fEstudianteEdit.mesInicio.$invalid ||
											fEstudianteEdit.diaInicio.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Año lectivo, fecha de finalización:</label>
										<div class="col-5 form-inline">
											<select class="form-control" name="anioFin" id="anioFin" 
											ng-model="anioFin" required>
												<option value="">Año</option>
												<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="mesFin" id="mesFin" 
											ng-model="mesFin" required>
												<option value="">Mes</option>
												<option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
											</select>
											
											<select style="margin-left: 5px;" class="form-control" name="diaFin" id="diaFin" 
											ng-model="diaFin" required>
												<option value="">Día</option>
												<option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
											</select>
										</div>
										<div class="col-3" style="color: #28B463"
											ng-show="fEstudianteEdit.anioFin.$valid && 
											fEstudianteEdit.mesFin.$valid && 
											fEstudianteEdit.diaFin.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudianteEdit.anioFin.$invalid ||
											fEstudianteEdit.mesFin.$invalid ||
											fEstudianteEdit.diaFin.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-3 col-form-label">Nivel:</label>
										<div class="col-5">
											<select class="form-control" name="categoriaNivel" id="categoriaNivel" 
											ng-model="categoriaNivel" required>
												<option value="Inicial 2">Inicial 2</option>
												<option value="Preparatoria">Preparatoria</option>
												<option value="Educacion General Basica">Educación General Básica</option>
												<option value="Educacion General Superior">Educación General Superior</option>
												
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudianteEdit.categoriaNivel.$valid">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fEstudianteEdit.categoriaNivel.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-3 col-form-label">Curso:</label>
										<div class="col-5">
											<select class="form-control" name="cursosIDEdit" id="cursosIDEdit" required>
												<option value="{{cursoID2}}">{{cursoNombre}}</option>
												<option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="cursosMostrarVerficacion">
											<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson"
											ng-show="fEstudianteEdit.cursosIDEdit.$invalid">
										<strong>* Campo obligatorio.</strong>
										</div>
										
									</div>

									<div class="form-group row">
										<label class="col-3 col-form-label">Paralelo:</label>
										<div class="col-5">
											<select class="form-control" name="paraleloEdit" id="paraleloEdit" 
											ng-model="paraleloEdit" required>
												<option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
											</select>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fEstudianteEdit.paraleloEdit.$valid">
										<strong>* Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson"
											ng-show="fEstudianteEdit.paraleloEdit.$invalid">
											<strong>* Campo obligatorio.</strong>
										</div>
									</div>

									</fieldset>
									<br>
									<div class="col-12 alert alert-success" 
										ng-show="confirmarMatriEdit">
										* Los datos se actualizaron correctamente.
									</div>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fEstudianteEdit.$error.required">
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

	<!--INICIO MODAL MOSTRAR INFORMACION-->
    <div class="modal fade" id="modalMostrarDatos" tabindex="-1" role="dialog" aria-labelledby="modalMostrarDatosLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalMostrarDatosLabel">Información del estudiante.</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<input type="hidden" value="">
					
						<div class="row justify-content-md-center">
							<div class="col-12">

								<form class="form-horizontal" >
										<fieldset class="form-control">
										<legend class="form-control"><strong>Información Personal</strong></legend>
										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Cédula:</label>
											<div class="col-5">
												<label class="col-form-label">{{cedula}}</label>
											</div>
										</div>
										
										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Nombres:</label>
											<div class="col-5">
												<label class="col-form-label">{{nombres}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Apellidos:</label>
											<div class="col-5">
												<label class="col-form-label">{{apellidos}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Fecha de nacimiento:</label>
											<div class="col-5 form-inline">
												<label class="col-form-label">{{anioNacimiento}}-{{mesNacimiento}}-{{diaNacimiento}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Dirección domiciliaria:</label>
											<div class="col-5">
												<label class="col-form-label">{{domicilio}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Lugar de nacimiento:</label>
											<div class="col-5">
												<label class="col-form-label">{{lugarNacimiento}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Representante:</label>
											<div class="col-5">
												<label class="col-form-label">{{representante}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Cédula del Representante:</label>
											<div class="col-5">
												<label class="col-form-label">{{cedulaRepre}}</label>
											</div>
										</div>

										</fieldset>
										<br>
										<fieldset class="form-control">
										<legend class="form-control"><strong>Información de los padres</strong></legend>
										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Padre:</label>
											<div class="col-5">
												<label class="col-form-label">{{padre}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Cédula del padre:</label>
											<div class="col-5">
												<label class="col-form-label">{{cedulaPadre}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Madre:</label>
											<div class="col-5">
												<label class="col-form-label">{{madre}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Cédula de la madre:</label>
											<div class="col-5">
												<label class="col-form-label">{{cedulaMadre}}</label>
											</div>
										</div>

										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Teléfono del representante:</label>
											<div class="col-5">
												<label class="col-form-label">{{telefonoRepre}}</label>
											</div>
										</div>
										<div class="form-group row justify-content-md-center">
											<label class="col-3 col-form-label">Correo electrónico del representante:</label>
											<div class="col-5">
												<label class="col-form-label">{{correoRepre}}</label>
											</div>
										</div>
										</fieldset>
										<br>
										<fieldset class="form-control">
											<legend class="form-control"><strong>Información de la Matrícula</strong></legend>
											<div class="form-group row justify-content-md-center">
												<label class="col-3 col-form-label">Año lectivo, fecha de inicio:</label>
												<div class="col-5">
													<label class="col-form-label">{{anioInicio}}- {{mesInicio}} - {{diaInicio}}</label>
												</div>
											</div>

											<div class="form-group row justify-content-md-center">
												<label class="col-3 col-form-label">Año lectivo, fecha de finalización:</label>
												<div class="col-5 form-inline">
													<label class="col-form-label">{{anioFin}}- {{mesFin}} - {{diaFin}}</label>
												</div>
											</div>
											
											<div class="form-group row justify-content-md-center">
												<label class="col-3 col-form-label">Nivel:</label>
												<div class="col-5">
													<label class="col-form-label">{{categoriaNivel}}</label>
												</div>
											</div>
											
											<div class="form-group row justify-content-md-center">
												<label class="col-3 col-form-label">Curso:</label>
												<div class="col-5">
													<label class="col-form-label">{{cursoNombre}}</label>
												</div>
											</div>

											<div class="form-group row justify-content-md-center">
												<label class="col-3 col-form-label">Paralelo:</label>
												<div class="col-5">
													<label class="col-form-label">{{paraleloEdit}}</label>
												</div>
											</div>

										</fieldset>

										<div class="modal-footer">
											<button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Cerrar</button>
										</div>
								</form>
							
							</div>
						</div>
				</div>
            </div>
        </div>
    </div>
    <!--FIN MODAL MOSTRAR INFORMACION-->

	<!--INICIO MODAL CERTIFICADO-->
    <div class="modal fade" id="modalCertificado" tabindex="-1" role="dialog" aria-labelledby="modalCertificadoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalCertificadoLabel">Certificado de Matrícula.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-lg-center">
                            <div class="col-12">
                                
                            <!--<form name="fMatricula" ng-submit="registrarNuevo()" class="form-horizontal" > -->
                                <!--obtener los cursos disponibles en el colegio-->
                                <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
                                
                                <input type="hidden" id="urlInsertarM" value="<?= base_url()?>matricula_controller/insertar">
                                
                                <input type="hidden" id="idEstu" value="">

                                <fieldset class="form-control" id="printSectionId" style="color: black;">
                                    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                                    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">
                                    <center>
                                        <div class="">
                                            <img class="img-fluid" style="width: 70px; height: 100px;" src="<?= base_url() ?>disenio/img/logo.png">
                                            <h4>UNIDAD EDUCATIVA FISCAL</h4>
                                            <h4>PATRIA</h4>
                                            <br>
                                            <h4>CERTÍFICADO DE MATRÍCULA</h4>
                                            <br>
                                        </div>
                                    </center>
                                    
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;"><strong>MATRÍCULA N°.</strong> {{matriculaNum}}</label>
                                     </div>

                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;"><strong>FOLIO N°.</strong> {{matriculaNum}}</label>
                                     </div>

                                     <div class="row" >
                                        <label class="col-form-label" style="position: absolute; right: 20px;"><strong>AÑO LECTIVO:</strong> {{anioI}} - {{anioF}}</label>
                                     </div>
                                     <br>
                                     <br>
                                     <center>
                                        <div class="row" >
                                            <label style="margin-left: 20px;" class="col-form-label">
                                                LA UNIDAD EDUCATIVA FÍSCAL PATRIA, DE LA CIUDAD DE LATACUNGA, A
                                            </label>
                                        </div>
                                        <div class="" style="width: 600px; border: 1px solid;">
                                            <label>EL ALUMNO: {{estudiante}}</label>
                                        </div>
                                     </center>

                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">PADRE: {{padre}}</label>
                                     </div>
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">MADRE: {{madre}}</label>
                                     </div>
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">FECHA DE NACIMIENTO: {{fechaN}}</label>
                                        <label class="col-form-label" style="margin-left: 20px;">EDAD: {{edadEstu}} AÑOS</label>
                                     </div>
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">DIRECCIÓN: {{direccion}}</label>
                                     </div>
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px; ">
                                            PREVIA LA PRESENTACIÓN EN LA SECRETARÍA DEL PLANTEL DE LA DOCUMENTACIÓN LEGAL RESPECTIVA SE MATRICULA EN:
                                        </label>
                                        <label class="col-form-label" style="margin-left: 20px;">CURSO: {{curso}}</label>
                                        <label class="col-form-label" style="margin-left: 20px;">PARALELO: {{paraleloCerti}}</label>
                                        <label class="col-form-label" style="margin-left: 20px;">CICLO: {{ciclo}}</label>
                                     </div>

                                     <div class="row" >
                                        <label class="col-form-label" style="position: absolute; right: 20px;">{{fechaActual}}</label>
                                     </div>
                                     <br>
                                     <hr style="border-top: 1px solid;">
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">LO CERTIFICO:</label>
                                     </div>
                                     <br>
                                     <center>
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
                                            <tr>
                                                <td>
                                                    <center><label class="col-form-label" style="font-size: 10pt;">LIC. AUGUSTO GUTIERREZ</label></center>
                                                </td>
                                                <td style="width: 50px;"></td>
                                                <td>
                                                    <center><label class="col-form-label" style="font-size: 10pt;">SP. ELIZABETH GUAIÑA</label></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <br>
                                                    <br>
                                                    <hr style="width: 15em; background: black; border-top: 1px solid;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <center><label class="col-form-label" style="font-size: 10pt;">EL REPRESENTANTE</label></center>
                                                </td>
                                            </tr>
                                        </table>
                                     </center>
                                </fieldset>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" ng-click="printToCart('printSectionId')">
                                        <span class="glyphicon glyphicon-floppy-saved"></span>
                                        Imprimir
                                    </button>
                                    <button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Cerrar</button>
                                </div>
                           <!-- </form>-->
                            </div>
                        </div>  
                </div>
            
            </div>
        </div>
    </div>
    <!--FIN MODAL CERTIFICADO-->

</div>
<!--FIN CONTENEDOR-->
