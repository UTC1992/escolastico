<style>
    #contenidoPeriodos {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoPeriodos" class="container" ng-controller="periodoAcademicoDatos">
    <h3>Lista de periodos académicos</h3>
    <div >	
        <input type="hidden" id="urlPeriodos" value="<?= base_url()?>periodoa_controller/getDataJsonPeriodoAll">
        
        <h4>Filtros</h4>
        <div class="input-group">
            <select class="form-control" name="buscarMesInicio" id="buscarMesInicio" ng-model="buscarPeriodo.mesinicio_pera">
                <option value="">Buscar por mes de inicio</option>
                <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
            </select>
            <select class="form-control" name="buscarMesFin" id="buscarMesFin" ng-model="buscarPeriodo.mesfin_pera">
                <option value="">Buscar por mes de finalización</option>
                <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
            </select>
        </div>
        <div class="input-group">
            <select class="form-control" ng-model="buscarPeriodo.anioinicio_pera" name="buscarAnioInicio" id="buscarAnioInicio">
                <option value="">Buscar por año de inicio</option>
                <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
            </select>
            <select class="form-control" ng-model="buscarPeriodo.aniofin_pera" name="buscarAnioFin" id="buscarAnioFin">
                <option value="">Buscar por año de finalización</option>
                <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
            </select>
        </div>
        <br>
        <button class="btn btn-primary nuevoP" data-toggle="modal" data-target="#modalNuevo">
            Nuevo Periodo
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Mes de inicio</th>
                        <th>Año de inicio</th>
                        <th>Mes de finalización</th>
                        <th>Año de finalización</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="p in periodos | filter:buscarPeriodo">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ p.mesinicio_pera }}</td>
                        <td>{{ p.anioinicio_pera }}</td>
                        <td>{{ p.mesfin_pera }}</td>
                        <td>{{ p.aniofin_pera }}</td>
                        <td>
                            <div>
                                <button class="btn btn-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoId/{{p.id_pera}}" 
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


    <!--INICIO MODAL EDITAR-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalEditarLabel">Editar el periodo seleccionado.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fPeriodoEditar" ng-submit="actualizar()" class="form-horizontal">
                            <input type="hidden" id="urlActualizarP" value="<?= base_url()?>periodoa_controller/actualizar/">
                            <input type="hidden" id="idPeriodo" value="{{idPeriodo}}">

                            <div class="form-group row" >
                                <label class="col-5 col-form-label">
                                    Mes de inicio de clases:
                                </label>
                                <div class="col-5">
                                    <select class="form-control" name="mesInicio" id="mesInicio" required ng-model="mesInicioEdit">
                                        <option value="{{mesInicioEdit}}">{{mesInicioEdit}}</option>
                                        <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label" for="formGroup">
                                    Año de inicio de clases:
                                </label>
                                <div class="col-5">
                                    <select class="form-control" name="anioInicio" id="anioInicio" required ng-model="anioInicioEdit">
                                        <option value="{{anioInicioEdit}}">{{anioInicioEdit}}</option>
                                        <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label" for="formGroup">
                                    Mes de finalización de clases:
                                </label>
                                <div class="col-5">
                                    <select class="form-control" name="mesFin" id="mesFin" required ng-model="mesFinEdit">
                                        <option value="{{mesFinEdit}}">{{mesFinEdit}}</option>
                                        <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row" >
                                <label class="col-5 col-form-label" for="formGroup" >
                                    Año de finalización de clases:
                                </label>
                                <div class="col-5">
                                    <select class="form-control" name="anioFin" id="anioFin" required ng-model="anioFinEdit">
                                        <option value="{{anioFinEdit}}">{{anioFinEdit}}</option>
                                        <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" >
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
    <!--FIN MODAL EDITAR-->

     <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo periodo académico.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fPeriodo" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <div class="col-12 alert alert-warning" ng-hide="!mensajeInsertP">
                                    * Debe ingresar todos los datos porfavor.
                                </div>
                                <div class="col-12 alert alert-success" ng-hide="mensajeInsertP">
                                    Periodo ingresado correctamente.
                                </div>

                                <input type="hidden" id="urlInsertarP" value="<?= base_url()?>periodoa_controller/insertar">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Mes de inicio de clases:</label>
                                    <div class="col-3">
                                        <select class="form-control" ng-model="mesInicio" name="mesInicio" id="mesInicio" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-5 alert alert-success" 
                                        ng-show="fPeriodo.mesInicio.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-5 alert alert-danger" 
                                        ng-show="fPeriodo.mesInicio.$invalid">
                                        * Debe ingresar el mes de inicio.
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label" >Año de inicio de clases:</label>
                                    <div class="col-3">
                                        <select class="form-control" name="anioInicio" id="anioInicio" ng-model="anioInicio" required >
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                    </div>
                                    <div class="col-5 alert alert-success" 
                                        ng-show="fPeriodo.anioInicio.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-5 alert alert-danger" 
                                        ng-show="fPeriodo.anioInicio.$invalid">
                                        * Debe ingresar el año de inicio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="formGroup">Mes de finalización de clases:</label>
                                    <div class="col-3">
                                        <select class="form-control" name="mesFin" id="mesFin" ng-model="mesFin" required >
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-5 alert alert-success" 
                                        ng-show="fPeriodo.mesFin.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-5 alert alert-danger" 
                                        ng-show="fPeriodo.mesFin.$invalid">
                                        * Debe ingresar el mes de finalización.
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label" for="formGroup" >
                                        Año de finalización de clases:
                                    </label>
                                    <div class="col-3">
                                        <select class="form-control" name="anioFin" id="anioFin" ng-model="anioFin" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                    </div>
                                    <div class="col-5 alert alert-success" 
                                        ng-show="fPeriodo.anioFin.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-5 alert alert-danger" 
                                        ng-show="fPeriodo.anioFin.$invalid">
                                        * Debe ingresar el año de finalización.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fPeriodo.$error.required">
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
    
</script>