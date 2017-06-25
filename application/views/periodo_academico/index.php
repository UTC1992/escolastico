<style>
    .contenidoPeriodo {
        margin-top: 50px;
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<div  class="contenidoPeriodo" ng-app="appPeriodoA">
        
<!--menu -->
<div class="container">
    <center><h2>Administrar Año Lectivo</h2></center>
    <input id="urlConsultarPeriodos" type="hidden" value="<?= base_url() ?>admin_/periodoacademico/lista">
</div>
<br>
<!--menu -->

<!--cuerpo -->
<div class="main">
    <div ng-view>

    </div>
</div>
<!--cuerpo -->

</div>
<br>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_periodo/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_periodo/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_periodo/routesPeriodo.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
