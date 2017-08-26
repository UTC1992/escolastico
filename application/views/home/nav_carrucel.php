    <!-- necesario para el carusel -->
    <link href="<?= base_url() ?>disenio/indexBootstrap/carousel.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/css/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>disenio/bootstrap/css/bootstrap.css" rel="stylesheet">
    
<body>
<header> 
		<br>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" 
			data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" 
			aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
     <a class="navbar-brand" href="<?= base_url() ?>">
		 	<table  >
					<tr>
					<td rowspan="2"><img src="<?= base_url() ?>disenio/img/logo3.png" 
					 style="width: 90px; height: 80px;"></td>
					<td ><strong>Unidad Educativa Fiscal</strong></td>
					</tr>
					<tr>
					<td><strong><center>"Patria"</center></strong></td> 
					</tr>
			</table>
		 </a>
      <div class="collapse navbar-collapse" >
        
      </div>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" style="padding: 0px; margin: 5px; width: 200px;">
            <a class="nav-link btn btn-outline-warning" href="<?= base_url() ?>">
						Inicio <span class="sr-only">(current)</span></a>
          </li>
					<li class="nav-item active" style="padding: 0px; margin: 5px; width: 200px;">
            <a class="nav-link btn btn-outline-warning" href="<?= base_url() ?>home/misionVision">
						Misión y Visión <span class="sr-only"></span></a>
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
        </ul>
      </div>
    </nav>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" role="listbox" >
        <div class="carousel-item active" style="background-color: white;">
         
          <div class="container" >
            <div class="carousel-caption d-none d-md-block text-left">
              <h1></h1>
              <p><img src="<?= base_url() ?>disenio/img/patria1-1.jpg" class="img-fluid" style="height: 400px;"></p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-color: white;">
          
          <div class="container">
            <div class="carousel-caption d-none d-md-block">
              <h1></h1>
              <p><img src="<?= base_url() ?>disenio/img/patria4.jpg" class="img-fluid" style="height: 400px;"></p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-color: white;">
          
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
              <h1></h1>
              <p><img src="<?= base_url() ?>disenio/img/patria5.jpg" class="img-fluid" style="height: 400px;"></p>
              <p></p>
            </div>
          </div>
				</div>
				
				<div class="carousel-item" style="background-color: white;">
         
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
              <h1></h1>
              <p><img src="<?= base_url() ?>disenio/img/patria3.jpg" class="img-fluid" style="height: 400px;"></p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev" >
        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>
        <span class="sr-only" >Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</header>
    
    