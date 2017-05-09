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

     // obtener id curso para añadir nueva asignatura al curso presente
    $scope.obtenerIdCurso = function (event) {
        var id = event.target.id;
        $('#idCursoNewA').val(id);
        var name = event.target.name;
        $scope.nombreCurso = name;

        listarAsignaturas();
    }

    //obtener todos las asignaturas para llenar el select
    function listarAsignaturas() {
        $scope.getUrl = $('#urlNewAsigCurso').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.asignaturas = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    //$scope.mensajeInsertAC = true;
    //registrar una nueva asignatura alcurso indicado
    $scope.nuevaAsigCurso = function () {
        $scope.getUrl = $('#urlInsertarAsigCurso').val();
        $scope.idCurs = $('#idCursoNewA').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "id_curs="+$scope.idCurs+"&id_asig="+$scope.idAsig,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
            //$scope.mensajeInsertAC = false;
        }, function (error) {
                console.log(error);
        });
    }

     $scope.obtenerIdCursoAsig = function (event) {
        var id = event.target.id;
        var name = event.target.name;
        $scope.nombreCurso = name;

        listarAsignaturasCurso( id );
    }

    //obtener la signaturas que se encuentran añadidas a un curso especifico
    function listarAsignaturasCurso( id ) {
        $scope.getUrl = $('#urlAsigCurso').val();
        $scope.urlFinal = $scope.getUrl + "/" + id;
        //alert($scope.urlFinal);
        if ($scope.urlFinal != null) {
            $http.post($scope.urlFinal)
            .success(function(response){
                $scope.asignaturasCurso = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    $scope.eliminarAsignaturaDeCurso = function (event) {
        $scope.urlEliminarAC = event.target.id;
        //alert($scope.urlEliminarAC);
        if ($scope.urlEliminarAC != null) {
            $http.post($scope.urlEliminarAC)
            .success(function(response){
                window.location.reload(false);
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

});