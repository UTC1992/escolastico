<style>
    .contenidoAsig {
        margin-top: 50px;
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<br>
<div  class="contenidoAsig" ng-app="appAsignatura">
        
<!--head -->
<div class="container">
    <center><h2>Asignaturas</h2></center>
    <input id="urlConsultarAsignaturas" type="hidden" value="<?= base_url() ?>admin_/asignaturas/listar">
</div>
<br>
<!--head -->

<!--cuerpo -->
<div class="main">
    <div ng-view>

    </div>
</div>
<!--cuerpo -->

</div>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_asignatura/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_asignatura/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_asignatura/routesAsignatura.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
