<style>
    #contenidoEstu{
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoEstu" class="container" ng-controller="matriculaCtrl">

    <!-- Nav tabs -->
    <div class="">	
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" style="margin-right: 5px;">
                <a class="nav-link" data-toggle="tab" href="#matricula" role="tab">Matrícula</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#certificado" role="tab">Certíficado</a>
            </li>
        </ul>
    </div>
    <!-- Nav tabs fin -->
    <br>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="matricula" role="tabpanel">
        
        <!--inicio de tabla-->
        <div class="row justify-content-md-center">
                <h4>Registrar matrícula</h4>
        </div>

        <div class="row justify-content-md-center">
            
        <input type="hidden" id="urlBuscarEstu" value="<?= base_url()?>matricula_controller/getDataJsonEstudiante"> 
            <div class="col-lg-6">
                <label class="col-form-label">Ingrese los siguientes datos para buscar al Sr/Srta. estudiante y realizar la matrícula:</label>
                <div class="input-group">
                    <button class="btn btn-info nuevo" ng-click="buscarEstudiante()">
                        Bucar
                    </button>
                    <input class="form-control" ng-model="cedulaEstu" type="text" name="" value=""
                    placeholder="Ingrese la cédula del estudiante porfavor">
                </div>
                <div class="" style="color: crimson;" 
                    ng-show="validarBuscar">
                    <strong>* Debe ingresar los 10 digitos de la cédula.</strong>
                </div>
            </div>
            
        </div>
        
        <div class="">
            
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-sm">
                    <thead class="thead-inverse">
                        <tr>
                            <th>N°</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="e in datos | filter:buscar">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ e.cedula_estu }}</td>
                            <td>{{ e.apellidos_estu }} {{ e.nombres_estu }}</td>

                            <td>
                                <div style="width: 200px;">
                                    <button class="btn btn-outline-info" ng-click="enviarId($event)" 
                                    id="{{e.id_estu}}" 
                                    data-toggle="modal" data-target="#modalNuevo">
                                        Matrícula
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" ng-show="busqueda">
                                <div  class="alert alert-danger" style="color: crimson;">
                                    <center>
										<strong>* No existen estudiantes relacionados con la cédula ingresada.</strong>
									</center>
								</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
        <!--final de tabla-->

        </div>
        <div class="tab-pane" id="certificado" role="tabpanel">
            
            <!--inicio de tabla-->
            <div class="row justify-content-md-center">
                    <h4>Consultar una matrícula y generar el respectivo certíficado</h4>
            </div>
            <div class="row justify-content-md-center">	
            <input type="hidden" id="urlBuscarCerti" value="<?= base_url()?>matricula_controller/getDataJsonCertificado"> 
                <div class="col-lg-6">
                    <label class="col-form-label">Ingrese los siguientes datos para mostrar el registro del matrícula del estudiante:</label>
                    <div class="input-group">
                        <input class="form-control" ng-model="cedulaCerti" type="text" name="cedulaCerti" value=""
                        placeholder="Ingrese la cédula del estudiante porfavor">
                    </div>
                    <div class="" style="color: crimson;" 
                        ng-show="validarBuscarCedula">
                        <strong>* Debe ingresar los 10 digitos de la cédula.</strong>
                    </div>
                    <label>Seleccione el año lectivo:</label>
                     <div class="form-inline">
                        <select class="form-control" style="margin-right: 5px;" name="anioInicioCerti" 
                        id="anioInicioCerti" ng-model="anioInicioCerti">
                            <option value="">Año Inicio</option>
                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
                        <select class="form-control" name="anioFinCerti" id="anioFinCerti" 
                        ng-model="anioFinCerti">
                            <option value="">Año Fin</option>
                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
                    </div>
                    <div class="" style="color: crimson;" 
                        ng-show="validarBuscarAnios">
                        <strong>* Debe seleccionar el año léctivo(inicio y fin).</strong>
                    </div>
                    <div class="row justify-content-md-center">
                        <button class="btn btn-info nuevo" ng-click="buscarCertificado()">
                            Bucar
                        </button>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="">
                
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-sm">
                        <thead class="thead-inverse">
                            <tr>
                                <th>N° Matrícula</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Nivel</th>
                                <th>Curso</th>
                                <th>Paralelo</th>
                                <th>Año lectivo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="e in datosCerti | filter:buscar">
                                <td>{{ e.id_matr }}</td>
                                <td>{{ e.cedula_estu }}</td>
                                <td>{{ e.apellidos_estu }} {{ e.nombres_estu }}</td>
                                <td>{{ e.nivel_matr }}</td>
                                <td>{{ e.nombre_curs }}</td>
                                <td>{{ e.paralelo_matr }}</td>
                                <td>Desde {{ e.fechainicio_matr }} hasta {{ e.fechafin_matr }}</td>

                                <td>
                                    <div style="width: 200px;">
                                        <button class="btn btn-outline-info" ng-click="generarCerti($event)" 
                                        id="{{e.id_estu}}" name="<?= base_url()?>matricula_controller/getDataJsonCertiImprimir/{{e.id_estu}}/{{e.fechainicio_matr}}/{{e.fechafin_matr}}"
                                        data-toggle="modal" data-target="#modalCertificado">
                                            Certíficado
                                        </button>
                                        <button class="btn btn-outline-warning" ng-click="mostrarFormEdit($event)" 
                                        id="{{e.id_estu}}" name="<?= base_url()?>matricula_controller/getDataJsonCertiImprimir/{{e.id_estu}}/{{e.fechainicio_matr}}/{{e.fechafin_matr}}"
                                        data-toggle="modal" data-target="#modalEditar">
                                            Editar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" ng-show="Mensaje">
                                    <div  class="alert alert-danger" style="color: crimson;">
                                        <center>
											<strong>* No existe un estudiante relacionado con los datos ingresados.</strong>
										</center>
									</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <!--final de tabla-->

        </div>

    </div>
    <!-- Tab panes FIN -->

    <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar nueva matrícula.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fMatricula" ng-submit="registrarNuevo()" class="form-horizontal" >
                                <!--obtener los cursos disponibles en el colegio-->
                                <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
                                
                                <input type="hidden" id="urlInsertarM" value="<?= base_url()?>matricula_controller/insertar">
                                
                                <input type="hidden" id="idEstu" value="">

                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Ingrese la siguiente información:</strong></legend>
                                
                                <div class="alert alert-success" 
                                    ng-show="confirmarMatri">
                                    * Se matrículo al estudiante correctamente.
                                </div>

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
                                        ng-show="fMatricula.anioInicio.$valid && 
                                        fMatricula.mesInicio.$valid && 
                                        fMatricula.diaInicio.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fMatricula.anioInicio.$invalid || 
                                        fMatricula.mesInicio.$invalid ||
                                        fMatricula.diaInicio.$invalid">
                                        * Campos Obligatorios.
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
                                        ng-show="fMatricula.anioFin.$valid && 
                                        fMatricula.mesFin.$valid && 
                                        fMatricula.diaFin.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fMatricula.anioFin.$invalid ||
                                        fMatricula.mesFin.$invalid ||
                                        fMatricula.diaFin.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <label class="col-3 col-form-label">Nivel:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="categoriaNivel" id="categoriaNivel" 
                                        ng-model="categoriaNivel" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Educacion Basica General">Educación Básica General</option>
											<!--<option value="Inicial 1/2">Inicial 1/2</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Básica Elemental">Básica Elemental</option>
                                            <option value="Básica Media">Básica Media</option>
                                            <option value="Basica Superior">Basica Superior</option>
                                            <option value="Bachillerato">Bachillerato</option>
											-->
										</select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fMatricula.categoriaNivel.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fMatricula.categoriaNivel.$invalid">
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
                                        ng-show="fMatricula.cursosID.$valid">
                                        <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fMatricula.cursosID.$invalid">
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
                                        ng-show="fMatricula.paralelo.$valid">
                                       <strong>Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fMatricula.paralelo.$invalid">
                                        * Campo obligatorio.
                                    </div>
                                </div>

                                </fieldset>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fMatricula.$error.required">
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
                    <h3 class="modal-title" id="modalEditarLabel">Editar matrícula.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fMatriculaEdit" ng-submit="actualizar()" class="form-horizontal" >
                                <!--obtener los cursos disponibles en el colegio-->
                                <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
                                
                                <input type="hidden" id="urlActualizarM" value="<?= base_url()?>matricula_controller/actualizar/">
                                
                                <input type="hidden" id="idMatri" value="">

								<input type="hidden" id="urlBuscarCertiActualizado" value="<?= base_url()?>matricula_controller/getDataJsonMatriculaActualizada">

                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Puede editar la siguiente información:</strong></legend>
                                
                                <div class="alert alert-success" 
                                    ng-show="confirmarMatriEdit">
                                    * La matrícula se actualizó correctamente.
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Año lectivo, fecha de inicio:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioInicio" id="anioInicio" 
                                        ng-model="anioInicio" required>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select style="margin-left: 5px;" class="form-control" name="mesInicio" id="mesInicio" 
                                        ng-model="mesInicio" required>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select style="margin-left: 5px;" class="form-control" name="diaInicio" id="diaInicio" 
                                        ng-model="diaInicio" required>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Año lectivo, fecha de finalización:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioFin" id="anioFin" 
                                        ng-model="anioFin" required>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select style="margin-left: 5px;" class="form-control" name="mesFin" id="mesFin" 
                                        ng-model="mesFin" required>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select style="margin-left: 5px;" class="form-control" name="diaFin" id="diaFin" 
                                        ng-model="diaFin" required>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Nivel:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="categoriaNivel" id="categoriaNivel" 
                                        ng-model="categoriaNivel" required>
											<option value="Educacion Basica General">Educación Básica General</option>
                                            
											<!--<option value="Inicial 1/2">Inicial 1/2</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Básica Elemental">Básica Elemental</option>
                                            <option value="Básica Media">Básica Media</option>
                                            <option value="Basica Superior">Basica Superior</option>
                                            <option value="Bachillerato">Bachillerato</option>
											-->
										</select>
                                    </div>
                                </div>
                                
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Curso:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="cursosIDEdit" id="cursosIDEdit" required>
                                            <option value="{{cursoID2}}">{{cursoNombre}}</option>
                                            <option ng-repeat="c in cursos" value="{{c.id_curs}}">{{c.nombre_curs}}</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Paralelo:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="paraleloEdit" id="paraleloEdit" 
                                        ng-model="paraleloEdit" required>
                                            <option ng-repeat="p in paralelos" value="{{p}}">{{p}}</option>
                                        </select>
                                    </div>
                                </div>

                                </fieldset>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fMatriculaEdit.$error.required">
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
                                            <h4>Unidad Educativa Fiscal</h4>
                                            <h4>Patria</h4>
                                            <br>
                                            <h3>Certíficado de Matrícula</h3>
                                            <br>
                                        </div>
                                    </center>
                                    
                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">Matrícula N°. {{matriculaNum}}</label>
                                     </div>

                                     <div class="row">
                                        <label class="col-form-label" style="margin-left: 20px;">Folio N°. {{matriculaNum}}</label>
                                     </div>

                                     <div class="row" >
                                        <label class="col-form-label" style="position: absolute; right: 20px;">AÑO LECTIVO: {{anioI}} - {{anioF}}</label>
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
                                        <label class="col-form-label" style="margin-left: 20px;">EDAD:</label>
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

