app.controller('estudianteCtrl', function($scope, $http, $location, $route) {
    //mostrar estudiantes
    listarEstudiantes();

    //obtener todos los periodos de la tabla
    function listarEstudiantes() {
        $scope.getUrl = $('#urlEstudiantes').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.estudiantes = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

});