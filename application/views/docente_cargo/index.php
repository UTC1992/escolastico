<style>
    .contenidoAsig {
        margin-top: 50px;
    }
</style>
<div  class="contenidoAsig" ng-app="appDocenteCargo">
        
<!--head -->
<div class="container">
    <center><h2>Gestionar Docentes y cargos</h2></center>
    <input id="urlConsultarDocenteCargo" type="hidden" value="<?= base_url() ?>admin_/docente_cargo/listar">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente_cargo/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente_cargo/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_docente_cargo/routesDocenteCargo.js"></script>
