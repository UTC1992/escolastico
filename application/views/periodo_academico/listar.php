<style>
    #contenidoPeriodos {
        
    }
</style>


<!--INICIO CONTENEDOR-->
<div id="contenidoPeriodos" class="container" ng-controller="periodoAcademicoDatos">
    
    <div >	
        <input type="hidden" id="urlPeriodos" value="<?= base_url()?>Periodoa_Controller/getDataJsonPeriodoAll">
    
		<?php if($this->session->userdata('login_admin') && ($this->session->userdata('tipo_admin') == 'sysadmin')) { ?>	
			<center><button class="btn btn-primary nuevoP" ng-click="limpiarVarianles()" data-toggle="modal" data-target="#modalNuevo">
				Registrar Año lectivo
			</button></center>
		<?php }else{ ?>

        <?php } ?>
		<h3>Lista de años lectivos</h3>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-striped table-sm"
			ng-table ="periodoTable" show-filter="true">
               
                <tbody>
                    <tr ng-repeat="p in $data | orderBy:anioinicio_pera">
                        <td data-title="'N°'">{{ $index + 1 }}</td>
                        <td data-title="'Mes Inicio'"  filter="{mesinicio_pera: 'text'}">{{ p.mesinicio_pera }}</td>
                        <td data-title="'Año Inicio'" sortable="'anioinicio_pera'"  filter="{anioinicio_pera: 'text'}">{{ p.anioinicio_pera }}</td>
                        <td data-title="'Mes Fin'"  filter="{mesfin_pera: 'text'}">{{ p.mesfin_pera }}</td>
                        <td data-title="'Año Fin'"  sortable="'aniofin_pera'" filter="{aniofin_pera: 'text'}">{{ p.aniofin_pera }}</td>
						<td data-title="'Estado'"  filter="{estado_pera: 'text'}">{{ p.estado_pera }}</td>
                        <?php if($this->session->userdata('login_admin') && ($this->session->userdata('tipo_admin') == 'sysadmin')) { ?>
						<td data-title="'Acciones'">
                            <div>
                                <button class="btn btn-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>Periodoa_Controller/getDataJsonPeriodoId/{{p.id_pera}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>

                                <!--<a id="periodo{{p.id_pera}}" ng-mousemove="myFunc($event)" class="btn btn-danger" href="<?= base_url() ?>admin_/periodoacademico/eliminar/{{p.id_pera}}">
                                    Eliminar
                                </a>
                                -->
                            </div>
                        </td>
						<?php }else{ ?>

						<?php } ?>
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
                <h3 class="modal-title" id="modalEditarLabel">Editar el año lectivo seleccionado.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fPeriodoEditar" ng-submit="actualizar()" class="form-horizontal">
                            <input type="hidden" id="urlActualizarP" value="<?= base_url()?>Periodoa_Controller/actualizar/">
                            <input type="hidden" id="idPeriodo" value="{{idPeriodo}}">

							<div class="col-12 alert alert-success" ng-show="mensajeUpdate">
								El año lectivo se actualizó correctamente.
							</div>

                            <div class="form-group row" >
                                <label class="col-4 col-form-label">
                                    Mes de inicio de clases:
                                </label>
                                <div class="col-4">
                                    <select class="form-control" name="mesInicioEdit" id="mesInicioEdit" required ng-model="mesInicioEdit">
                                        <option value="{{mesInicioEdit}}">{{mesInicioEdit}}</option>
                                        <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                    </select>
                                </div>
								<div class="col-4" style="color: #28B463" 
									ng-show="fPeriodoEditar.mesInicioEdit.$valid">
									<strong>* Correcto.</strong>
								</div>
								<div class="col-4" style="color: crimson" 
									ng-show="fPeriodoEditar.mesInicioEdit.$invalid">
									<strong>* Campo Obligatorio.</strong>
								</div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label" for="formGroup">
                                    Año de inicio de clases:
                                </label>
                                <div class="col-4">
                                    <select class="form-control" name="anioInicioEdit" id="anioInicioEdit" required ng-model="anioInicioEdit">
                                        <option value="{{anioInicioEdit}}">{{anioInicioEdit}}</option>
                                        <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                    </select>
                                </div>
								<div class="col-4" style="color: #28B463" 
									ng-show="fPeriodoEditar.anioInicioEdit.$valid">
									<strong>* Correcto.</strong>
								</div>
								<div class="col-4" style="color: crimson" 
									ng-show="fPeriodoEditar.anioInicioEdit.$invalid">
									<strong>* Campo Obligatorio.</strong>
								</div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label" for="formGroup">
                                    Mes de finalización de clases:
                                </label>
                                <div class="col-4">
                                    <select class="form-control" name="mesFinEdit" id="mesFinEdit" required ng-model="mesFinEdit">
                                        <option value="{{mesFinEdit}}">{{mesFinEdit}}</option>
                                        <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                    </select>
                                </div>
								<div class="col-4" style="color: #28B463" 
									ng-show="fPeriodoEditar.mesFinEdit.$valid">
									<strong>* Correcto.</strong>
								</div>
								<div class="col-4" style="color: crimson" 
									ng-show="fPeriodoEditar.mesFinEdit.$invalid">
									<strong>* Campo Obligatorio.</strong>
								</div>
                            </div>
                            
                            <div class="form-group row" >
                                <label class="col-4 col-form-label" for="formGroup" >
                                    Año de finalización de clases:
                                </label>
                                <div class="col-4">
                                    <select class="form-control" name="anioFinEdit" id="anioFinEdit" required ng-model="anioFinEdit">
                                        <option value="{{anioFinEdit}}">{{anioFinEdit}}</option>
                                        <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                    </select>
                                </div>
								<div class="col-4" style="color: #28B463" 
									ng-show="fPeriodoEditar.anioFinEdit.$valid">
									<strong>* Correcto.</strong>
								</div>
								<div class="col-4" style="color: crimson" 
									ng-show="fPeriodoEditar.anioFinEdit.$invalid">
									<strong>* Campo Obligatorio.</strong>
								</div>
                            </div>

							<div class="form-group row">
                                    <label class="col-4 col-form-label" for="formGroup" >
                                        Estado:
                                    </label>
                                    <div class="col-4">
                                        <select class="form-control" name="estadoEdit" id="estadoEdit" ng-model="estadoEdit" required>
                                            <option value="{{estadoEdit}}">{{estadoEdit}}</option>
                                            <option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
									<div class="col-4" style="color: #28B463" 
                                        ng-show="fPeriodoEditar.estadoEdit.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fPeriodoEditar.estadoEdit.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                </div>

                            <div class="modal-footer">
                                <button class="col-3 btn btn-primary" type="submit" >
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

     <!--INICIO MODAL NUEVO-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo año lectivo.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fPeriodo" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <div class="col-12 alert alert-success" ng-show="mensajeInsertP">
                                    El año lectivo se ingresó correctamente.
                                </div>

                                <input type="hidden" id="urlInsertarP" value="<?= base_url()?>Periodoa_Controller/insertar">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Mes de inicio de clases:</label>
                                    <div class="col-4">
                                        <select class="form-control" ng-model="mesInicio" name="mesInicio" id="mesInicio" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463" 
                                        ng-show="fPeriodo.mesInicio.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fPeriodo.mesInicio.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-4 col-form-label" >Año de inicio de clases:</label>
                                    <div class="col-4">
                                        <select class="form-control" name="anioInicio" id="anioInicio" ng-model="anioInicio" required >
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463"  
                                        ng-show="fPeriodo.anioInicio.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fPeriodo.anioInicio.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="formGroup">Mes de finalización de clases:</label>
                                    <div class="col-4">
                                        <select class="form-control" name="mesFin" id="mesFin" ng-model="mesFin" required >
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463"  
                                        ng-show="fPeriodo.mesFin.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fPeriodo.mesFin.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="formGroup" >
                                        Año de finalización de clases:
                                    </label>
                                    <div class="col-4">
                                        <select class="form-control" name="anioFin" id="anioFin" ng-model="anioFin" required>
                                            <option value="">Seleccionar</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463"  
                                        ng-show="fPeriodo.anioFin.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fPeriodo.anioFin.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                </div>

								<div class="form-group row">
                                    <label class="col-4 col-form-label" for="formGroup" >
                                        Estado:
                                    </label>
                                    <div class="col-4">
                                        <select class="form-control" name="estado" id="estado" ng-model="estado" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-4" style="color: #28B463"  
                                        ng-show="fPeriodo.estado.$valid">
                                        <strong>* Correcto.</strong>
                                    </div>
                                    <div class="col-4" style="color: crimson"
                                        ng-show="fPeriodo.estado.$invalid">
                                        <strong>* Campo Obligatorio.</strong>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fPeriodo.$error.required">
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

</div>
<!--FIN CONTENEDOR-->

