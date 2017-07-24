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
<style>
	.logo {
			/* cambia estos dos valores para definir el tamaño de tu círculo */
			height: 100px;
			width: 100px;
			/* los siguientes valores son independientes del tamaño del círculo */
			background-repeat: no-repeat;
			border-radius: 50%;
			background-size: 100% auto;
	}
</style>
<header>   
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
		 <a class="navbar-brand" href="<?= base_url() ?>admin_/dashboard">
		 	Consulta de Calificaciones
		 </a>
      <div class="collapse navbar-collapse" >
        
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
					
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
