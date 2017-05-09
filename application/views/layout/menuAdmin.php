    <!-- necesario para el carusel -->
    <link href="<?= base_url() ?>disenio/indexBootstrap/carousel.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/css/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JS angular -->
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular.js"></script>
    <script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_js/angular-route.js"></script>
    
<body>
<header>   
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
     <a class="navbar-brand" href="<?= base_url() ?>admin_/dashboard">Administración</a>
      <div class="collapse navbar-collapse" >
        
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="nav-link btn btn-outline-warning" href="<?= base_url() ?>admin_/dashboard">Inicio <span class="sr-only">(current)</span></a>
          </li>
           <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/periodoacademico/">Periodo</a>
          </li>
          <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/asignaturas/">Asignatura</a>
          </li>
           <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/curso/">Curso</a>
          </li>
           <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>">Estudiantes</a>
          </li>
          <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>">Matrícula</a>
          </li>

           <?php if($this->session->userdata('login_admin')) { ?>
            <li class="nav-item active" style="padding: 0px; margin: 5px;">
              <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/logout">Perfil</a>
            </li>
            <li class="nav-item active" style="padding: 0px; margin: 5px;">
              <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>admin_/logout">Cerrar Sesión</a>
            </li>
           <?php }else{ ?>
           <?php } ?>
          
        </ul>
      </div>
    </nav>

</header>
    
    