app.controller('docenteCargoCtrl', function($scope, $http, $filter, NgTableParams) {
    //
    listarDocenteCargo();
    listarCursos();
    listarParalelos();
    listarAsginaturas();
    listarDocente();
	listarPeriodos();
	
	$scope.inicializarVariables = function(){
		$scope.docenteID = "";
		$scope.categoriaNivel = "";
		$scope.cursosID = "";
		$scope.paralelo = "";
		$scope.asignaturaID = "";
		$scope.cursoCompleto = "";
		$scope.periodoA = "";
		$scope.registroExitoso = false;
	}

    //obtener todos los periodos de la tabla
    function listarDocenteCargo() {
		
        $scope.getUrl = $('#urlDocentesCargo').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.docentesCargos = response;
                
                var contador = 0;
                if (response != null && contador == 0) {
                    angular.forEach(response, function(value, key) {
                        //alert(value['id_curs']+'-'+value['id_doce']+'-'+value['id_asig']+'-'+value['id_cargo']);
                        var idCurso = value['id_curs'];
                        var idDoce = value['id_doce'];
                        var idAsig = value['id_asig'];
                        var idCargo = value['id_cargo']
                        
                        crearListaDocentesCargos (idCurso, idDoce, idAsig, idCargo);
                        contador ++;
                    });
                }
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    $scope.docentesCargosLista = [];

    function crearListaDocentesCargos (idCurso, idDoce, idAsig, idCargo) {
		$scope.docentesCargosLista = [];
        var urlSQL = $('#urlDocentesCargoConsultaSQL').val();
         $http({
            method: "post",
            url: urlSQL,
			data: 	"id_curs="+idCurso
					+"&id_doce="+idDoce
					+"&id_asig="+idAsig
					+"&id_cargo="+idCargo,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			$scope.docentesCargosLista.push(response[0]);
			
			$scope.docenteCargoTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					apellidos_doce: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   $filter('filter')($scope.docentesCargosLista, params.filter()) : $scope.docentesCargosLista;
						
						var orderedData = params.sorting() ?
								$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.docentesCargosLista;

						params.total(orderedData.length);
                        $scope.dataAsig = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
                        return $scope.dataAsig;
                    }
					
                });
        });
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
            data:   "id_doce="+$scope.docenteID
                    +"&categoria_nivel_cargo="+$scope.categoriaNivel
                    +"&id_curs="+$scope.cursosID
                    +"&paralelo_cargo="+$scope.paralelo
                    +"&id_asig="+$scope.asignaturaID
                    +"&curso_completo_cargo="+$scope.cursoCompleto
					+"&periodo_academico_cargo="+vector[1]
					+"&anioinicio_cargo="+vectorAL[0]
					+"&aniofin_cargo="+vectorAL[1],
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
			$scope.registroExitoso = true;
			listarDocenteCargo();
			$scope.inicializarVariables();
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
        .success(function(datosP){
            console.log(datosP);
            var contador = 0;
            if (datosP != null && contador == 0) {
                angular.forEach(datosP, function(value, key) {
                    var idCurso = value['id_curs'];
                    var idDoce = value['id_doce'];
                    var idAsig = value['id_asig'];
                    var idCargo = value['id_cargo']
                    
                    consultarDatosEditar (idCurso, idDoce, idAsig, idCargo);
                    contador ++;
                });
            }
        });
    }


    function consultarDatosEditar (idCurso, idDoce, idAsig, idCargo) {
		$scope.edicionExitosa = false;
        var urlSQL = $('#urlDocentesCargoConsultaSQL').val();
        //alert(urlSQL);
         $http({
            method: "post",
            url: urlSQL,
			data: 	"id_curs="+idCurso
					+"&id_doce="+idDoce
					+"&id_asig="+idAsig
					+"&id_cargo="+idCargo,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
            $scope.docenteCargoEditar = response;
            
            //console.log(response);

            $scope.idDC =  response[0]['id_cargo'];

            $scope.nombreDocenteEdit =  response[0]['nombres_doce'] + " " + response[0]['apellidos_doce'];
            $scope.datosDocenteEdit = [
                {id: idDoce, nombre: $scope.nombreDocenteEdit}
            ];
            $scope.categoriaNivelEdit =  response[0]['categoria_nivel_cargo'];
            $scope.datosCursoEdit = [
                {id: idCurso, nombre: response[0]['nombre_curs']}
            ];
            $scope.paraleloCargoEdit =  response[0]['paralelo_cargo'];
            $scope.datosaAsignaturaEdit = [
                {id: idAsig, nombre: response[0]['nombre_asig']}
            ];
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
            data:   "id_doce="+$('#idDocente').val()
                    +"&categoria_nivel_cargo="+$scope.categoriaNivelEdit
                    +"&id_curs="+$('#idCursoCargo').val()
                    +"&paralelo_cargo="+$scope.paraleloCargoEdit
                    +"&id_asig="+$('#idAsignatura').val()
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
