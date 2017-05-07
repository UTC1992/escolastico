<style>
    #contenidoAsig {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoAsig" class="container" ng-controller="cursoCtrl">
    <h3>Lista de Cursos</h3>
    <div >	
        <input type="hidden" id="urlCursos" value="<?= base_url()?>curso_controller/getDataJsonCursoAll">
        

        <button class="btn btn-primary nuevo" data-toggle="modal" data-target="#modalNuevo">
            Nueva Asignatura
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Número de Paralelos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="c in cursos | filter:buscar">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ c.nombre_curs }}</td>
                        <td>{{ c.numparalelos_curs }}</td>
                        <td>
                            <div>
                                <button class="btn btn-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>curso_controller/getDataJsonCursoId/{{c.id_curs}}" 
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
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo curso.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fCurso" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <div class="col-12 alert alert-warning" ng-hide="!mensajeInsertC">
                                    * Debe ingresar todos los datos porfavor.
                                </div>
                                <div class="col-12 alert alert-success" ng-hide="mensajeInsertC">
                                    Curso ingresada correctamente.
                                </div>

                                <input type="hidden" id="urlInsertarC" value="<?= base_url()?>curso_controller/insertar">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombre del Curso:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="nombreC" id="nombreC" ng-model="nombreC"
                                         type="text" ng-minlength="5" placeholder="Curso" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fCurso.nombreC.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4 alert alert-danger" 
                                        ng-show="fCurso.nombreC.$invalid">
                                        * Debe ingresar el nombre del curso.
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de paralelos:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="numParalelos" id="numParalelos" ng-model="numParalelos"
                                         type="text" placeholder="Número de paralelos" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fCurso.numParalelos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4 alert alert-danger" 
                                        ng-show="fCurso.numParalelos.$invalid">
                                        * Debe ingresar el numero de paralelos que tiene el curso.
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fCurso.nombreC.$invalid && fCurso.numParalelos.$invalid">
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

                            <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombre del Curso:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="nombreEditC" id="nombreEditC" ng-model="nombreEditC"
                                         type="text" ng-minlength="5" placeholder="Curso" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fCursoEditar.nombreEditC.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4 alert alert-danger" 
                                        ng-show="fCursoEditar.nombreEditC.$invalid">
                                        * Debe ingresar el nombre del curso.
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de paralelos:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="paralelosEditC" id="paralelosEditC" 
                                        ng-model="paralelosEditC"
                                         type="text" placeholder="Número de paralelos" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fCursoEditar.paralelosEditC.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4 alert alert-danger" 
                                        ng-show="fCursoEditar.paralelosEditC.$invalid">
                                        * Debe ingresar el numero de paralelos que tiene el curso.
                                    </div>
                                    
                                </div>

                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" 
                                ng-disabled="fCursoEditar.nombreEditC.$invalid && fCursoEditar.paralelosEditC.$invalid">
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