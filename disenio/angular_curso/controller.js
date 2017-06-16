app.controller('cursoCtrl', function($scope, $http, $location, $route, $filter, NgTableParams) {
    //activar funcion
    listarCursos();
    inicializarInput();

	activarMenu();
	function activarMenu(){
		$('#cursosMenu').addClass('active');
		$('#dropdownMenuButtonTablas').addClass('active');
	}

    //obtener todos los periodos de la tabla
    function listarCursos() {
        $scope.getUrl = $('#urlCursos').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.cursos = response;

				$scope.cursosTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					id_curs: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   	$filter('filter')($scope.cursos, params.filter()) : $scope.cursos;

                        var orderedData = params.sorting() ?
							$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.cursos;

						params.total(orderedData.length);
                        $scope.dataAsig = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
                        return $scope.dataAsig;
                    }
					
                });
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

	$scope.limpiarVariables = function(){
		inicializarInput();
		$scope.mensajeInsertC = false;
	}

    $scope.mensajeInsertC = false;
    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarC').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "nombre_curs="+$scope.nombreC+"&numparalelos_curs="+$scope.numParalelos,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            inicializarInput();
            $scope.mensajeInsertC = true;
			listarCursos();
        }, function (error) {
                console.log(error);
        });
    }

     // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
		$scope.actualizarMensaje = false;
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
	$scope.actualizarMensaje = false;
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
            $scope.actualizarMensaje = true;
			listarCursos();
        }, function (error) {
                console.log(error);
        });
    }

//////////////////////////////////////////////////////////////////////////////////////////////7

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
