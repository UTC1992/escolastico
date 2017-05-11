<style>
    .contenidoAsig {
        margin-top: 50px;
    }
</style>
<div  class="contenidoAsig" ng-app="appDocente">
        
<!--head -->
<div class="container">
    <center><h2>Gestión de Docentes</h2></center>
    <input id="urlConsultarDocente" type="hidden" value="<?= base_url() ?>admin_/docente/listar">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente/routesDocente.js"></script>
