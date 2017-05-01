var app = angular.module('appPeriodoA', ["ngRoute"]);

app.controller('periodoAcademicoDatos', function($scope, $http) {
    //llenado de los selects de html
    listarMeses();
    listarAnios();
    listarPeriodos();
    mostrarDatosEditar();
    inicializarSelects();

    //listar meses
    function listarMeses(){
        $scope.meses = [
            {name : "Enero", num : "1"},
            {name : "Febrero", num : "2"},
            {name : "Marzo", num : "3"},
            {name : "Abril", num : "4"},
            {name : "Mayo", num : "5"},
            {name : "Junio", num : "6"},
            {name : "Julio", num : "7"},
            {name : "Agosto", num : "8"},
            {name : "Septiembre", num : "9"},
            {name : "Octubre", num : "10"},
            {name : "Noviembre", num : "11"},
            {name : "Disciembre", num : "12"}
        ];
    }
    
    //listar años desde 1900 hasta 2100
    function listarAnios(){
        $scope.anios = [];
        var contador = 0;
        for (var i = 1900; i < 2100; i++) {
            $scope.anios[contador] = i;
            contador++;
        }
    }

    //obtener datos de un determinado periodo dependiendo del url obtenido desde la vista
    function mostrarDatosEditar() {
        $scope.getUrl = $('#url').val();
        if ($scope.getUrl != null) {
            $http.get($scope.getUrl)
            .success(function(datosP){
                $scope.lista = datosP;
                $scope.mesinicio =  datosP[0]['mesinicio_pera'];
                $scope.anioinicio =  datosP[0]['anioinicio_pera'];
                $scope.mesfin =  datosP[0]['mesfin_pera'];
                $scope.aniofin =  datosP[0]['aniofin_pera'];
            });
        }
    }
    
    //obtener todos los periodos de la tabla
    function listarPeriodos() {
        $scope.getUrl = $('#urlPeriodos').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.periodos = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    //campos de los diferentes selects a validad
    function inicializarSelects() {
        $scope.mesInicio = "";
        $scope.anioInicio = "";
        $scope.mesFin = "";
        $scope.anioFin = "";
    }
    
    $scope.mensajeInsertP = true;

    // declaro la función enviar
    $scope.enviar = function () {
        $scope.getUrl = $('#urlInsertarP').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "mesInicio="+$scope.mesInicio+"&anioInicio="+$scope.anioInicio+"&mesFin="+$scope.mesFin+"&anioFin="+$scope.anioFin,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            $scope.mesInicio = "";
            $scope.anioInicio = "";
            $scope.mesFin = "";
            $scope.anioFin = "";

            $scope.mensajeInsertP = false;
        });
        
    }
    
});

app.config(function($routeProvider) {
    var urlRegistro = $('#urlRegistroPeriodo').val();
    var urlConsultar = $('#urlConsultarPeriodos').val();
    
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar
    })
    .when("/registro", {
        templateUrl : urlRegistro
    })
    .when("/editarPeriodo", {
        templateUrl : "paris.html",
        controller : "parisCtrl"
    });
});
/*
app.controller("londonCtrl", function ($scope) {
    $scope.msg = "I love London";
});
app.controller("parisCtrl", function ($scope) {
    $scope.msg = "I love Paris";
});
*/

