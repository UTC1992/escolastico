<style>
    .contenido {
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<div class="container"  ng-app="appReportesNotas">
<br>
<br>
<!--head -->
<div>
    <center><h2>Consulta de Notas</h2></center>
</div>
<br>
<!--head -->
<!--url para las paginas-->
<input id="urlConsultarParciales" type="hidden" value="<?= base_url() ?>reporte_notasadmin_controller/repoParcial">
<input id="urlConsultarQuimestre" type="hidden" value="<?= base_url() ?>reporte_notasadmin_controller/repoQuimestral">
<input id="urlConsultarAnuales" type="hidden" value="<?= base_url() ?>reporte_notasadmin_controller/repoAnual">
<!--url para las paginas-->

<!-- Nav tabs -->
    <div class="">	
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" style="margin-right: 5px;">
                <a class="nav-link active" data-toggle="tab" href="#/" role="tab">Parciales</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#/quimestrales" role="tab">Quimestrales</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#/anuales" role="tab">Anuales</a>
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_consultasEstu/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_consultasEstu/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_consultasEstu/routes.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
