app.controller('repoMatriculasCtrl', function(Excel, $timeout, $scope, $http, $filter, NgTableParams) {
	
	listarAnios();
	listarCursos();
	listarParalelos();
	listarAniosLectivos();

	activarMenu();
	function activarMenu(){
		$('#matriculaMenu').addClass('active');
		$('#dropdownMenuButtonRepo').addClass('active');
	}

	//listar años desde 1900 hasta 2100
    function listarAnios(){
        $scope.anios = [];
        var contador = 0;
        for (var i = 1900; i < 2100; i++) {
            $scope.anios[contador] = i;
            contador++;
        }
    }

	//exportar tabla a formato xls
	$scope.exportToExcel=function(tableId){ // ex: '#my-table'
		$scope.exportHref=Excel.tableToExcel(tableId,'sheet name');
		$timeout(function(){location.href=$scope.exportHref;},100); // trigger download
	}

	function listarAniosLectivos(){
		if ($('#urlBuscarAniosLectivos').val() != null) {
			var url = $('#urlBuscarAniosLectivos').val();
			$http.get(url)
			.success(function(response){
				//console.log(response);
				$scope.aniosLectivos = response;
			});
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

	$scope.mensajeEstudiantes = false;
	$scope.mostrarEstudiantesPorCurso = function(){
		$scope.mensajeEstudiantes = false;
		//var nivel = $('#nivelEstudiantes').val();
		var url = $('#urlEstudiantes').val();
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$http({
			method: "post",
            url: url,
            data: 	"fechainicio_matr="+vectorAL[0]
                    +"&fechafin_matr="+vectorAL[1]
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

	$scope.mostrarEstudiantesPorCursoP = function(){
		$scope.mensajeEstudiantes = false;
		//var nivel = $('#nivelEstudiantes').val();
		var url = $('#urlEstudiantes').val();
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$http({
			method: "post",
            url: url,
            data: 	"fechainicio_matr="+vectorAL[0]
                    +"&fechafin_matr="+vectorAL[1]
					+"&id_curs="+$scope.cursoEstu
					+"&paralelo_matr="+$scope.paraleloRepo,
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
