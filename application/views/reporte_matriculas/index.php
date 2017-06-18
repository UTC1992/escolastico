<style>
    .contenido {
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<div class="container"  ng-app="appReportesMatri">
<br>
<br>
<!--head -->
<div>
    <center><h2>Reportes</h2></center>
	<center><h4>Matrículas</h4></center>
</div>
<br>
<!--head -->
<!--url para las paginas-->
<input id="urlConsultarPorCurso" type="hidden" value="<?= base_url() ?>reporte_matriculas_controller/porCurso">
<input id="urlConsultarPorParalelo" type="hidden" value="<?= base_url() ?>reporte_matriculas_controller/porParalelo">
<input id="urlConsultarPorCP" type="hidden" value="<?= base_url() ?>reporte_matriculas_controller/porCP">
<!--url para las paginas-->

<!-- Nav tabs -->
    <div class="">	
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" style="margin-right: 5px;">
                <a class="nav-link active" data-toggle="tab" href="#/" role="tab">Por Curso</a>
            </li>
			<!--
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#/porparalelo" role="tab">Por Paralelo</a>
            </li>
			-->
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#/porcp" role="tab">Por Curso y Paralelo</a>
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesMatri/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesMatri/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesMatri/routes.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
