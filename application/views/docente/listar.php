<style>
    #contenidoDocente {
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoDocente" class="container" ng-controller="docenteCtrl">
    <h3>Lista de Docentes</h3>
    <div >	
        <input type="hidden" id="urlDocentes" value="<?= base_url()?>docente_controller/getDataJsonDocenteAll">
        

        <button class="btn btn-primary nuevo" ng-click="inicializarInput()" data-toggle="modal" data-target="#modalNuevo">
            Nuevo Docente
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Relación laboral</th>
                        <th>Función</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="d in docentes | filter:buscar">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ d.cedula_doce }}</td>
                        <td>{{ d.nombres_doce }} {{ d.apellidos_doce }}</td>
                        <td>{{ d.relacion_laboral_doce }}</td>
                        <td>{{ d.funcion_doce }}</td>
                        <td>{{ d.estado_doce }}</td>
                        
                        <td>
                            <div style="width: 250px;">
                                

                                <button class="btn btn-outline-info editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>docente_controller/getDataJsonDocenteId/{{d.id_doce}}" 
                                data-toggle="modal" data-target="#modalMostrarDatos">
                                    Datos
                                </button>

								<button class="btn btn-outline-primary editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>docente_controller/getDataJsonDocenteId/{{d.id_doce}}" 
                                data-toggle="modal" data-target="#modalClave">
                                    Clave
                                </button>

                                <button class="btn btn-outline-warning editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>docente_controller/getDataJsonDocenteId/{{d.id_doce}}" 
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
                    <h3 class="modal-title" id="modalNuevoLabel">Registrar un nuevo docente.</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="row justify-content-md-center">
                            <div class="col-12">
                                
                            <form name="fDocente" ng-submit="registrarNuevo()" class="form-horizontal" >
                                
                                <input type="hidden" id="urlInsertarD" value="<?= base_url()?>docente_controller/insertar">
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
                                        ng-show="fDocente.cedula.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.cedula.$invalid">
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
                                        ng-show="fDocente.nombres.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.nombres.$invalid">
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
                                        ng-show="fDocente.apellidos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.apellidos.$invalid">
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
                                        ng-show="fDocente.diaNacimiento.$valid && 
                                        fDocente.mesNacimiento.$valid && 
                                        fDocente.anioNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaNacimiento.$invalid && 
                                        fDocente.mesNacimiento.$invalid && 
                                        fDocente.anioNacimiento.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Profesional</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Título o especialización de SENESCYT:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="titulo" id="titulo" ng-model="titulo"
                                         type="text" placeholder="Ingrese el título" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.titulo.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.titulo.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Fecha de ingreso al magisterio:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioIngresoMagis" id="anioIngresoMagis" 
                                        ng-model="anioIngresoMagis" required>
                                            <option value="">Año</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="mesIngresoMagis" id="mesIngresoMagis" 
                                        ng-model="mesIngresoMagis" required>
                                            <option value="">Mes</option>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="diaIngresoMagis" id="diaIngresoMagis" 
                                        ng-model="diaIngresoMagis" required>
                                            <option value="">Día</option>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fDocente.diaIngresoMagis.$valid && 
                                        fDocente.mesIngresoMagis.$valid && 
                                        fDocente.anioIngresoMagis.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaIngresoMagis.$invalid && 
                                        fDocente.mesIngresoMagis.$invalid && 
                                        fDocente.anioIngresoMagis.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Institucional</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Fecha de ingreso a la institución:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioIngresoInst" id="anioIngresoInst" 
                                        ng-model="anioIngresoInst" required>
                                            <option value="">Año</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="mesIngresoInst" id="mesIngresoInst" 
                                        ng-model="mesIngresoInst" required>
                                            <option value="">Mes</option>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="diaIngresoInst" id="diaIngresoInst" 
                                        ng-model="diaIngresoInst" required>
                                            <option value="">Día</option>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fDocente.diaIngresoInst.$valid && 
                                        fDocente.mesIngresoInst.$valid && 
                                        fDocente.anioIngresoInst.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaIngresoInst.$invalid && 
                                        fDocente.mesIngresoInst.$invalid && 
                                        fDocente.anioIngresoInst.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Relación laboral:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="relacionLab" 
                                        id="relacionLab" ng-model="relacionLab" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Nombramiento">Nombramiento</option>
                                            <option  value="Nombramiento Provisional">Nombramiento Provisional</option>
                                            <option  value="Contrato">Contrato</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.relacionLab.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.relacionLab.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Categoría o Contrato:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="categoriaContrato" 
                                        id="categoriaContrato" ng-model="categoriaContrato"
                                         type="text" placeholder="Categoría o Contrato 1 o 2" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.categoriaContrato.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.categoriaContrato.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Función:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="funcion" 
                                        id="funcion" ng-model="funcion" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Rector">Rector</option>
                                            <option  value="Vicerrector">Vicerrector</option>
                                            <option  value="Inspector General">Inspector General</option>
                                            <option  value="Docente">Docente</option>
                                            <option  value="Secretaria">Secretaria</option>
                                            <option  value="Psicologa">Psicologa</option>
                                            <option  value="Trabajadora Social">Trabajadora Social</option>
                                            <option  value="Enc. A. Fijos">Enc. A. Fijos</option>
                                            <option  value="Auxiliar de servicios">Auxiliar de servicios</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.funcion.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.funcion.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de horas pedagógicas:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="horasPedagogicas" 
                                        id="horasPedagogicas" ng-model="horasPedagogicas"
                                         type="number" placeholder="Horas pedagógicas" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.horasPedagogicas.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.horasPedagogicas.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Domiciliaria</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Lugar de recidencia:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="lugarRecidencia" 
                                        id="lugarRecidencia" ng-model="lugarRecidencia"
                                         type="text" placeholder="Lugar de recidencia" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.lugarRecidencia.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.lugarRecidencia.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono del domicilio:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="telefono" 
                                        id="telefono" ng-model="telefono"
                                         type="text" ng-minlength="9" ng-maxlength="10" placeholder="Teléfono del domicilio" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.telefono.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.telefono.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono movil:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="movil" 
                                        id="movil" ng-model="movil"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Teléfono movil" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.movil.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.movil.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Email:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="correo" 
                                        id="correo" ng-model="correo"
                                         type="email" placeholder="Correo electrónico" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.correo.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.correo.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información del empleo</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Estado:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="estado" 
                                        id="estado" ng-model="estado" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Activo">Activo</option>
                                            <option  value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.estado.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.estado.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fDocente.$error.required">
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
                <h3 class="modal-title" id="modalEditarLabel">Editar el docente seleccionado.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fDocente" ng-submit="actualizar()" class="form-horizontal" >
                                
                                <input type="hidden" id="urlActualizarD" value="<?= base_url()?>docente_controller/actualizar/">
                                <input type="hidden" id="idDocente" value="{{idDocente}}">

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
                                        ng-show="fDocente.cedula.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.cedula.$invalid">
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
                                        ng-show="fDocente.nombres.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.nombres.$invalid">
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
                                        ng-show="fDocente.apellidos.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.apellidos.$invalid">
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
                                        ng-show="fDocente.diaNacimiento.$valid && 
                                        fDocente.mesNacimiento.$valid && 
                                        fDocente.anioNacimiento.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaNacimiento.$invalid && 
                                        fDocente.mesNacimiento.$invalid && 
                                        fDocente.anioNacimiento.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Profesional</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Título o especialización de SENESCYT:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="titulo" id="titulo" ng-model="titulo"
                                         type="text" placeholder="Ingrese el título" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.titulo.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.titulo.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Fecha de ingreso al magisterio:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioIngresoMagis" id="anioIngresoMagis" 
                                        ng-model="anioIngresoMagis" required>
                                            <option value="">Año</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="mesIngresoMagis" id="mesIngresoMagis" 
                                        ng-model="mesIngresoMagis" required>
                                            <option value="">Mes</option>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="diaIngresoMagis" id="diaIngresoMagis" 
                                        ng-model="diaIngresoMagis" required>
                                            <option value="">Día</option>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fDocente.diaIngresoMagis.$valid && 
                                        fDocente.mesIngresoMagis.$valid && 
                                        fDocente.anioIngresoMagis.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaIngresoMagis.$invalid && 
                                        fDocente.mesIngresoMagis.$invalid && 
                                        fDocente.anioIngresoMagis.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Institucional</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Fecha de ingreso a la institución:</label>
                                    <div class="col-5 form-inline">
                                        <select class="form-control" name="anioIngresoInst" id="anioIngresoInst" 
                                        ng-model="anioIngresoInst" required>
                                            <option value="">Año</option>
                                            <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="mesIngresoInst" id="mesIngresoInst" 
                                        ng-model="mesIngresoInst" required>
                                            <option value="">Mes</option>
                                            <option ng-repeat="m in meses" value="{{m.num}}">{{m.num}}</option>
                                        </select>
                                        
                                        <select class="form-control" name="diaIngresoInst" id="diaIngresoInst" 
                                        ng-model="diaIngresoInst" required>
                                            <option value="">Día</option>
                                            <option ng-repeat="d in dias" value="{{d}}">{{d}}</option>
                                        </select>
                                    </div>
                                    <div class="col-3 alert alert-success" 
                                        ng-show="fDocente.diaIngresoInst.$valid && 
                                        fDocente.mesIngresoInst.$valid && 
                                        fDocente.anioIngresoInst.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.diaIngresoInst.$invalid && 
                                        fDocente.mesIngresoInst.$invalid && 
                                        fDocente.anioIngresoInst.$invalid">
                                        * Campos Obligatorios.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Relación laboral:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="relacionLab" 
                                        id="relacionLab" ng-model="relacionLab" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Nombramiento">Nombramiento</option>
                                            <option  value="Nombramiento Provisional">Nombramiento Provisional</option>
                                            <option  value="Contrato">Contrato</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.relacionLab.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.relacionLab.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Categoría o Contrato:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="categoriaContrato" 
                                        id="categoriaContrato" ng-model="categoriaContrato"
                                         type="text" placeholder="Categoría o Contrato 1 o 2" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.categoriaContrato.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.categoriaContrato.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Función:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="funcion" 
                                        id="funcion" ng-model="funcion" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Rector">Rector</option>
                                            <option  value="Vicerrector">Vicerrector</option>
                                            <option  value="Inspector General">Inspector General</option>
                                            <option  value="Docente">Docente</option>
                                            <option  value="Secretaria">Secretaria</option>
                                            <option  value="Psicologa">Psicologa</option>
                                            <option  value="Trabajadora Social">Trabajadora Social</option>
                                            <option  value="Enc. A. Fijos">Enc. A. Fijos</option>
                                            <option  value="Auxiliar de servicios">Auxiliar de servicios</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.funcion.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.funcion.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Número de horas pedagógicas:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="horasPedagogicas" 
                                        id="horasPedagogicas" ng-model="horasPedagogicas"
                                         type="number" placeholder="Horas pedagógicas" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.horasPedagogicas.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.horasPedagogicas.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Domiciliaria</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Lugar de recidencia:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="lugarRecidencia" 
                                        id="lugarRecidencia" ng-model="lugarRecidencia"
                                         type="text" placeholder="Lugar de recidencia" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.lugarRecidencia.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.lugarRecidencia.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono del domicilio:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="telefono" 
                                        id="telefono" ng-model="telefono"
                                         type="text" ng-minlength="9" ng-maxlength="10" placeholder="Teléfono del domicilio" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.telefono.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.telefono.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono movil:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="movil" 
                                        id="movil" ng-model="movil"
                                         type="text" ng-minlength="10" ng-maxlength="10" placeholder="Teléfono movil" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.movil.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.movil.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Email:</label>
                                    <div class="col-5">
                                        <input class="form-control" name="correo" 
                                        id="correo" ng-model="correo"
                                         type="email" placeholder="Correo electrónico" required>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.correo.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.correo.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información del empleo</strong></legend>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Estado:</label>
                                    <div class="col-5">
                                        <select class="form-control" name="estado" 
                                        id="estado" ng-model="estado" required>
                                            <option  value="">Seleccionar</option>
                                            <option  value="Activo">Activo</option>
                                            <option  value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-4 alert alert-success" 
                                        ng-show="fDocente.estado.$valid">
                                        Correcto.
                                    </div>
                                    <div class="col-4" style="color: crimson" 
                                        ng-show="fDocente.estado.$invalid">
                                        * Campo Obligatorio.
                                    </div>
                                </div>
                                </fieldset>
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fDocente.$error.required">
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

    <!--INICIO MODAL MOSTRAR INFORMACION-->
    <div class="modal fade" id="modalMostrarDatos" tabindex="-1" role="dialog" aria-labelledby="modalMostrarDatosLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalMostrarDatosLabel">Información del docente.</h3>
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
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Profesional</strong></legend>
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Título o especialización de SENESCYT:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{titulo}}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Fecha de ingreso al magisterio:</label>
                                    <div class="col-5 form-inline">
                                        <label class="col-form-label">{{anioIngresoMagis}}-{{mesIngresoMagis}}-{{diaIngresoMagis}}</label>
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Institucional</strong></legend>
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Fecha de ingreso a la institución:</label>
                                    <div class="col-5 form-inline">
                                        <label class="col-form-label">{{anioIngresoInst}}-{{mesIngresoInst}}-{{diaIngresoInst}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Relación laboral:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{relacionLab}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Categoría o Contrato:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{categoriaContrato}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Función:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{funcion}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Número de horas pedagógicas:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{horasPedagogicas}}</label>
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información Domiciliaria</strong></legend>
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Lugar de recidencia:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{lugarRecidencia}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Teléfono del domicilio:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{telefono}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Teléfono movil:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{movil}}</label>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Email:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{telefono}}</label>
                                    </div>
                                </div>
                                </fieldset>
                                <br>
                                <fieldset class="form-control">
                                <legend class="form-control"><strong>Información del empleo</strong></legend>
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-3 col-form-label">Estado:</label>
                                    <div class="col-5">
                                        <label class="col-form-label">{{estado}}</label>
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

	<!--INICIO MODAL EDITAR-->
    <div class="modal fade" id="modalClave" tabindex="-1" role="dialog" aria-labelledby="modalClaveLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalClaveLabel">Ingreso de clave.</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="">
                
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                        <form name="fDocenteClave" ng-submit="actualizarClave()" class="form-horizontal" >
                                
                                <input type="hidden" id="urlAClave" value="<?= base_url()?>docente_controller/actualizarClave/">
                                <input type="hidden" id="idDocente" value="{{idDocente}}">

								<div class="col-12" style="color: #28B463" 
									ng-show="confirmar">
									<strong> La clave se actualizó correctamente.</strong>
								</div>

                                <fieldset class="form-control">
                                	<legend class="form-control"><strong>Clave o Password</strong></legend>
									<div class="form-group row">
										<label class="col-3 col-form-label">Clave:</label>
										<div class="col-5">
											<div class="input-group">
												<input class="form-control" name="password" 
												id="password" ng-model="password"
												type="password" placeholder="Clave o Contraseña" 
												ng-minlength="8" required value="{{password}}">
												<span><input class="btn btn-outline-info" 
												ng-mousedown="mostrarClave()" ng-mouseup="ocultarClave()" type="button" value="Ver"></span>
											</div>
										</div>
										<div class="col-4" style="color: #28B463" 
											ng-show="fDocenteClave.password.$valid">
											<strong> Correcto.</strong>
										</div>
										<div class="col-4" style="color: crimson" 
											ng-show="fDocenteClave.password.$invalid">
											* Campo Obligatorio, ingrese 8 carácteres.
										</div>
									</div>
                                </fieldset>
                                <div class="modal-footer">
                                    <button class="col-3 btn btn-primary" type="submit"
                                    ng-disabled="fDocenteClave.password.$invalid">
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
    $('#modalMostrarDatos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    });

    
</script>

