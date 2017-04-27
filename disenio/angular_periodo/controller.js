var app = angular.module('appPeriodoA', []);
app.controller('periodoAcademicoDatos', function($scope, $http) {
    //listar meses
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

    //listar años desde 1900 hasta 2100
    $scope.anios = [];
    var contador = 0;
    for (var i = 1900; i < 2100; i++) {
        $scope.anios[contador] = i;
        contador++;
    }

    //obtener datos de un determinado periodo dependiendo del url obtenido desde la vista
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
});

//se pretende obtener todos los datos de la tabla periodo_academico para crear una tabla en la vista
app.controller('mostrarPeriodos', function($scope, $http) {
    $scope.getUrl = $('#url').val();
    if ($scope.getUrl != null) {
        $http.get($scope.getUrl)
        .success(function(datosP){
            $scope.listaP = datosP;
        });
    } else {
        $scope.mensaje = "No existen datos por el momento.";
    }
});