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
                            <button class="btn btn-warning editar" ng-click="mostrarFormEditar($event)" 
                            id="<?= base_url() ?>periodoa_controller/getDataJsonPeriodoId/{{p.id_pera}}" 
                            data-toggle="modal" data-target="#exampleModal">
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

<div ng-controller="periodoAcademicoDatos">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Editar el periodo seleccionado.</h3>
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
                    <input type="hidden" id="idPeriodo" value="{{idPer}}">

                    <div class="form-group row" >
                        <label class="col-5 col-form-label">
                            Mes de inicio de clases:
                        </label>
                        <div class="col-5">
                            <select class="form-control" name="mesInicio" id="mesInicio" required ng-model="mesInicioEdit">
                                <option value="{{mesI}}">{{mesinicio}}</option>
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
                                <option value="{{anioinicio}}">{{anioinicio}}</option>
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
                                <option value="{{mesfin}}">{{mesfin}}</option>
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
                                <option value="{{aniofin}}">{{aniofin}}</option>
                                <option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="col-4 btn btn-primary" type="submit" >
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                            Guardar
                        </button>
                        <button type="button" class="col-4 btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
      </div>
      
    </div>
  </div>
</div>

</div>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        });
</script>