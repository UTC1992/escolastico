//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarMatri').val();    
    
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "matriculaCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
