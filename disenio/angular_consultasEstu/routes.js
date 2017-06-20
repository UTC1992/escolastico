//configuracion de rutas 
app.config(function($routeProvider) {

	var urlParciales = $('#urlConsultarParciales').val();
	var urlQuimestral = $('#urlConsultarQuimestre').val();
	var urlAnual = $('#urlConsultarAnuales').val();

    $routeProvider
    .when("/", {
        templateUrl : urlParciales,
        controller : "notasEstuCtrl"
    })
	.when("/quimestrales", {
        templateUrl : urlQuimestral,
        controller : "notasEstuCtrl"
    })
	.when("/anuales", {
        templateUrl : urlAnual,
        controller : "notasEstuCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
