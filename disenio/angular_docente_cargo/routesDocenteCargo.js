//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarDocenteCargo').val();
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "docenteCargoCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
