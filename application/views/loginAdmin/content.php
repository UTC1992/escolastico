<style>
    .container{
		margin-top: 100px;
		margin-bottom: 100px;
    }
</style>

<div class="container">
		<!--
		<img class="img-responsive" width="100" height="100" src="<?= base_url() ?>disenio/img/logo.png">
		-->
		<div class="row justify-content-lg-center col-12">
			<div>
				<h2>Login Administración</h2>
				<br>
				<div class="">
					<img src="" alt="" class="img-responsive" id="login">
				</div>
			
				<form class="loginAdmin" action="<?= base_url() ?>login_admin/login" method="post" accept-charset='UTF-8' role="form">
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email" name="email" id="email"  requered autofocus required="">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" requered required="">
					</div>
					<button class="btn btn-warning btn-block" type="submit">Iniciar Sesión</button>
					<div class="checkbox">
						<p><a href="<?= base_url() ?>admin_/registro" style="font-size: 13pt;">Registrarce</a></p>
					</div>			
				</form>
			</div>
		</div>
	</div>