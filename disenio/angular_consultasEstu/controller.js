app.controller('notasEstuCtrl', function($scope, $http, $filter, NgTableParams) {
	
	listarAnios();
	
	//listar años desde 1900 hasta 2100
    function listarAnios(){
        $scope.anios = [];
        var contador = 0;
        for (var i = 1900; i < 2100; i++) {
            $scope.anios[contador] = i;
            contador++;
        }
    }
});
