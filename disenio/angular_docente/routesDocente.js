//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarDocente').val();
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "docenteCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
