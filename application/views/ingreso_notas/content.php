<style>
    .notasIngreso {
        margin-top: 5px;
    }
</style>
<link href="<?= base_url() ?>disenio/css/dashboard.css" rel="stylesheet">
<br><br>
<div  class="notasIngreso"  ng-app="appNotasIngreso" >
        
	<!--Nav menu-->
	<input id="urlInicio" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/inicioNotas">

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
						<a class="nav-link btn-outline-warning" href="#/ingreso_notas" >Notas Parciales</a>
						<input id="urlIngresarNotas" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoNotas">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_examenes">Exámen Quimestral</a>
						<input id="urlIngresarExamenes" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoNotasExa">
					</li>
						<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_mejora">Exámen Mejora</a>
						<input id="urlIngresarExaMejora" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoExaMejora">
					</li>
					
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_supletorio">Exámen Supletorio</a>
						<input id="urlIngresarExaSuple" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoExaSuple">
					</li>
					
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_remedial">Exámen Remedial</a>
						<input id="urlIngresarExaRemedial" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoExaRemedial">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/ingresar_gracia">Exámen Gracia</a>
						<input id="urlIngresarExaGracia" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/ingresoExaGracia">
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
						<input id="urlMostrarInformes" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/informesNotas">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_examenes">Exámenes quimestrales</a>
						<input id="urlMostrarExa" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/consultarExa">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_mejora">Exámen Mejora</a>
						<input id="urlMostrarExaMejora" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/consultaExaMejora">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_supletorios">Exámen Supletorio</a>
						<input id="urlMostrarExaSuple" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/consultaExaSuple">
					</li>
					
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_remedial">Exámen Remedial</a>
						<input id="urlMostrarExaRemedial" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/consultaExaRemedial">
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-warning" href="#/consultas_gracia">Exámen Gracia</a>
						<input id="urlMostrarExaGracia" type="hidden" value="<?= base_url() ?>Ingresar_Notas_Controller/consultaExaGracia">
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
						value="<?= base_url() ?>ingresar_notas_Controller/consultarInformeFinal">
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
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controllerExaMejora.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controllerExaRemedial.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controllerExaGracia.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/factory.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/routes.js"></script>
