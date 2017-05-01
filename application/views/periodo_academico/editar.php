<style>
	label{
		font-size: 12pt;
	}
	#contenidoPeriodoEdit {
        margin-top: 50px;
    }
</style> 

<div id="contenidoPeriodoEdit" class="container" ng-app="appPeriodoA" ng-controller="periodoAcademicoDatos">
		<div class="container">
			<center><h2>Administrar Periodo academico</h2></center>
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a href="<?= base_url() ?>admin_/periodoacademico" class="nav-link">Listar</a>
					
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>admin_/periodoacademico" class="nav-link disabled">Registrar</a>
				</li>
			</ul>
		</div>
		<br>
		<input type="hidden" id="url" value="<?= base_url()?>periodoa_controller/getDataJsonPeriodoId/<?= $id ?>">
		
		<div class="row justify-content-md-center">
			<div class="col-10">
				<h3>Editar periodo</h3>

			<form name="formularioPeriodo" class="form-horizontal" 
            action="<?= base_url() ?>admin_/periodoacademico/actualizar/<?= $id ?>" method="post">

				<div class="form-group row" >
					<label class="col-5 col-form-label">
						Mes de inicio de clases:
					</label>
					<div class="col-5">
                        <select class="form-control" name="mesInicio" id="mesInicio" required >
                            <option value="{{mesinicio}}">{{mesinicio}}</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-5 col-form-label" for="formGroup">
						Año de inicio de clases:
					</label>
					<div class="col-5">
						<select class="form-control" name="anioInicio" id="anioInicio" required>
                            <option value="{{anioinicio}}">{{anioinicio}}</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-5 col-form-label" for="formGroup">
						Mes de finalización de clases:
					</label>
					<div class="col-5">
						<select class="form-control" name="mesFin" id="mesFin" required >
                            <option value="{{mesfin}}">{{mesfin}}</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                        </select>
					</div>
				</div>
				
                <div class="form-group row" >
					<label class="col-5 col-form-label" for="formGroup" >
						Año de finalización de clases:
					</label>
					<div class="col-5">
						<select class="form-control" name="anioFin" id="anioFin" required >
                            <option value="{{aniofin}}">{{aniofin}}</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-6">
						<button class="col-4 btn btn-primary" type="submit">
							<span class="glyphicon glyphicon-floppy-saved"></span>
							Guardar
						</button>
						<a  href="<?= base_url() ?>admin_/periodoacademico" class="col-4 btn btn-warning" type="button">
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