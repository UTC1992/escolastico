//configuracion de rutas 
app.config(function($routeProvider) {

	var urlParciales = $('#urlConsultarParciales').val();
	var urlQuimestral = $('#urlConsultarQuimestre').val();
	var urlAnual = $('#urlConsultarAnuales').val();

    $routeProvider
    .when("/", {
        templateUrl : urlParciales,
        controller : "repoNotasAdminCtrl"
    })
	.when("/quimestrales", {
        templateUrl : urlQuimestral,
        controller : "repoNotasAdminCtrl"
    })
	.when("/anuales", {
        templateUrl : urlAnual,
        controller : "repoNotasAdminCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
