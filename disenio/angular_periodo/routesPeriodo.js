//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarPeriodos').val();    
    
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "periodoAcademicoDatos"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
