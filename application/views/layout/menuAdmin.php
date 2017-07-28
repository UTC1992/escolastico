    <!-- necesario para el carusel -->
    <link href="<?= base_url() ?>disenio/indexBootstrap/carousel.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/css/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JS angular -->
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular-route.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular-animate1.5.5.js"></script>
    
<body>
<header>   
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
		 <a class="navbar-brand" href="<?= base_url() ?>admin_/dashboard">
		 	<table  >
					<tr>
					<td rowspan="2"><img src="<?= base_url() ?>disenio/img/logo3.png" 
					 style="width: 90px; height: 80px;"></td>
					<td ><strong>Unidad Educativa Fiscal</strong></td>
					</tr>
					<tr>
					<td><strong>"Patria"</strong></td> 
					</tr>
			</table>
		 </a>
      <div class="collapse navbar-collapse" >
        
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
					<?php if($this->session->userdata('login_admin') && ($this->session->userdata('tipo_admin') == 'sysadmin')) { ?>
          <li class="nav-item active" style="padding: 0px; margin: 5px; width: 120px;">
            <a class="nav-link btn btn-outline-warning" id="inicioMenu" href="<?= base_url() ?>admin_/dashboard">Inicio<span class="sr-only">(current)</span></a>
          </li>
					<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 160px;">
						<div class="dropdown active">
							<a class="btn nav-link btn-outline-warning dropdown-toggle" 
							href="#" id="dropdownMenuButtonTablas" data-toggle="dropdown" >
									Gestionar Datos
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonTablas" style="width: 200px;">
									<a class="dropdown-item" id="anioMenu" href="<?= base_url() ?>admin_/periodoacademico/">Año Lectivo</a>
									<a class="dropdown-item" id="asignaturaMenu" href="<?= base_url() ?>admin_/asignaturas/">Asignaturas</a>
									<a class="dropdown-item" id="cursosMenu" href="<?= base_url() ?>admin_/curso/">Cursos</a>
									<a class="dropdown-item" id="docenteMenu" href="<?= base_url() ?>admin_/docente/">Docentes</a>
									<a class="dropdown-item" id="docenteMenu" href="<?= base_url() ?>admin_/docente_cargo">Docentes y Cargos</a>
									<a class="dropdown-item" id="estudiantesMenu" href="<?= base_url() ?>admin_/estudiantes/">Estudiantes</a>
							</div>
						</div>
					</li>

					<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 120px;">
						<div class="dropdown active">
							<a class="btn nav-link btn-outline-warning dropdown-toggle" 
							href="#" id="dropdownMenuButtonRepo" data-toggle="dropdown" >
									Reportes
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonRepo" style="width: 200px;">
									<a class="dropdown-item" id="matriculaMenu" href="<?= base_url() ?>admin_/reportes/matriculas/">Matrículas</a>
									<a class="dropdown-item" id="notasMenu" href="<?= base_url() ?>admin_/reportes/notas/">Notas</a>
							</div>
						</div>
					</li>
					
            <li class="nav-item active"  style="padding: 0px; margin: 5px; width: 120px;">
              <a class="btn nav-link btn-outline-warning" id="perfilMenu" href="<?= base_url() ?>admin_/perfil">Perfil</a>
            </li>
            <li class="nav-item active"  style="padding: 0px; margin: 5px; width: 120px;">
              <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/logout">Cerrar Sesión</a>
            </li>
           <?php }else{ ?>
           <?php } ?>

					 <?php if($this->session->userdata('login_admin') && ($this->session->userdata('tipo_admin') == 'basicoadmin')) { ?>
          <li class="nav-item active" style="padding: 0px; margin: 5px; width: 120px;">
            <a class="nav-link btn btn-outline-warning" id="inicioMenu" href="<?= base_url() ?>admin_/dashboard">Inicio<span class="sr-only">(current)</span></a>
          </li>
					<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 120px;">
						<div class="dropdown active">
							<a class="btn nav-link btn-outline-warning dropdown-toggle" 
							href="#" id="dropdownMenuButtonTablas" data-toggle="dropdown" >
									Gestionar Datos
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonTablas" style="width: 200px;">
									<a class="dropdown-item" id="anioMenu" href="<?= base_url() ?>admin_/periodoacademico/">Año Lectivo</a>
									<a class="dropdown-item" id="asignaturaMenu" href="<?= base_url() ?>admin_/asignaturas/">Asignaturas</a>
									<a class="dropdown-item" id="cursosMenu" href="<?= base_url() ?>admin_/curso/">Cursos</a>
									<a class="dropdown-item" id="docenteMenu" href="<?= base_url() ?>admin_/docente/">Docentes</a>
									<a class="dropdown-item" id="estudiantesMenu" href="<?= base_url() ?>admin_/estudiantes/">Estudiantes</a>
							</div>
						</div>
					</li>

					<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 120px;">
						<div class="dropdown active">
							<a class="btn nav-link btn-outline-warning dropdown-toggle" 
							href="#" id="dropdownMenuButtonRepo" data-toggle="dropdown" >
									Reportes
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonRepo" style="width: 200px;">
									<a class="dropdown-item" id="matriculaMenu" href="<?= base_url() ?>admin_/reportes/matriculas/">Matrículas</a>
									<a class="dropdown-item" id="notasMenu" href="<?= base_url() ?>admin_/reportes/notas/">Notas</a>
							</div>
						</div>
					</li>
					
            <li class="nav-item active"  style="padding: 0px; margin: 5px; width: 120px;">
              <a class="btn nav-link btn-outline-warning" id="perfilMenu" href="<?= base_url() ?>admin_/perfil">Perfil</a>
            </li>
            <li class="nav-item active"  style="padding: 0px; margin: 5px; width: 120px;">
              <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/logout">Cerrar Sesión</a>
            </li>
           <?php }else{ ?>
           <?php } ?>
					
					<?php
					if($this->session->userdata('login_estu') ) { 
						$estudiante = $this->session->userdata('nombreApellido_estu');
						?>
							<li class="nav-item" style="padding: 0px; margin: 5px;" >
								<label class="btn nav-link btn-outline-default" style="width: 400px; color: white;">
									<strong><?= $estudiante ?></strong>
								</label>	
							</li>
							<li class="nav-item active"  style="padding: 0px; margin: 5px; width: 200px;">
								<a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>login_estu/logout">Cerrar Sesión</a>
							</li>
					<?php }else{ ?>
          <?php } ?>

        </ul>
      </div>
    </nav>

</header>

    
    