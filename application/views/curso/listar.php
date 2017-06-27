<style>
    #contenidoAsig {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoAsig" class="container" ng-controller="cursoCtrl">
    
    <div >	
        <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
        
		<center>
			<button class="btn btn-primary nuevo" ng-click="limpiarVariables()" data-toggle="modal" data-target="#modalNuevo">
				Registrar Curso
			</button>
		</center>
		<h3>Lista de Cursos</h3>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-striped table-sm"
			ng-table ="cursosTable" show-filter="true">
                <!--
				<thead class="thead-inverse">
					<tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
				-->
                <tbody>
                    <tr ng-repeat="c in $data">
                        <td data-title="'N°'" >{{ $index +1 }}</td>
                        <td data-title="'Cursos'" filter="{nombre_curs: 'text'}">{{ c.nombre_curs }}</td>
                        <td data-title="'Acciones'" style="width: 500px;">
                            <div>
								<center>
                                <button class="btn btn-outline-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>curso_controller/getDataJsonCursoId/{{c.id_curs}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>
								
                                <button class="btn btn-outline-info editar" ng-click="obtenerIdCursoAsig($event)" 
                                id="{{c.id_curs}}" name="{{c.nombre_curs}}" 
                                data-toggle="modal" data-target="#modalShowAsig">
                                    Mostrar asignaturas
                                </button>
								</center>
								<!--
                                <button class="btn btn-outline-primary nuevaAsig" ng-click="obtenerIdCurso($event)" 
                                id="{{c.id_curs}}" name="{{c.nombre_curs}}"
                                data-toggle="modal" data-target="#modalNewAsig">
                                    Añadir asignatura
                                </button>
								
								<a id="periodo{{p.id_pera}}" ng-mousemove="myFunc($event)" class="btn btn-danger" href="<?= base_url() ?>admin_/periodoacademico/eliminar/{{p.id_pera}}">
                                    Eliminar
                                </a>
                                -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
	<br>
     <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo curso.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fCurso" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <div class="col-12 alert alert-success" ng-show="mensajeInsertC">
                                    El curso se ingresó correctamente.
                                </div>

                                <input type="hidden" id="urlInsertarC" value="<?= base_url()?>curso_controller/insertar">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombre del Curso:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="nombreC" id="nombreC" ng-model="nombreC"
                                         type="text" ng-minlength="5" placeholder="Curso" required>
                                    </div>
                                    <div class="col-4" style="color: #28B463"
                                        ng-show="fCurso.nombreC.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fCurso.nombreC.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                    
                                </div>

								<!--
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de paralelos:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="numParalelos" id="numParalelos" ng-model="numParalelos"
                                         type="text" placeholder="Número de paralelos" required>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fCurso.numParalelos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fCurso.numParalelos.$invalid">
                                        * Debe ingresar el numero de paralelos que tiene el curso.
                                    </div>
                                    
                                </div>
								-->
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fCurso.nombreC.$invalid && fCurso.numParalelos.$invalid">
                                        <span class="glyphicon glyphicon-floppy-saved"></span>
                                        Guardar
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
    <!--FIN MODAL NUEVO-->
   
   <!--INICIO MODAL EDITAR-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalEditarLabel">Editar el curso seleccionado.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fCursoEditar" ng-submit="actualizar()" class="form-horizontal">
                            <input type="hidden" id="urlActualizarC" value="<?= base_url()?>curso_controller/actualizar/">
                            <input type="hidden" id="idCurso" value="{{idCurso}}">
							<div class="col-12 alert alert-success" ng-show="actualizarMensaje">
								El curso se actualizó correctamente.
							</div>

                            <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombre del Curso:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="nombreEditC" id="nombreEditC" ng-model="nombreEditC"
                                         type="text" ng-minlength="5" placeholder="Curso" required>
                                    </div>
                                    <div class="col-4" style="color: #28B463"
                                        ng-show="fCursoEditar.nombreEditC.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fCursoEditar.nombreEditC.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                    
                                </div>
								<!--
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de paralelos:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="paralelosEditC" id="paralelosEditC" 
                                        ng-model="paralelosEditC"
                                         type="text" placeholder="Número de paralelos" required>
                                    </div>
                                    <div class="col-4" style="color: #28B463"
                                        ng-show="fCursoEditar.paralelosEditC.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fCursoEditar.paralelosEditC.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                    
                                </div>
								-->
                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" 
                                ng-disabled="fCursoEditar.nombreEditC.$invalid && fCursoEditar.paralelosEditC.$invalid">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                    Guardar
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

    <!--INICIO MODAL NUEVA ASIGNATURA-CURSO-->
    <div class="modal fade" id="modalNewAsig" tabindex="-1" role="dialog" aria-labelledby="modalNewAsigLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalNewAsigLabel">Añadir una nueva asignatura en: {{nombreCurso}}.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-11">
                        <label>Elija una nueva asignatura para éste curso:</label>
                        <form name="fAsigCurso" ng-submit="nuevaAsigCurso()" class="form-horizontal">
                            
                            <!--URL consulta de asignaturas-->
                            <input type="hidden" id="urlNewAsigCurso" value="<?= base_url() ?>asignaturas_controller/getDataJsonAsignaturaAll">
                            
                            <!--ID para registro de nueva asignatura en un curso
                            <input type="hidden" id="idCursoNewA" value="{{idCursoNewA}}">-->

                            <!--URL insertar-->
                            <input type="hidden" id="urlInsertarAsigCurso" value="<?= base_url() ?>curso_asignatura_controller/insertar">
                            
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Asignaturas:</label>
                                <div class="col-5">
                                    <select class="form-control" id="idAsig" name="idAsig" ng-model="idAsig" required>
                                        <option value="">Seleccionar</option>
                                        <option ng-repeat="a in asignaturas" value="{{a.id_asig}}">{{a.nombre_asig}}</option>
                                    </select>
                                </div>
                                <div class="col-4 alert alert-success" 
                                    ng-show="fAsigCurso.idAsig.$valid">
                                    Correcto.
                                </div>
                                <div class="col-4 alert alert-danger" 
                                    ng-show="fAsigCurso.idAsig.$invalid">
                                    * Debe seleccionar una asignatura.
                                </div>
                                
                            </div>

                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" 
                                ng-disabled="fAsigCurso.$error.required">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                    Añadir
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
    <!--FIN MODAL NUEVA ASIGNATURA-CURSO-->

    <!--INICIO MODAL Mostrar asignaturas de curso-->
    <div class="modal fade" id="modalShowAsig" tabindex="-1" role="dialog" aria-labelledby="modalShowAsigLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalShowAsigLabel">Curso: {{nombreCurso}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-11">
						<label>Elija una nueva asignatura para éste curso:</label>
                        <form name="fAsigCurso" ng-submit="nuevaAsigCurso()" class="form-horizontal">
                            
                            <!--URL consulta de asignaturas-->
                            <input type="hidden" id="urlNewAsigCurso" value="<?= base_url() ?>asignaturas_controller/getDataJsonAsignaturaAll">
                            
                            <!--ID para registro de nueva asignatura en un curso-->
                            <input type="hidden" id="idCursoNewA" value="{{idCursoNewA}}">

                            <!--URL insertar-->
                            <input type="hidden" id="urlInsertarAsigCurso" value="<?= base_url() ?>curso_asignatura_controller/insertar">
                            
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Asignaturas:</label>
                                <div class="col-5">
                                    <select class="form-control" id="idAsig" name="idAsig" 
									ng-model="idAsig" required>
                                        <option value="">Seleccionar</option>
                                        <option ng-repeat="a in asignaturas" value="{{a.id_asig}}">{{a.nombre_asig}}</option>
                                    </select>
                                </div>
                                <button class="col-3 btn btn-primary" type="submit">
									<span class="glyphicon glyphicon-floppy-saved"></span>
									Añadir
								</button>
                            </div>

							
                        </form>
                        <label></label>
                            
                            <!--URL consulta de asignaturas-->
                            <input type="hidden" id="urlAsigCurso" value="<?= base_url() ?>curso_asignatura_controller/getDataJsonAsigCurso">
                            
                            <div class="form-group row">
                                    <div class="table-responsive">
                                            <table class="table table-bordered table-condensed table-striped table-sm">
                                                <thead>
													<tr class="thead-inverse">
														<th colspan="3"><strong>Lista de Asignaturas:</strong></th>
													</tr>
												</thead>
												<tbody>
                                                    <tr ng-repeat="a in asignaturasCurso">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ a.nombre_asig }}</td>
                                                        <td>
                                                            <div>
                                                                <center>
																	<button class="btn btn-outline-danger eliminar" 
																	ng-click="eliminarAsignaturaDeCurso($event)" 
																	id="<?= base_url() ?>curso_asignatura_controller/eliminar/{{a.id_cura}}">
																		Eliminar
																	</button>
																</center>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    
                                </div>

                            <div class="modal-footer">
                                <!--
								<button class="col-3 btn btn-primary" type="submit" 
                                ng-disabled="fAsigCurso.asignaturaCurso.$invalid">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                    Registrar
                                </button>
                                -->
								<button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
            </div>
            
            </div>
        </div>
    </div>
    <!--FIN MODAL Mostrar asignaturas de curso-->

</div>
<!--FIN CONTENEDOR-->
