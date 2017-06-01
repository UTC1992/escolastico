    <!-- necesario para el carusel -->
    <link href="<?= base_url() ?>disenio/css/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">
    
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
          <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="nav-link btn btn-outline-warning" href="<?= base_url() ?>" style="width: 130px;">
			Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item" style="padding: 0px; margin: 5px; color: white;">
              <div class="dropdown active">
                <a class="btn nav-link btn-outline-warning dropdown-toggle" 
                href="#" id="dropdownMenuButton" data-toggle="dropdown" >
                    Cálificaciones
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Consultar</a>
                    <a class="dropdown-item" href="<?= base_url() ?>notas_/ingresar_notas/login">Ingresar notas</a>
                </div>
              </div>
          </li>
          
          <li class="nav-item active" style="padding: 0px; margin: 5px;">
            <a class="btn nav-link btn-outline-warning" href="<?= base_url() ?>">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </nav>
</header>
    
    