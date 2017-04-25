<style>
    .container{
        font-family: Arial, Helvetica, sans-serif;
    }

	label{
		font-size: 12pt;
	}
</style> 

<div class="container well" ng-app="appPeriodoA">

		<div class="row">
			<div class="col-xs-12">
				<center>
				<h2>Crear un nuevo Periodo Académico</h2>
				</center>
			

			<form name="formularioPeriodo" class="form-horizontal" action="<?= base_url() ?>periodoa_controller/insertar" method="post">

				<div class="form-group" ng-controller="periodoMeses">
					<label class="col-sm-3 control-label" for="formGroup">
						Mes de inicio de clases:
					</label>
					<div class="col-sm-6">
                        <select class="form-control" name="mesInicio" id="mesInicio" required ng-model="selectedMes">
                            <option value="">Seleccionar</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group" ng-controller="periodoAnios">
					<label class="col-sm-3 control-label" for="formGroup">
						Año de inicio de clases:
					</label>
					<div class="col-sm-6">
						<select class="form-control" name="anioInicio" id="anioInicio" required ng-model="selectedAnio">
                            <option value="">Seleccionar</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group" ng-controller="periodoMeses">
					<label class="col-sm-3 control-label" for="formGroup">
						Mes de finalización de clases:
					</label>
					<div class="col-sm-6">
						<select class="form-control" name="mesFin" id="mesFin" required ng-model="selectedMes">
                            <option value="">Seleccionar</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                        </select>
					</div>
				</div>
				
                <div class="form-group" ng-controller="periodoAnios">
					<label class="col-sm-3 control-label" for="formGroup" >
						Año de finalización de clases:
					</label>
					<div class="col-sm-6">
						<select class="form-control" name="anioFin" id="anioFin" required ng-model="selectedAnio">
                            <option value="">Seleccionar</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
					</label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit" onclick="validarRegistro();">
							<span class="glyphicon glyphicon-floppy-saved"></span>
							Guardar
						</button>
						<a  href="<?= base_url() ?>admin_/periodoacademico" class="btn btn-warning" type="button">
							<span class="glyphicon glyphicon-remove-circle"></span>
							Cancelar
						</a>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_periodo/controller.js"></script>