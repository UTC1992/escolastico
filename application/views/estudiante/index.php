<style>
    .contenidoEstu {
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<div class="container"  class="contenidoEstu" ng-app="appEstudiante">
<br>
<br>
<!--head -->
<div>
    <center><h2>Administrar Estudiantes</h2></center>
    <input id="urlConsultarEstudiante" type="hidden" value="<?= base_url() ?>admin_/estudiante/listar">
</div>
<br>
<!--head -->
<!--url para las paginas-->
<input id="urlConsultarInicial" type="hidden" value="<?= base_url() ?>estudiante_controller/inicial">
<input id="urlConsultarPreparatoria" type="hidden" value="<?= base_url() ?>estudiante_controller/preparatoria">
<input id="urlConsultarBasica" type="hidden" value="<?= base_url() ?>estudiante_controller/basica">
<input id="urlConsultarSuperior" type="hidden" value="<?= base_url() ?>estudiante_controller/superior">
<!--url para las paginas-->

<!-- Nav tabs -->
    <div class="">	
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" style="margin-right: 5px;">
                <a class="nav-link active" data-toggle="tab" href="#inicial" role="tab">Inicial 2</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#preparatoria" role="tab">Preparatoria</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#basica" role="tab">Educación General Básica</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#superior" role="tab">Educación General Superior</a>
            </li>
        </ul>
    </div>
    <!-- Nav tabs fin -->
<!--cuerpo -->
<div class="main">
    <div ng-view>

    </div>
</div>
<!--cuerpo -->

</div>
<br>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_estudiante/routesEstudiante.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
