<style>
    .container{
        margin-top: 50px;
		margin-bottom: 30px;
		border: 2px solid gray;
		
    }
</style>

<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12">
				<center>
				<h2>Crear nueva cuenta</h2>
				</center>
			

			<form  class="form-horizontal" action="<?= base_url() ?>administrador_controller/insertar" method="post">

				<div class="form-group row" style="color: red;">
					<label class="col-8 col-form-label"  ><?= $error ?></label>
				</div>

				<div class="form-group row">
					<label class="col-4 col-form-label" for="formGroup">
						Cédula:
					</label>
					<div class="col-8">
						<input class="form-control" type="text" name="cedula" id="formGroup" placeholder="Cédula" required="">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4 col-form-label" for="formGroup">
						Nombres:
					</label>
					<div class="col-8">
						<input class="form-control" type="text" name="nombres" id="formGroup" placeholder="Nombres" required="">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4 col-form-label" for="formGroup">
						Apellidos:
					</label>
					<div class="col-8">
						<input class="form-control" type="text" name="apellidos" id="formGroup" placeholder="Apellidos" required=" ">
					</div>
				</div>
				
                <div class="form-group row">
					<label class="col-4 control-label" for="formGroup">
						Email:
					</label>
					<div class="input-group col-8">
						<span class="input-group-addon">@</span>
						<input class="form-control" type="email" name="email" id="formGroup" placeholder="Correo electrónico" required="">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4 control-label" for="formGroup">
						Password:
					</label>
					<div class="col-8">
						<input class="form-control" type="password" name="password" id="formGroup" placeholder="Contraseña" required="">
					</div>
				</div>

				<div class="form-group">
					<div class="col-12">
						<button class="btn btn-primary" type="submit" onclick="validarRegistro();">
							<span class="glyphicon glyphicon-floppy-saved"></span>
							Guardar
						</button>
						<a  href="<?= base_url() ?>admin_/login" class="btn btn-warning" type="button">
							<span class="glyphicon glyphicon-remove-circle"></span>
							Cancelar
						</a>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>