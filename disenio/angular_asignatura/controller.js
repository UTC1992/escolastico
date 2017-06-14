app.controller('asignaturaCtrl', function($scope, $http, $location, $route, $filter, NgTableParams) {
    //activar funcion
    listarAsginaturas();
    inicializarInput();
	$scope.personasTable;
	$scope.asignatura = [];

    //obtener todos los periodos de la tabla
    function listarAsginaturas() {
        $scope.getUrl = $('#urlAsignaturas').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.asignatura = response;
				
				$scope.personasTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					nombre_asig: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   $filter('filter')($scope.asignatura, params.filter()) : $scope.asignatura;
						
						var orderedData = params.sorting() ?
								$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.asignatura;

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
        $scope.nombreA = "";
    };

	$scope.limpiarVariables = function(){
		inicializarInput();
		$scope.mensajeInsertA = false;	
	}

    $scope.mensajeInsertA = false;

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarA').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "nombre_asig="+$scope.nombreA,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            $scope.mensajeInsertA = true;
			inicializarInput();
			listarAsginaturas();
        }, function (error) {
                console.log(error);
        });
    }

    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
		$scope.mensajeActualizar = false;
        var url = event.target.id;
        $http.get(url)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idAsignatura =  datosP[0]['id_asig'];
            $scope.nombreEditA =  datosP[0]['nombre_asig'];
        });
    }

     // funcion para enviar datos para actualizar periodo
	 $scope.mensajeActualizar = false;
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
            $scope.mensajeActualizar = true;
			inicializarInput();
			listarAsginaturas();
        }, function (error) {
                console.log(error);
        });
    }
    
});

