<style>
    #contenidoEstudiante {
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="estudianteCtrl">
    <h3>Lista de Estudiantes</h3>
    <div >	
        <input type="hidden" id="urlEstudiantes" value="<?= base_url()?>estudiante_controller/getDataJsonEstudiantesAll">
        

        <button class="btn btn-primary nuevo" ng-click="inicializarInput()" data-toggle="modal" data-target="#modalNuevo">
            Nuevo Estudiante
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width: 1000px">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Fecha Nacimiento</th>
                        <th>Dirección</th>
                        <th>Lugar de Nacimiento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="e in estudiantes | filter:buscar">
                        <td>{{ $index + 1 }}</td>
                        <td>{{e.cedula_estu}}</td>
                        <td>{{e.nombres_estu}} {{e.apellidos_estu}}</td>
                        <td>{{e.fechanacimiento_estu}}</td>
                        <td>{{e.direccion_estu}}</td>
                        <td>{{e.lugar_nacimiento_estu}}</td>
                        
                        <td>
                            <div>
                                

                                <button style="width: 100px;" class="btn btn-outline-info editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}" 
                                data-toggle="modal" data-target="#modalMostrarDatos">
                                    Datos
                                </button>
                                <br>
                                <button style="width: 100px;" class="btn btn-outline-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Editar
                                </button>
                                <br>
                                <button style="width: 100px;" class="btn btn-outline-primary editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>estudiante_controller/getDataJsonEstudianteId/{{e.id_estu}}" 
                                data-toggle="modal" data-target="#modalEditar">
                                    Matricular
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
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo estudiante.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
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
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.cedula.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedula.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombres:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="nombres" id="nombres" ng-model="nombres"
                                         type="text" ng-minlength="5" placeholder="Ingrese los nombres" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.nombres.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.nombres.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Apellidos:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="apellidos" id="apellidos" ng-model="apellidos"
                                         type="text" ng-minlength="5" placeholder="Ingrese los apellidos" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.apellidos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.apellidos.$invalid">
                                        * Campo Obligatorio.
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
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.diaNacimiento.$valid && 
                                        fEstudiante.mesNacimiento.$valid && 
                                        fEstudiante.anioNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.diaNacimiento.$invalid && 
                                        fEstudiante.mesNacimiento.$invalid && 
                                        fEstudiante.anioNacimiento.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Dirección domiciliaria:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="domicilio" 
                                        id="domicilio" ng-model="domicilio"
                                         type="text" placeholder="Domicilio" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.domicilio.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.domicilio.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Lugar de nacimiento:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="lugarNacimiento" 
                                        id="lugarNacimiento" ng-model="lugarNacimiento"
                                         type="text" placeholder="Lugar de nacimiento" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.lugarNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.lugarNacimiento.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="representante" id="representante" 
                                        ng-model="representante"
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.representante.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.representante.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaRepre" id="cedulaRepre" 
                                        ng-model="cedulaRepre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.cedulaRepre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaRepre.$invalid">
                                        * Campo Obligatorio.
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
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.padre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.padre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del padre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaPadre" id="cedulaPadre" 
                                        ng-model="cedulaPadre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.cedulaPadre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaPadre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="madre" id="madre" ng-model="madre"
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.madre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.madre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula de la madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaMadre" id="cedulaMadre" 
                                        ng-model="cedulaMadre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.cedulaMadre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaMadre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono del representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="telefonoRepre" 
                                        id="telefonoRepre" ng-model="telefonoRepre"
                                         type="text" ng-minlength="9" ng-maxlength="15" placeholder="Teléfono" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fEstudiante.telefonoRepre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.telefonoRepre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fEstudiante.$error.required">
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
                <h3 class="modal-title" id="modalEditarLabel">Editar datos del estudiante.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fEstudiante" ng-submit="actualizar()" class="form-horizontal" >
                                
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
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.cedula.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedula.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nombres:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="nombres" id="nombres" ng-model="nombres"
                                         type="text" ng-minlength="5" placeholder="Ingrese los nombres" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.nombres.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.nombres.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Apellidos:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="apellidos" id="apellidos" ng-model="apellidos"
                                         type="text" ng-minlength="5" placeholder="Ingrese los apellidos" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.apellidos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.apellidos.$invalid">
                                        * Campo Obligatorio.
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
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.diaNacimiento.$valid && 
                                        fEstudiante.mesNacimiento.$valid && 
                                        fEstudiante.anioNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.diaNacimiento.$invalid && 
                                        fEstudiante.mesNacimiento.$invalid && 
                                        fEstudiante.anioNacimiento.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Dirección domiciliaria:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="domicilio" 
                                        id="domicilio" ng-model="domicilio"
                                         type="text" placeholder="Domicilio" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.domicilio.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.domicilio.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Lugar de nacimiento:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="lugarNacimiento" 
                                        id="lugarNacimiento" ng-model="lugarNacimiento"
                                         type="text" placeholder="Lugar de nacimiento" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.lugarNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.lugarNacimiento.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="representante" id="representante" 
                                        ng-model="representante"
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.representante.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.representante.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del Representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaRepre" id="cedulaRepre" 
                                        ng-model="cedulaRepre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.cedulaRepre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaRepre.$invalid">
                                        * Campo Obligatorio.
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
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.padre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.padre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula del padre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaPadre" id="cedulaPadre" 
                                        ng-model="cedulaPadre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.cedulaPadre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaPadre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="madre" id="madre" ng-model="madre"
                                         type="text" ng-minlength="5" placeholder="Apellidos y nombres" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.madre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.madre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cédula de la madre:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="cedulaMadre" id="cedulaMadre" 
                                        ng-model="cedulaMadre"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Ingrese la cédula" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.cedulaMadre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.cedulaMadre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono del representante:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="telefonoRepre" 
                                        id="telefonoRepre" ng-model="telefonoRepre"
                                         type="text" ng-minlength="9" ng-maxlength="15" placeholder="Teléfono" required>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fEstudiante.telefonoRepre.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fEstudiante.telefonoRepre.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fEstudiante.$error.required">
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