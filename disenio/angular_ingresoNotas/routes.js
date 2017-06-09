//configuracion de rutas 
app.config(function($routeProvider) {
    var urlIngresoN = $('#urlIngresarNotas').val();
    var urlConsultasN = $('#urlMostrarInformes').val();
	var urlIngresarExa = $('#urlIngresarExamenes').val();
	var urlConsultasExa = $('#urlMostrarExa').val();
	var urlInformeFinal = $('#urlInformeFinal').val();

    $routeProvider
    .when("/ingreso_notas", {
        templateUrl : urlIngresoN,
        controller : "notasIngresoCtrl"
    })
	.when("/consultar_notas", {
        templateUrl : urlConsultasN,
        controller : "notasIngresoCtrl"
    })
	.when("/ingresar_examenes", {
        templateUrl : urlIngresarExa,
        controller : "notasIngresoExaCtrl"
    })
	.when("/consultas_examenes", {
        templateUrl : urlConsultasExa,
        controller : "notasIngresoExaCtrl"
    })
	.when("/informe_final", {
        templateUrl : urlInformeFinal,
        controller : "notasIngresoExaCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
