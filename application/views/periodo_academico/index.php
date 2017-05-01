<style>
    .contenidoPeriodo {
        margin-top: 50px;
    }
</style>
<div  class="contenidoPeriodo" ng-app="appPeriodoA">
        
<!--menu -->
<div class="container">
    <center><h2>Administrar Periodo academico</h2></center>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#/" class="nav-link">Listar</a>
            <input id="urlConsultarPeriodos" type="hidden" value="<?= base_url() ?>admin_/periodoacademico/lista">
        </li>
        <li class="nav-item">
            <a href="#/registro" class="nav-link">Registrar</a>
            <input id="urlRegistroPeriodo" type="hidden" value="<?= base_url() ?>admin_/periodoacademico/nuevo">
        </li>
    </ul>
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_periodo/controller.js"></script>
