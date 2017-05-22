<style>
    #contenidoEstudiante {
        
    }
</style>

<!--INICIO CONTENEDOR-->
<div id="contenidoEstudiante" class="container" ng-controller="estudianteCtrl">
    <h3>Lista de Estudiantes</h3>
    <div >	
        <input type="hidden" id="urlEstudiantes" value="<?= base_url()?>estudiante_controller/getDataJsonEstudiantesAll">
        

        <button class="btn btn-primary nuevo" ng-click="" data-toggle="modal" data-target="#modalNuevo">
            Nuevo Estudiante
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
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
                                

                                <button class="btn btn-outline-info editar" ng-click="mostrarFormEditar($event)" 
                                id="<?= base_url() ?>docente_controller/getDataJsonDocenteId/{{d.id_doce}}" 
                                data-toggle="modal" data-target="#modalMostrarDatos">
                                    Ver más información...
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