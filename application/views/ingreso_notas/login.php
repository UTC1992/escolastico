<style>
    .container{
		margin-top: 100px;
		margin-bottom: 100px;
    }
</style>

<div class="container" ng-app="appLogin" ng-controller="loginCtrl">
		<!--
		<img class="img-responsive" width="100" height="100" src="<?= base_url() ?>disenio/img/logo.png">
		-->
		<div class="row justify-content-lg-center">
			<div class="fluit" style="width: 300px;">
				<h2>Login Docentes</h2>
				<br>
				<div class="">
					<img src="" alt="" class="img-responsive" id="login">
				</div>
			
				<form name="flogin" class="loginAdmin" action="<?= base_url() ?>login_docente/login" 
					method="post" accept-charset='UTF-8' role="form">
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email" 
						name="email" id="email" ng-model="email"  requered autofocus>
						<span ng-show="flogin.email.$invalid">Correo electronico incorrecto.</span>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Contraseña" 
						name="password" id="password" ng-model="password" ng-minlength="8" required>
						<span ng-show="flogin.password.$invalid">Debe ingresar una contraseña de 8 carácteres.</span>
					</div>
					<button class="btn btn-warning btn-block" type="submit"
					ng-disabled="flogin.email.$invalid || flogin.password.$invalid"
					>Iniciar Sesión</button>			
				</form>
			</div>
		</div>
</div>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_login/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_login/controller.js"></script>
