app.controller('repoMatriculasCtrl', function($scope, $http, $filter, NgTableParams) {
	
	listarAnios();
	listarCursos();

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

	$scope.mensajeEstudiantes = false;
	$scope.mostrarEstudiantesPorCurso = function(){
		$scope.mensajeEstudiantes = false;
		//var nivel = $('#nivelEstudiantes').val();
		var url = $('#urlEstudiantes').val();
		$http({
			method: "post",
            url: url,
            data: 	"fechainicio_matr="+$scope.anioInicio
                    +"&fechafin_matr="+$scope.anioFin
					+"&id_curs="+$scope.cursoEstu,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			if (response.length != 0) {
				$scope.datosMatri = response;
				$scope.mensajeEstudiantes = false;
			} else {
				$scope.datosMatri = [];
				$scope.mensajeEstudiantes = true;
			}
	
		}, function (error) {
			console.log(error);
			
		});
	}

});
