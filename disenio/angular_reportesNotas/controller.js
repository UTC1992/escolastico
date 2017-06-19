app.controller('repoNotasAdminCtrl', function($scope, $http, $filter, NgTableParams) {
    listarAnios();
	listarCursos();
	listarParalelos();

	//listar años desde 1900 hasta 2100
    function listarAnios(){
        $scope.anios = [];
        var contador = 0;
        for (var i = 1900; i < 2100; i++) {
            $scope.anios[contador] = i;
            contador++;
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

	$scope.mostrarEstudiantesNotas = function(){
		$scope.getUrl = $('#urlEstudiantesMatriculados').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "cursoId="+$scope.cursoId
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			if(response.length == 0){
				$scope.mensaje = true;
				limpiarVariables();
				$scope.estudiantesMatriculados = [];
				$scope.ingresarDesactivar = false;
				
			} else {
				$scope.mensaje = false;
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, $scope.anioI, 
				$scope.anioF, $scope.parcial, $scope.quimestre);
				$scope.estudiantesMatriculados = response;
				//desaparecer el boton de envio de datos
				$scope.ingresarDesactivar = false;
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

	function llenarDatosInformativos(cursoId, paralelo, anioI, anioF, parcial, quimestre){
		//$scope.CursoInfo = cursoId;
		consultarNombreCurso(cursoId);
		$scope.ParaleloInfo = paralelo;
		$scope.anioIInfo = anioI;
		$scope.anioFInfo = anioF;
		$scope.ParcialInfo = parcial;
		$scope.QuimestreInfo = quimestre;

	}

	function limpiarVariables(){
		$scope.ParaleloInfo = "";
		$scope.anioIInfo = "";
		$scope.anioFInfo = "";
		$scope.ParcialInfo = "";
		$scope.QuimestreInfo = "";
		$scope.CursoInfo = "";
	}

	//obtener el nombre del curso para mostrar en la cabecera de la tabla de los 
	//estudiantes a los que se les ingresara las notas
	function consultarNombreCurso(cursoId) {
        var getUrl = $('#urlConsultarCurso').val();
        $http.get(getUrl+cursoId)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idCurso =  datosP[0]['id_curs'];
            $scope.CursoInfo =  datosP[0]['nombre_curs'];
        });
    }

	$scope.mensajeNotas = false;
	$scope.mostrarNotasParcial = function(){
		var idCurso = $('#idCurso').val();
		var idEstu = $('#idEstudiante').val();
		$scope.getUrl = $('#urlNotasParcial1').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "idCurso="+idCurso
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&quimestre="+$scope.QuimestreInfo
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			console.log(response);
			if(response.length == 0){
				$scope.mensajeNotas = true;
				$scope.notasParcial = [];
			} else {
				$scope.mensajeNotas = false;
				$scope.notasParcial = response;
				
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });	
	}

});
