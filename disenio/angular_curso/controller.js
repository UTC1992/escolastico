app.controller('cursoCtrl', function($scope, $http, $location, $route) {
    //activar funcion
    listarCursos();
    inicializarInput();

    //obtener todos los periodos de la tabla
    function listarCursos() {
        $scope.getUrl = $('#urlCursos').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.cursos = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    function inicializarInput(){
        $scope.nombreC = "";
    };

    $scope.mensajeInsertC = true;

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarC').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "nombre_curs="+$scope.nombreC+"&numparalelos_curs="+$scope.numParalelos,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
            $scope.mensajeInsertC = false;
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
            
            $scope.idCurso =  datosP[0]['id_curs'];
            $scope.nombreEditC =  datosP[0]['nombre_curs'];
            $scope.paralelosEditC =  datosP[0]['numparalelos_curs'];
        });
    }

     // funcion para enviar datos para actualizar periodo
    $scope.actualizar = function () {
        //alert("actulizar");
        $scope.getUrl = $('#urlActualizarC').val();
        $scope.getId = $('#idCurso').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
        $http({
            method: "post",
            url: $scope.urlActualizar,
            data: "nombre_curs="+$scope.nombreEditC+"&numparalelos_curs="+$scope.paralelosEditC,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
        }, function (error) {
                console.log(error);
        });
    }

});