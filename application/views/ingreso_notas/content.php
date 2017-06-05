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
			  <a class="nav-link btn-outline-primary" href="#/ingreso_notas" >Ingreso de Notas</a>
			<input id="urlIngresarNotas" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/ingresoNotas">
            </li>
            <li class="nav-item">
              <a class="nav-link btn-outline-primary" href="#/mostrar_informes">Mostrar Informes</a>
			<input id="urlMostrarInformes" type="hidden" value="<?= base_url() ?>ingresar_notas_controller/informesNotas">
            </li>
          </ul>
        </nav>
	<!--Nav menu-->

	<!--cuerpo -->
	<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
		<!--head -->
		<div class="container">
			<center><h2><strong>Getión de Calificaciones</strong></h2></center>
		</div>
		<br>
		<!--head -->
		<div ng-view>

		</div>
	</div>
	<!--cuerpo -->


</div>

<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_ingresoNotas/routes.js"></script>
