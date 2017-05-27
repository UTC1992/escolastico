<style>
    #contenidoEstu{
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoEstu" class="container" ng-controller="matriculaCtrl">
    
    <div class="row justify-content-md-center">	
    <input type="hidden" id="urlBuscarEstu" value="<?= base_url()?>matricula_controller/getDataJsonEstudiante"> 
        <div class="col-lg-6">
            <div class="input-group">
                <button class="btn btn-info nuevo" ng-click="buscarEstudiante()">
                    Bucar
                </button>
                <input class="form-control" ng-model="cedulaEstu" type="text" name="" value=""
                 placeholder="Ingrese la cédula del estudiante">
            </div>
            
        </div>
        <div class="col-lg-4" style="color: crimson;" 
            ng-show="validarBuscar">
            <strong>* Debe ingresar los 10 digitos de la cédula.</strong>
        </div>
    </div>
    
    <div class="">
        
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
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
                                <button class="btn btn-outline-warning" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" ng-show="busqueda">
                            <div  class="alert alert-danger" style="color: crimson;">
                                <strong>* No existen estudiantes relacionados con la cedula ingresada.</strong>
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
                                            <option value="Inicial 1/2">Inicial 1/2</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Básica Elemental">Básica Elemental</option>
                                            <option value="Básica Media">Básica Media</option>
                                            <option value="Basica Superior">Basica Superior</option>
                                            <option value="Bachillerato">Bachillerato</option>
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
                                    <button type="button" class="col-3 btn btn-warning" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            </div>
                        </div>  
                </div>
            
            </div>
        </div>
    </div>
    <!--FIN MODAL NUEVO-->


</div>
<!--FIN CONTENEDOR-->
<script>
    
    $('#modalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });
    
    $('#modalNuevo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });
    $('#modalMostrarDatos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });

    
</script>

