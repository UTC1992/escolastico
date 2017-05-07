//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarAsignaturas').val();
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "asignaturaCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
