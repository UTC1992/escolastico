<style>
    .container{
        margin-top: 50px;
		
    }
</style>
<br>
<div class="container" ng-app="appAdmin" ng-controller="adminCtrl">
		<div class="row">
			<div class="col-12 justify-content-md-center">
			<h2>Perfil Admin</h2>
			<br>
			<form name="fAdmin"  class="form-horizontal" ng-submit="actualizarAdmin()">
				
				<input type="hidden" id="urlAdminEdit" value="<?= base_url() ?>Administrador_Controller/actualizar" >
				<input type="hidden" id="urlAdminMostrar" value="<?= base_url() ?>Administrador_Controller/getDataJsonAdminId" >
				
				<input type="hidden" value="<?= $idAdmin ?>" id="idAdmin">

				<fieldset class="form-control">
					<legend class="form-control"><strong>Datos personales:</strong></legend>
					<div class="col-12 alert alert-success" ng-show="mensajeActualizar">
						Datos actualizados correctamente.
					</div>
					<br>

					<div class="form-group row">
						<label class="col-4 col-form-label" for="formGroup">
							Cédula:
						</label>
						<div class="col-4">
							<input class="form-control" type="text" name="cedula" 
							id="formGroup" placeholder="Cédula" ng-minlength="10" ng-model="cedula" required="">
						</div>
						<div class="col-4" style="color: crimson"
							ng-show="fAdmin.cedula.$invalid">
							<strong>* Debe ingresar los 10 dígitos de la cédula.</strong>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-4 col-form-label" for="formGroup">
							Nombres:
						</label>
						<div class="col-8">
							<input class="form-control" type="text" name="nombres" 
							id="formGroup" placeholder="Nombres" ng-model="nombres" required="">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-4 col-form-label" for="formGroup">
							Apellidos:
						</label>
						<div class="col-8">
							<input class="form-control" type="text" name="apellidos" 
							id="formGroup" placeholder="Apellidos" ng-model="apellidos" required=" ">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-4 control-label" for="formGroup">
							Email:
						</label>
						<div class="input-group col-8">
							<span class="input-group-addon">@</span>
							<input class="form-control" type="email" name="email" 
							id="formGroup" placeholder="Correo electrónico" ng-model="email" required="">
						</div>
						<div class="offset-md-4">
							<div class="col-12" style="color: crimson"
								ng-show="fAdmin.email.$invalid">
								<strong>* Debe ingresar una dirección de correo válida.</strong>
							</div>
						</div>
						
					</div>

					<div class="form-group row">
						<label class="col-4 control-label" for="formGroup">
							Password:
						</label>
						<div class="col-8">
							<input class="form-control" type="password" name="password" 
							id="formGroup" placeholder="Contraseña de 8 carácteres porfavor"
							 ng-model="password" ng-minlength="8" required="">
						</div>
						<div class="offset-md-4">
							<div class="col-12" style="color: crimson"
								ng-show="fAdmin.password.$invalid">
								<strong>* Debe ingresar un password de 8 carácteres.</strong>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-12">
							<button class="btn btn-outline-primary" type="submit"
							ng-disabled="fAdmin.$error.required || 
							fAdmin.cedula.$invalid || fAdmin.email.$invalid || fAdmin.password.$invalid">
								Actualizar
							</button>
							<a href="<?= base_url() ?>admin_/dashboard" class="btn btn-outline-warning">
								<span class="glyphicon glyphicon-remove-circle"></span>
								Cancelar
							</a>
						</div>
					</div>
				</fieldset>
			</form>
			</div>
		</div>
	</div>
	<br>

<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_admin/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_admin/controller.js"></script>
