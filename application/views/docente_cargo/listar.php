<style>
    #contenidoDocente {
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoDocente" class="container" ng-controller="docenteCargoCtrl">
    
    <div >	
        <input type="hidden" id="urlDocentesCargo" value="<?= base_url()?>docente_cargo_controller/getDataJsonDocenteCargoAll">
        <input type="hidden" id="urlDocentesCargoConsultaSQL" value="<?= base_url()?>docente_cargo_controller/getDataJsonDocenteCargo">

		<center>
		<button class="btn btn-primary nuevo" ng-click="inicializarVariables()" data-toggle="modal" data-target="#modalNuevo">
            Registrar docente y cargo
		</button>
		</center>
		<h3>Cargos y Docentes:</h3>
		<br>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-striped table-sm"
			ng-table="docenteCargoTable" show-filter="true">
                <!--<thead>
                    <tr>
                        <th>N°</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Nivel</th>
                        <th>Curso</th>
                        <th>Paralelo</th>
                        <th>Materia</th>
                        <th>Periodo Académico</th>
                        <th>Profesor de Grado</th>
                        <th>Acciones</th>
                    </tr>
					
                </thead> -->
                <tbody>
                    <tr ng-repeat="dc in $data">
                        <td data-title="'N°'">{{ $index + 1 }}</td>
                        <!--<td data-title="'Cédula'">{{dc.cedula_doce}}</td>-->
                        <td data-title="'Docente'" sortable="'apellidos_doce'" filter="{apellidos_doce: 'text'}">{{dc.apellidos_doce}} {{dc.nombres_doce}}</td>
                        <td data-title="'Nivel'" filter="{categoria_nivel_cargo: 'text'}">{{dc.categoria_nivel_cargo}}</td>
                        <td data-title="'Curso'" filter="{nombre_curs: 'text'}">{{dc.nombre_curs}}</td>
                        <td data-title="'Paralelo'" filter="{paralelo_cargo: 'text'}">{{dc.paralelo_cargo}}</td>
                        <td data-title="'Asignatura'" filter="{nombre_asig: 'text'}">{{dc.nombre_asig}}</td>
                        <td data-title="'Año lectivo'" filter="{periodo_academico_cargo: 'text'}">{{dc.periodo_academico_cargo}}</td>
                        <td data-title="'Curso Completo'" filter="{curso_completo_cargo: 'text'}">{{dc.curso_completo_cargo}}</td>
                        <td data-title="'Acciones'">
                            <div>
                                <button class="btn btn-outline-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>docente_cargo_controller/getDataJsonDocenteCargoId/{{dc.id_cargo}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>

                                <!--<a id="periodo{{p.id_pera}}" ng-mousemove="myFunc($event)" class="btn btn-danger" href="<?= base_url() ?>admin_/periodoacademico/eliminar/{{p.id_pera}}">
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


   <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo cargo.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
								<div class="col-12 alert alert-success" 
									ng-show="registroExitoso">
									* Se registró el nuevo cargo exitosamente.
								</div>
                            <form name="fDocenteCargo" ng-submit="registrarNuevo()" class="form-horizontal" >
                                <input type="hidden" id="urlDocentes" value="<?= base_url()?>docente_controller/getDataJsonDocenteAll">
                                <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
                                <input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
                                <input type="hidden" id="urlPeriodos" value="<?= base_url()?>periodoa_controller/getDataJsonPeriodoAll">

                                <input type="hidden" id="urlInsertarDC" value="<?= base_url()?>docente_cargo_controller/insertar">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Docente:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="docenteID" id="docenteID" 
                                        ng-model="docenteID" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="d in docentes" value="{{d.id_doce}}">{{d.nombres_doce}} {{d.apellidos_doce}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463"
                                        ng-show="fDocenteCargo.docenteID.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.docenteID.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nivel:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="categoriaNivel" id="categoriaNivel" 
                                        ng-model="categoriaNivel" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Inicial">Inicial</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Educacion General Basica">Educación General Básica</option>
                                            <option value="Educacion General Superior">Educación General Superior</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fDocenteCargo.categoriaNivel.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocenteCargo.categoriaNivel.$invalid">
                                        * Campo obligatorio.
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
                                        ng-show="fDocenteCargo.cursosID.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.cursosID.$invalid">
                                       * Campo obligatorio.
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
                                        ng-show="fDocenteCargo.paralelo.$valid">
                                       <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.paralelo.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Asignatura:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="asignaturaID" id="asignaturaID" 
                                        ng-model="asignaturaID" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="a in asignatura" value="{{a.id_asig}}">{{a.nombre_asig}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fDocenteCargo.asignaturaID.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.asignaturaID.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Se le asigna curso compleo:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="cursoCompleto" id="cursoCompleto" 
                                        ng-model="cursoCompleto" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fDocenteCargo.cursoCompleto.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.cursoCompleto.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Año Lectivo:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="periodoA" id="periodoA" 
                                        ng-model="periodoA" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="p in periodos" 
                                            value="{{p.anioinicio_pera}}-{{p.aniofin_pera}}/{{p.mesinicio_pera}}-{{p.anioinicio_pera}}-{{p.mesfin_pera}}-{{p.aniofin_pera}}">
                                            {{p.mesinicio_pera}}-{{p.anioinicio_pera}}-{{p.mesfin_pera}}-{{p.aniofin_pera}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fDocenteCargo.periodoA.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fDocenteCargo.periodoA.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fDocenteCargo.$error.required">
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
                <h3 class="modal-title" id="modalEditarLabel">Editar la información.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">
							<div class="col-12 alert alert-success" 
								ng-show="edicionExitosa">
								* Los datos se actualizarón exitosamente.
							</div>
                        <form name="fDocenteCargoEdit" ng-submit="actualizarDocenteCardo()" class="form-horizontal" >
                                
                                <input type="hidden" id="urlDocentes" value="<?= base_url()?>docente_controller/getDataJsonDocenteAll">
                                <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
                                <input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">

                                <input type="hidden" id="urlActualizarDC" value="<?= base_url()?>docente_cargo_controller/actualizar/">
                                <input type="hidden" id="idDC" value="{{idDC}}">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Docente:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="idDocente" id="idDocente" required>
                                            <option value="{{datosDocenteEdit[0]['id']}}">{{datosDocenteEdit[0]['nombre']}}</option>
                                            <option ng-repeat="d in docentes" value="{{d.id_doce}}">{{d.nombres_doce}} {{d.apellidos_doce}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Año a cargo:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="categoriaNivelEdit" id="categoriaNivelEdit" 
                                        ng-model="categoriaNivelEdit" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Inicial">Inicial</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Educacion General Basica">Educación General Básica</option>
                                            <option value="Educacion General Superior">Educación General Superior</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Curso:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="idCursoCargo" id="idCursoCargo" required>
                                            <option value="{{datosCursoEdit[0]['id']}}">{{datosCursoEdit[0]['nombre']}}</option>
                                            <option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Paralelo:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="paraleloCargoEdit" id="paraleloCargoEdit" 
                                        ng-model="paraleloCargoEdit" required>
                                            <option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Asignatura:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="idAsignatura" id="idAsignatura" required>
                                            <option value="{{datosaAsignaturaEdit[0]['id']}}">{{datosaAsignaturaEdit[0]['nombre']}}</option>
                                            <option ng-repeat="a in asignatura" value="{{a.id_asig}}">{{a.nombre_asig}}</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Se le asigna curso compleo:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="cursoCompletoEdit" id="cursoCompletoEdit" 
                                        ng-model="cursoCompletoEdit" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Año Lectivo:</label>
                                    <div class="col-7">
                                        <select class="form-control" name="periodoAcademicoEdit" id="periodoAcademicoEdit" 
                                        ng-model="periodoAcademicoEdit" required>
                                            <option value="{{periodoAcademicoEdit}}">{{periodoAcademicoEdit}}</option>
                                            <option ng-repeat="p in periodos" 
                                            value="{{p.mesinicio_pera}}-{{p.anioinicio_pera}}-{{p.mesfin_pera}}-{{p.aniofin_pera}}">
                                            {{p.mesinicio_pera}}-{{p.anioinicio_pera}}-{{p.mesfin_pera}}-{{p.aniofin_pera}}</option>
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit">
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
<!--FIN CONTENEDOR-->
<script>
    
    $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });
    
    $('#modalNuevo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });

    
</script>

