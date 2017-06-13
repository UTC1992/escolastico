<style>
    .contenidoAsig {
        margin-top: 50px;
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<div  class="contenidoAsig" ng-app="appCurso">
        
<!--head -->
<div class="container">
    <center><h2>Administrar Cursos</h2></center>
    <input id="urlConsultarCurso" type="hidden" value="<?= base_url() ?>admin_/curso/listar">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_curso/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_curso/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_curso/routesCurso.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
