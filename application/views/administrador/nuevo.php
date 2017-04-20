<style>
    .container{
        margin-top: 50px;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<div class="container well">
		<div class="row">
			<div class="col-xs-12">
				<center>
				<h2>Crear nueva cuenta</h2>
				</center>
			</div>

			<form  class="form-horizontal" action="<?= base_url() ?>administrador_controller/insertar" method="post">

				<div class="form-group" style="color: red;">
					<p class="col-sm-7 control-label"  ><?= $error ?></p>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
						Cédula:
					</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="cedula" id="formGroup" placeholder="Cédula" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
						Nombres:
					</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="nombres" id="formGroup" placeholder="Nombres" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
						Apellidos:
					</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="apellidos" id="formGroup" placeholder="Apellidos" required=" ">
					</div>
				</div>
				
                <div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
						Email:
					</label>
					<div class="input-group col-sm-5">
						<span class="input-group-addon">@</span>
						<input class="form-control" type="email" name="email" id="formGroup" placeholder="Correo electrónico" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
						Password:
					</label>
					<div class="col-sm-4">
						<input class="form-control" type="password" name="password" id="formGroup" placeholder="Contraseña" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="formGroup">
					</label>
					<div class="col-sm-6">
						<button class="btn btn-lg btn-primary" type="submit" onclick="validarRegistro();">
							<span class="glyphicon glyphicon-floppy-saved"></span>
							Guardar
						</button>
						<a  href="<?= base_url() ?>admin_/login" class="btn btn-lg btn-danger" type="button">
							<span class="glyphicon glyphicon-remove-circle"></span>
							Cancelar
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>