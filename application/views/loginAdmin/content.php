<style>
    .container{
        width: 350px;
        margin-top: 80px;
		font-family: Arial, Helvetica, sans-serif;
    }
</style>

<div class="container well">
		<center>
		<img class="img-responsive" width="100" height="100" src="<?= base_url() ?>disenio/img/logo.png">
		<h2>Login Administración</h2>
		</center>
		<div class="row">
			<div class="col-xs-5">
				<img src="" alt="" class="img-responsive" id="login">
			</div>
		</div>
		<form class="loginAdmin" action="<?= base_url() ?>login_admin/login" method="post" accept-charset='UTF-8' role="form">
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" name="email" id="email"  requered autofocus required="">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" requered required="">
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
			<div class="checkbox">
				<br>
				<p><a href="<?= base_url() ?>admin_/registro" style="font-size: 13pt;">Registrarce</a></p>
			</div>			
		</form>
	</div>