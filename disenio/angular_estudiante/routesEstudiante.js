//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarEstudiante').val();
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "estudianteCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
