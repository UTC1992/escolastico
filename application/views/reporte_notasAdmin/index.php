<style>
    .contenido {
    }
</style>
<link href="<?= base_url() ?>disenio/angular_js/ng-table.min.css" rel="stylesheet">
<br>
<div class=""  ng-app="appReportesNotas">
<br>
<br>
<!--head -->
<div>
    <center><h2>Consulta de Notas</h2></center>
</div>
<br>
<!--head -->
<!--url para las paginas-->
<input id="urlConsultarParciales" type="hidden" value="<?= base_url() ?>Reporte_Notasadmin_Controller/repoParcial">
<input id="urlConsultarQuimestre" type="hidden" value="<?= base_url() ?>Reporte_Notasadmin_Controller/repoQuimestral">
<input id="urlConsultarAnuales" type="hidden" value="<?= base_url() ?>Reporte_Notasadmin_Controller/repoAnual">
<input id="urlConsultarSabanaFinal" type="hidden" value="<?= base_url() ?>Reporte_Notasadmin_Controller/sabanaFinal">
<!--url para las paginas-->

<!-- Nav tabs -->
    <div class="container">	
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
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#/sabanaFinal" role="tab">Sábana Final</a>
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesNotas/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesNotas/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesNotas/controllerSabanas.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesNotas/routes.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_reportesNotas/factory.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/ng-table.min.js"></script>
<script src="<?= base_url() ?>disenio/js/jspdf.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>disenio/js/jspdf.plugin.autotable.js" type="text/javascript"></script>
