app.controller('notasEstuCtrl', function($scope, $http, $filter, NgTableParams) {
	
	listarAnios();
	listarAniosLectivos();

	//listar años desde 1900 hasta 2100
    function listarAnios(){
        $scope.anios = [];
        var contador = 0;
        for (var i = 1900; i < 2100; i++) {
            $scope.anios[contador] = i;
            contador++;
        }
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

	$scope.buscarMatricula = function(){
		//datos del select anños lectivos
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];

		var urlMatricula = $('#urlBuscarMatricula').val();
		var idEstu = $('#idEstudiante').val();
		$http({
            method: "post",
            url: urlMatricula,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			$scope.verificarParcial(response);
        }, function (error) {
                console.log(error);
        });	
	}

	$scope.verificarParcial = function(response){
		
		$scope.mensajeNotas = false;
		var parcial = $scope.parcial+"";
		//alert(parcial+idParcial);
		switch (parcial) {
			case '1ero':
				$scope.getUrl = $('#urlNotasParcial1').val();
				$scope.mostrarNotasParcial($scope.getUrl, response);
				break;
			case '2do':
				$scope.getUrl = $('#urlNotasParcial2').val();
				$scope.mostrarNotasParcial($scope.getUrl, response);
				break;
			case '3ero':
				$scope.getUrl = $('#urlNotasParcial3').val();
				$scope.mostrarNotasParcial($scope.getUrl, response);
				break;
		
			default:
				alert("No hay parcial");
				break;
		}
	}

	$scope.mensajeNotas = false;
	$scope.mostrarNotasParcial = function(urlParcial, response){
		var idCurso = response[0]['id_curs'];
		var paralelo = response[0]['paralelo_matr'];

		var idEstu = $('#idEstudiante').val();
        $http({
            method: "post",
            url: urlParcial,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idCurso="+idCurso
					+"&paralelo="+paralelo
					+"&quimestre="+$scope.quimestre
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
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

	////////////////////QUIMESTRE
	$scope.buscarMatriculaQuimestre = function(){
		//datos del select anños lectivos
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];

		var urlMatricula = $('#urlBuscarMatricula').val();
		var idEstu = $('#idEstudiante').val();
		$http({
            method: "post",
            url: urlMatricula,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			$scope.buscarNotasQuimestrales(response);
        }, function (error) {
                console.log(error);
        });	
	}

	$scope.mensajeNotas = false;
	$scope.buscarNotasQuimestrales = function(response){
		var idCurso = response[0]['id_curs'];
		var paralelo = response[0]['paralelo_matr'];

		var idEstu = $('#idEstudiante').val();
		var urlParcial = $('#urlNotasQuimestre').val();
        $http({
            method: "post",
            url: urlParcial,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idCurso="+idCurso
					+"&paralelo="+paralelo
					+"&quimestre="+$scope.quimestre
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
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
