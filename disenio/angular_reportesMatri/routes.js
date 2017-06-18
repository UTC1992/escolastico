//configuracion de rutas 
app.config(function($routeProvider) {

	var urlPorCurso = $('#urlConsultarPorCurso').val();
	var urlPorParalelo = $('#urlConsultarPorParalelo').val();
	var urlPorCP = $('#urlConsultarPorCP').val();

    $routeProvider
    .when("/", {
        templateUrl : urlPorCurso,
        controller : "repoMatriculasCtrl"
    })
	.when("/porparalelo", {
        templateUrl : urlPorParalelo,
        controller : "repoMatriculasCtrl"
    })
	.when("/porcp", {
        templateUrl : urlPorCP,
        controller : "repoMatriculasCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
