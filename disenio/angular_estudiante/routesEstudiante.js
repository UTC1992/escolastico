//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarEstudiante').val();

	var urlInicial = $('#urlConsultarInicial').val();
	var urlPreparatoria = $('#urlConsultarPreparatoria').val();
	var urlBasica = $('#urlConsultarBasica').val();
	var urlSuperior = $('#urlConsultarSuperior').val();

    $routeProvider
    .when("/", {
        templateUrl : urlInicial,
        controller : "estudianteCtrl"
    })
	.when("/preparatoria", {
        templateUrl : urlPreparatoria,
        controller : "estudianteCtrl"
    })
	.when("/basica", {
        templateUrl : urlBasica,
        controller : "estudianteCtrl"
    })
	.when("/superior", {
        templateUrl : urlSuperior,
        controller : "estudianteCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
