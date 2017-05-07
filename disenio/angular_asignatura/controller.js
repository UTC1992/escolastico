app.controller('asignaturaCtrl', function($scope, $http, $location, $route) {
    //activar funcion
    listarAsginaturas();
    inicializarInput();

    //obtener todos los periodos de la tabla
    function listarAsginaturas() {
        $scope.getUrl = $('#urlAsignaturas').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.asignatura = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    function inicializarInput(){
        $scope.nombreA = "";
    };

    $scope.mensajeInsertA = true;

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarA').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "nombre_asig="+$scope.nombreA,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
            $scope.mensajeInsertA = false;
        }, function (error) {
                console.log(error);
        });
    }

    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
        var url = event.target.id;
        $http.get(url)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idAsignatura =  datosP[0]['id_asig'];
            $scope.nombreEditA =  datosP[0]['nombre_asig'];
        });
    }

     // funcion para enviar datos para actualizar periodo
    $scope.actualizar = function () {
        //alert("actulizar");
        $scope.getUrl = $('#urlActualizarA').val();
        $scope.getId = $('#idAsignatura').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
        $http({
            method: "post",
            url: $scope.urlActualizar,
            data: "nombre_asig="+$scope.nombreEditA,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
        }, function (error) {
                console.log(error);
        });
    }
    
});

