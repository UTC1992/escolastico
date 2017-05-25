<style>
    .contenidoMatri {
        margin-top: 50px;
    }
</style>
<div  class="contenidoMatri" ng-app="appMatricula">
        
<!--head -->
<div class="container">
    <center><h2>Matriculación</h2></center>
    <input id="urlConsultarMatri" type="hidden" value="<?= base_url() ?>admin_/matricula/resgitro">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_matricular/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_matricular/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_matricular/routesMatricular.js"></script>
