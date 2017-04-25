<style>
	.tabla{
		float: left;
		width: 50%;
	}

	#contenedorHome{
		margin-bottom: 50px;
	}
</style>

<div id="contenedorHome" class="container well">
    <a name="modulosCalificaciones"></a>
    <center><h2 >Calificaciones</h2></center>

    <center>
	<table class="tabla">
		<caption><center>
			<h3>Consultar notas</h3>
		</center></caption>
		<thead>
			<tr>
				<th>Si eres un estudiante o un padre de familia.</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
                    <a href="#" >
                        <input type="button" class="btn btn-warning" value="Consultar notas...">
					</a>
                    <img style="float: right;" class="img-responsive" src="<?= base_url() ?>disenio/img/estudiante1.png" >
					
				</td>
			</tr>
		</tbody>
	</table>

	<table class="tabla" >
		<caption><center>
			<h3>Ingreso de notas</h3>
		</center></caption>
		<thead>
			<tr>
				<th>Si eres un Docente.</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a href="#" >
                        <input type="button" class="btn btn-warning" value="Ingresar notas...">
					</a>
                    <img style="float: right;" class="img-responsive" src="<?= base_url() ?>disenio/img/profesor1.png" >
				</td>
			</tr>
		</tbody>
	</table>
    </center>
</div>