    <!-- necesario para el carusel -->
    <link href="<?= base_url() ?>disenio/css/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">
		
		<!-- JS angular -->
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular-route.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular-animate1.5.5.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/bower_components/v-accordion/dist/v-accordion.js"></script>

		<link href="<?= base_url() ?>disenio/bower_components/v-accordion/dist/v-accordion.css" rel="stylesheet">

		<!-- JS JQUERY -->
		<script src="<?= base_url() ?>disenio/js/jquery-1.10.2.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>disenio/js/jquery-ui-1.9.2.custom.js" type="text/javascript" ></script>

<body>
<header>   
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
     <a class="navbar-brand" href="<?= base_url() ?>">Unidad Educativa Patria</a>
      <div class="collapse navbar-collapse" >
        
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          
          <?php if($this->session->userdata('login_estu')) { ?>
						<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 200px;">
								<div class="dropdown active">
									<a class="btn nav-link btn-outline-warning dropdown-toggle" 
									href="#" id="dropdownMenuButton" data-toggle="dropdown" >
											Registro
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 200px;">
											<a class="dropdown-item" href="#/ingreso_notas">Notas parciales</a>
											<a class="dropdown-item" href="#/ingresar_examenes">Exámenes quimestrales</a>
									</div>
								</div>
						</li>
						<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 200px;">
								<div class="dropdown active">
									<a class="btn nav-link btn-outline-warning dropdown-toggle" 
									href="#" id="dropdownMenuButton" data-toggle="dropdown" >
											Consulta y Edición
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 200px;">
											<a class="dropdown-item" href="#/consultar_notas">Notas parciales</a>
											<a class="dropdown-item" href="#/consultas_examenes">Exámenes quimestrales</a>
									</div>
								</div>
						</li>
          	
						<li class="nav-item active" style="padding: 0px; margin: 5px; width: 200px;">
							<a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>notas_/ingresar_notas/logout">Cerrar Sesión</a>
						</li>
					<?php }else{ ?>
						<li class="nav-item active" style="padding: 0px; margin: 5px; width: 200px;">
							<a class="nav-link btn btn-outline-warning" href="<?= base_url() ?>" >
								Inicio <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 200px;">
								<div class="dropdown active">
									<a class="btn nav-link btn-outline-warning dropdown-toggle" 
									href="#" id="dropdownMenuButton" data-toggle="dropdown" >
											Docentes
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 200px;">
											<a class="dropdown-item" href="<?= base_url() ?>notas_/ingresar_notas/login">Ingresar notas</a>
									</div>
								</div>
						</li>
						<li class="nav-item" style="padding: 0px; margin: 5px; color: white; width: 200px;">
								<div class="dropdown active">
									<a class="btn nav-link btn-outline-warning dropdown-toggle" 
									href="#" id="dropdownMenuButton" data-toggle="dropdown" >
											Estudiantes
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 200px;">
											<a class="dropdown-item" href="<?= base_url() ?>notas_/consultar/notas/login">Consultar Notas</a>
									</div>
								</div>
						</li>
						<!--
						<li class="nav-item active" style="padding: 0px; margin: 5px; width: 200px;">
							<a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>">Iniciar Sesión</a>
						</li>
						-->
           <?php } ?>
        </ul>
      </div>
    </nav>
</header>
    
    