<style>
</style> 

<div class="container" ng-controller="periodoAcademicoDatos">

		<div class="row justify-content-md-center">
			<div class="col-11">
				<h3>Registrar un nuevo Periodo Académico</h3>
			<form name="fPeriodo" ng-submit="enviar()" class="form-horizontal" >
				
				<div class="col-11 alert alert-warning" ng-hide="!mensajeInsertP">
					* Debe ingresar todos los datos porfavor.
				</div>
				<div class="col-11 alert alert-success" ng-hide="mensajeInsertP">
						* Periodo ingresado correctamente.
				</div>

				<input type="hidden" id="urlInsertarP" value="<?= base_url()?>periodoa_controller/insertar">
				<div class="form-group row">
					<label class="col-3 col-form-label">Mes de inicio de clases:</label>
					<div class="col-4">
						<select class="form-control" ng-model="mesInicio" name="mesInicio" id="mesInicio" required>
							<option value="">Seleccionar</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
						</select>
					</div>
					<div class="col-4 alert alert-success" 
						ng-show="fPeriodo.mesInicio.$valid">
						Correcto.
					</div>
					<div class="col-4 alert alert-danger" 
						ng-show="fPeriodo.mesInicio.$invalid">
						Debe ingresar el mes de inicio.
					</div>
					
				</div>

				<div class="form-group row">
					<label class="col-3 col-form-label" >Año de inicio de clases:</label>
					<div class="col-4">
						<select class="form-control" name="anioInicio" id="anioInicio" ng-model="anioInicio" required >
                            <option value="">Seleccionar</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
					<div class="col-4 alert alert-success" 
						ng-show="fPeriodo.anioInicio.$valid">
						Correcto.
					</div>
					<div class="col-4 alert alert-danger" 
						ng-show="fPeriodo.anioInicio.$invalid">
						Debe ingresar el año de inicio.
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3 col-form-label" for="formGroup">Mes de finalización de clases:</label>
					<div class="col-4">
						<select class="form-control" name="mesFin" id="mesFin" ng-model="mesFin" required >
                            <option value="">Seleccionar</option>
							<option ng-repeat="m in meses" value="{{m.name}}">{{m.name}}</option>
                        </select>
					</div>
					<div class="col-4 alert alert-success" 
						ng-show="fPeriodo.mesFin.$valid">
						Correcto.
					</div>
					<div class="col-4 alert alert-danger" 
						ng-show="fPeriodo.mesFin.$invalid">
						Debe ingresar el mes de finalización.
					</div>
				</div>
				
                <div class="form-group row">
					<label class="col-3 col-form-label" for="formGroup" >
						Año de finalización de clases:
					</label>
					<div class="col-4">
						<select class="form-control" name="anioFin" id="anioFin" ng-model="anioFin" required>
                            <option value="">Seleccionar</option>
							<option ng-repeat="a in anios" value="{{a}}">{{a}}</option>
                        </select>
					</div>
					<div class="col-4 alert alert-success" 
						ng-show="fPeriodo.anioFin.$valid">
						Correcto.
					</div>
					<div class="col-4 alert alert-danger" 
						ng-show="fPeriodo.anioFin.$invalid">
						Debe ingresar el año de finalización.
					</div>
				</div>

				<div class="form-group row">
					<div class="col-6">
						<button class="col-4 btn btn-primary" type="submit"
						ng-disabled="fPeriodo.$error.required">
							<span class="glyphicon glyphicon-floppy-saved"></span>
							Guardar
						</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
