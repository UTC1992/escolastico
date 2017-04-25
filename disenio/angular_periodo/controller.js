var app = angular.module('appPeriodoA', []);
app.controller('periodoMeses', function($scope) {
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
});

app.controller('periodoAnios', function($scope) {
    $scope.anios = [];
    var contador = 0;
    for (var i = 1900; i < 2100; i++) {
        $scope.anios[contador] = i;
        contador++;
    }
});
