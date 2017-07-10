//configuracion de rutas 
app.config(function($routeProvider) {
    var urlIngresoN = $('#urlIngresarNotas').val();
    var urlConsultasN = $('#urlMostrarInformes').val();
	var urlIngresarExa = $('#urlIngresarExamenes').val();
	var urlConsultasExa = $('#urlMostrarExa').val();
	var urlIngresarExaSuple = $('#urlIngresarExaSuple').val();
	var urlConsultasExaSuple = $('#urlMostrarExaSuple').val();
	var urlIngresarExaMejora = $('#urlIngresarExaMejora').val();
	var urlConsultasExaMejora = $('#urlMostrarExaMejora').val();
	var urlIngresarExaRemedial = $('#urlIngresarExaRemedial').val();
	var urlConsultasExaRemedial = $('#urlMostrarExaRemedial').val();
	var urlIngresarExaGracia = $('#urlIngresarExaGracia').val();
	var urlConsultasExaGracia = $('#urlMostrarExaGracia').val();
	//informes
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
	.when("/ingresar_supletorio", {
        templateUrl : urlIngresarExaSuple,
        controller : "ingresoExaSupleCtrl"
    })
	.when("/consultas_supletorios", {
        templateUrl : urlConsultasExaSuple,
        controller : "ingresoExaSupleCtrl"
    })
	.when("/ingresar_mejora", {
        templateUrl : urlIngresarExaMejora,
        controller : "ingresoExaMejoraCtrl"
    })
	.when("/consultas_mejora", {
        templateUrl : urlConsultasExaMejora,
        controller : "ingresoExaMejoraCtrl"
    })
	.when("/ingresar_remedial", {
        templateUrl : urlIngresarExaRemedial,
        controller : "ingresoExaRemedialCtrl"
    })
	.when("/consultas_remedial", {
        templateUrl : urlConsultasExaRemedial,
        controller : "ingresoExaRemedialCtrl"
    })
	.when("/ingresar_gracia", {
        templateUrl : urlIngresarExaGracia,
        controller : "ingresoExaGraciaCtrl"
    })
	.when("/consultas_gracia", {
        templateUrl : urlConsultasExaGracia,
        controller : "ingresoExaGraciaCtrl"
    })
	.when("/informe_final", {
        templateUrl : urlInformeFinal,
        controller : "notasIngresoExaCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
