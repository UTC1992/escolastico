<style>
    #contenidoAsig {
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoAsig" class="container" ng-controller="asignaturaCtrl">
    
    <div >	
        <input type="hidden" id="urlAsignaturas" value="<?= base_url()?>asignaturas_controller/getDataJsonAsignaturaAll">
        <!--
		<h4>Filtro:</h4>
        <div class="input-group">
            <input type="text" class="col-4 form-control" name="buscarAsignatura" id="buscarAsignatura"
            ng-model="buscar.nombre_asig" placeholder="Buscar asignatura por nombre">
        </div>
        <br>
		-->
		<center>
			<button class="btn btn-primary nuevoP" ng-click="limpiarVariables()" data-toggle="modal" data-target="#modalNuevo">
				Nueva Asignatura
			</button>
		</center>
		<h3>Lista de Asignaturas</h3>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-striped table-sm"
			 ng-table ="personasTable" show-filter="true">
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
                    <tr ng-repeat="a in $data">
                        <td data-title="'N°'">{{ $index + 1 }}</td>
                        <td data-title="'Asignatura'" sortable="'nombre_asig'" filter="{nombre_asig: 'text'}">{{ a.nombre_asig }}</td>
                        <td data-title="'Acciones'">
                            <div>
								<center>
                                <button class="btn btn-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>asignaturas_controller/getDataJsonAsignaturaId/{{a.id_asig}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>
								</center>

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
	<br>

     <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar una nueva asignatura.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fAsignatura" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <div class="col-12 alert alert-success" ng-show="mensajeInsertA">
                                    La asignatura se ingresó correctamente.
                                </div>

                                <input type="hidden" id="urlInsertarA" value="<?= base_url()?>asignaturas_controller/insertar">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombre de la asignatura:</label>
                                    <div class="col-4">
                                        <input class="form-control" name="nombreA" id="nombreA" ng-model="nombreA"
                                         type="text" ng-minlength="6" placeholder="Ingresar Asignatura" required>
                                    </div>
                                    <div class="col-4" style="color: #28B463"
                                        ng-show="fAsignatura.nombreA.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fAsignatura.nombreA.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fAsignatura.nombreA.$invalid">
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
                <h3 class="modal-title" id="modalEditarLabel">Editar la asignatura seleccionada.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fAsignaturaEditar" ng-submit="actualizar()" class="form-horizontal">
                            <input type="hidden" id="urlActualizarA" value="<?= base_url()?>asignaturas_controller/actualizar/">
                            <input type="hidden" id="idAsignatura" value="{{idAsignatura}}">
							
							<div class="col-12 alert alert-success" ng-show="mensajeActualizar">
								La asignatura se actualizó correctamente.
							</div>

                            <div class="form-group row" >
                                <label class="col-4 col-form-label">
                                    Asignatura a editar:
                                </label>
                                <div class="col-4">
                                    <input class="form-control" name="nombreEditA" id="nombreEditA" ng-model="nombreEditA"
                                         type="text" ng-minlength="6" placeholder="Editar Asignatura" required>
                                </div>
                                <div class="col-3 alert" style="color: #28B463"
                                    ng-show="fAsignaturaEditar.nombreEditA.$valid">
                                    <strong>* Correcto.</strong>
                                </div>
								<div class="col-4" style="color: crimson" 
									ng-show="fAsignaturaEditar.nombreEditA.$invalid">
									<strong>* Campo Obligatorio.</strong>
								</div>
                            </div>

                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" 
                                ng-disabled="fAsignaturaEditar.nombreEditA.$invalid">
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
