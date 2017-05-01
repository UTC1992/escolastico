<style>
    #contenidoPeriodos {
        
    }
</style>


<div id="contenidoPeriodos" class="container">
    <h3>Lista de periodos académicos</h3>
<div ng-controller="periodoAcademicoDatos">	
    <input type="hidden" id="urlPeriodos" value="<?= base_url()?>periodoa_controller/getDataJsonPeriodoAll">
    <div class="input-group">
        <span class="input-group-addon icon-search"></span>
        <input class="form-control" type="text" ng-model="buscarPeriodo" 
        placeholder="Buscar periodo" style="width: 200px;">
    </div>
    
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mes de inicio</th>
                    <th>Año de inicio</th>
                    <th>Mes de finalización</th>
                    <th>Año de finalización</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="p in periodos | filter:buscarPeriodo">
                    <td>{{ p.mesinicio_pera }}</td>
                    <td>{{ p.anioinicio_pera }}</td>
                    <td>{{ p.mesfin_pera }}</td>
                    <td>{{ p.aniofin_pera }}</td>
                    <td>
                        <div>
                            <a id="periodo{{p.id_pera}}" ng-mousemove="myFunc($event)" class="btn btn-warning" href="<?= base_url() ?>admin_/periodoacademico/edit/{{p.id_pera}}">
                                Editar
                            </a>
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