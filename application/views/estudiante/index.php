<style>
    .contenidoEstu {
        margin-top: 50px;
    }
</style>
<div  class="contenidoEstu" ng-app="appEstudiante">
        
<!--head -->
<div class="container">
    <center><h2>Gestión de Estudiantes</h2></center>
    <input id="urlConsultarEstudiante" type="hidden" value="<?= base_url() ?>admin_/estudiante/listar">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/routesEstudiante.js"></script>
