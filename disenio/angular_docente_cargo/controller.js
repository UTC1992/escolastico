app.controller('docenteCargoCtrl', function($scope, $http, $filter, NgTableParams) {
    //
    listarDocenteCargo();
    listarCursos();
    listarParalelos();
    listarAsginaturas();
    listarDocente();
	listarPeriodos();
	
	$scope.inicializarVariablesDatos = function(){
		$scope.docente = "";
		$scope.categoriaNivel = "";
		$scope.cursoNombre = "";
		$scope.paralelo = "";
		$scope.nombreAsig = "";
		$scope.cursoCompleto = "";
		$scope.periodoA = "";
	}

	$scope.inicializarVariables = function(){
		$scope.registroExitoso = false;
	}

    //obtener todos los periodos de la tabla
    function listarDocenteCargo() {
		
        $scope.getUrl = $('#urlDocentesCargo').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
				$scope.docentesCargos = response;
				
                $scope.docenteCargoTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					docente_cargo: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   $filter('filter')($scope.docentesCargos, params.filter()) : $scope.docentesCargos;
						
						var orderedData = params.sorting() ?
								$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.docentesCargos;

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
    
    //obtener todos los periodos de la tabla
    function listarDocente () {
        $scope.getUrl = $('#urlDocentes').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.docentes = response;
                //listarCursos();
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

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

    function listarParalelos(){
        $scope.paralelos = [
            'A', 'B', 'C',
            'D', 'E', 'F',
            'G', 'H', 'I',
            'J'
        ];
    }

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

     // declaro la función enviar
	
	$scope.registroExitoso = false;
	 $scope.registrarNuevo = function () {
		
		//anio lectivo
		var vector = $scope.periodoA.split("/");
		var vectorAL = vector[0].split("-");

        $scope.getUrl = $('#urlInsertarDC').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "docente_cargo="+$scope.docente
                    +"&categoria_nivel_cargo="+$scope.categoriaNivel
                    +"&curso_cargo="+$scope.cursoNombre
                    +"&paralelo_cargo="+$scope.paralelo
                    +"&asignatura_cargo="+$scope.nombreAsig
                    +"&curso_completo_cargo="+$scope.cursoCompleto
					+"&periodo_academico_cargo="+vector[1]
					+"&anioinicio_cargo="+vectorAL[0]
					+"&aniofin_cargo="+vectorAL[1],
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
			$scope.registroExitoso = true;
			listarDocenteCargo();
			$scope.inicializarVariablesDatos();
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
    }

    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
		$scope.edicionExitosa = false;
        var url = event.target.id;
        //alert(url);
        $http.get(url)
        .success(function(response){
            $scope.idDC =  response[0]['id_cargo'];
			
			$scope.docenteEdit = response[0]['docente_cargo'];
			$scope.categoriaNivelEdit =  response[0]['categoria_nivel_cargo'];
			$scope.cursoEdit = response[0]['curso_cargo'];
			$scope.paraleloCargoEdit =  response[0]['paralelo_cargo'];
			$scope.asignaturaEdit = response[0]['asignatura_cargo'];
            $scope.cursoCompletoEdit =  response[0]['curso_completo_cargo'];
            $scope.periodoAcademicoEdit =  response[0]['periodo_academico_cargo'];
        });
    }

	$scope.edicionExitosa = false;
    $scope.actualizarDocenteCardo = function (){

        $scope.getUrl = $('#urlActualizarDC').val();
        $scope.getId = $('#idDC').val();
		$scope.urlActualizar = $scope.getUrl + $scope.getId;
		
		//anio lectivo
		var vectorAL = $scope.periodoAcademicoEdit.split("-");
		//var vectorAL = vector[0].split("-");

        $http({
            method: "post",
            url: $scope.urlActualizar,
            data:   "docente_cargo="+$scope.docenteEdit
                    +"&categoria_nivel_cargo="+$scope.categoriaNivelEdit
                    +"&curso_cargo="+$scope.cursoEdit
                    +"&paralelo_cargo="+$scope.paraleloCargoEdit
                    +"&asignatura_cargo="+$scope.asignaturaEdit
                    +"&curso_completo_cargo="+$scope.cursoCompletoEdit
                    +"&periodo_academico_cargo="+$scope.periodoAcademicoEdit
					+"&anioinicio_cargo="+vectorAL[1]
					+"&aniofin_cargo="+vectorAL[3],
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
			$scope.edicionExitosa = true;
            listarDocenteCargo();
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });

    }


});
