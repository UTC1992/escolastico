<style>
    .notasIngreso {
        margin-top: 50px;
    }
</style>
<link href="<?= base_url() ?>disenio/css/dashboard.css" rel="stylesheet">
<div  class="notasIngreso"  ng-app="appNotasIngreso" >
        
	<!--Nav menu-->
		<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
				<label for="" class="nav-link"><strong>MENÚ</strong></label>
			</li>
			<li class="nav-item">
				<label for="" class="nav-link"><strong>Registro</strong></label>
			</li>
			<li class="nav-item">
				<ul class="flex-column" style="margin-bottom: 10px;">
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingreso_notas" >Notas parciales</a>
						<input id="urlIngresarNotas" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/ingresoNotas">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_examenes">Exámenes quimestrales</a>
						<input id="urlIngresarExamenes" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/ingresoNotasExa">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_supletorio">Exámenes supletorio</a>
						<input id="urlIngresarExaSuple" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/ingresoExaSuple">
					</li>
				</ul>
            </li>
			<li class="nav-item">
				<label for="" class="nav-link"><strong>Consulta y Edición</strong></label>
			</li>
            <li class="nav-item">
				<ul class="flex-column" style="margin-bottom: 10px;">
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultar_notas">Notas parciales</a>
						<input id="urlMostrarInformes" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/informesNotas">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_examenes">Exámenes quimestrales</a>
						<input id="urlMostrarExa" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/consultarExa">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_supletorios">Exámenes supletorio</a>
						<input id="urlMostrarExaSuple" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/consultaExaSuple">
					</li>
				</ul>
            </li>
			<!--
				<li class="nav-item">
				<label for="" class="nav-link"><strong>Informes</strong></label>
			</li>
			<li class="nav-item">
				<ul class="flex-column" style="margin-bottom: 10px;">
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/informe_final">Informe Final</a>
						<input id="urlInformeFinal" type="hidden" 
						value="<?= base_url() ?>ingresar_notas_controller/consultarInformeFinal">
					</li>
				</ul>
            </li>
			-->
          </ul>
        </nav>
	<!--Nav menu-->

	<!--cuerpo -->
	<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
		<!--head 
		<div class="container">
			<center><h2><strong>Getión de Calificaciones</strong></h2></center>
		</div>
		<br>-->
		<!--head -->
		<div ng-view>

		</div>
	</div>
	<!--cuerpo -->


</div>

<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controllerExa.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controllerExaSuple.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/routes.js"></script>
