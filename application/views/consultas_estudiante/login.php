<style>
    .container{
		margin-top: 100px;
		margin-bottom: 100px;
    }
</style>

<div class="container" ng-app="appLoginEstu" ng-controller="loginEstuCtrl">
		<!--
		<img class="img-responsive" width="100" height="100" src="<?= base_url() ?>disenio/img/logo.png">
		-->
		<div class="row justify-content-lg-center">
			<div class="fluit" style="width: 300px;">
				<h2>Login Estudiantes y Representantes</h2>
				<br>
				<div class="">
					<img src="" alt="" class="img-responsive" id="login">
				</div>
				
				<label style="color: crimson; font-size: 14pt;"><strong><?= $error ?></strong></label>
				<form name="flogin" class="loginEstu" action='<?= base_url() ?>Login_Estu/login' 
					method="post" accept-charset='UTF-8' role="form">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Usuario" 
						name="username" id="username" ng-model="username"  required autofocus>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Contraseña" 
						name="password" id="password" ng-model="password" required>
					</div>
					<button class="btn btn-warning btn-block" type="submit">
					Iniciar Sesión</button>			
				</form>
			</div>
		</div>
</div>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_loginEstu/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_loginEstu/controller.js"></script>
