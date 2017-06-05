//configuracion de rutas 
app.config(function($routeProvider) {
    var urlIngresoN = $('#urlIngresarNotas').val();
    var urlInformeN = $('#urlMostrarInformes').val();
    $routeProvider
    .when("/ingreso_notas", {
        templateUrl : urlIngresoN,
        controller : "notasIngresoCtrl"
    })
	.when("/mostrar_informes", {
        templateUrl : urlInformeN,
        controller : "notasIngresoCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
