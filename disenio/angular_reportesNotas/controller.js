app.controller('repoNotasAdminCtrl', function($scope, $http, $filter, NgTableParams) {
    listarAnios();
	listarCursos();
	listarParalelos();
	listarAniosLectivos();

	activarMenu();
	function activarMenu(){
		$('#notasMenu').addClass('active');
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

	$scope.mostrarEstudiantesNotas = function(){
		$scope.getUrl = $('#urlEstudiantesMatriculados').val();
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "cursoId="+$scope.cursoId
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+vectorAL[0]
                    +"&anioF="+vectorAL[1],
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			if(response.length == 0){
				$scope.mensaje = true;
				limpiarVariables();
				$scope.estudiantesMatriculados = [];
				$scope.ingresarDesactivar = false;
				
			} else {
				$scope.mensaje = false;
				var anioslectivos = $scope.aniosL+"";
				var vectorAL = anioslectivos.split('-');
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, vectorAL[0], 
				vectorAL[1], $scope.parcial, $scope.quimestre);
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

	$scope.verificarParcial = function(){
		$scope.mensajeNotas = false;
		var parcial = $scope.parcial+"";
		//alert(parcial+idParcial);
		switch (parcial) {
			case '1ero':
				$scope.getUrl = $('#urlNotasParcial1').val();
				$scope.mostrarNotasParcial($scope.getUrl);
				break;
			case '2do':
				$scope.getUrl = $('#urlNotasParcial2').val();
				$scope.mostrarNotasParcial($scope.getUrl);
				break;
			case '3ero':
				$scope.getUrl = $('#urlNotasParcial3').val();
				$scope.mostrarNotasParcial($scope.getUrl);
				break;
		
			default:
				alert("No hay parcial");
				break;
		}
	}


	$scope.mensajeNotas = false;
	$scope.mostrarNotasParcial = function(urlParcial){
		var idCurso = $('#idCurso').val();
		var idEstu = $('#idEstudiante').val();
		//$scope.getUrl = $('#urlNotasParcial1').val();

		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
        $http({
            method: "post",
            url: urlParcial,
            data:   "idCurso="+idCurso
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+vectorAL[0]
                    +"&anioF="+vectorAL[1]
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
////////////////////////QUIMESTRALES
	$scope.verificarQuimestre = function(event){
		var idEstuYCurso = event.target.id;
		var vector = idEstuYCurso.split("/");
		var idCurso = vector[0];
		var idEstu = vector[1];

		$scope.mensajeNotas = false;
		var quimestre = $scope.QuimestreInfo+"";
		//alert(parcial+idParcial);
		
		switch (quimestre) {
			case '1ero':
				$scope.getUrl = $('#urlNotasQuimestre').val();
				$scope.mostrarNotasQuimestre($scope.getUrl, idCurso, idEstu);
				break;
			case '2do':
				$scope.getUrl = $('#urlNotasQuimestre').val();
				$scope.mostrarNotasQuimestre($scope.getUrl, idCurso, idEstu)
				break;
		
			default:
				alert("No hay parcial");
				break;
		}
	}

	$scope.mensajeNotas = false;
	$scope.mostrarNotasQuimestre = function(urlQime, idCurso, idEstu){

		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');

        $http({
            method: "post",
            url: urlQime,
            data:   "idCurso="+idCurso
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+vectorAL[0]
                    +"&anioF="+vectorAL[1]
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

	////////////////////////QUIMESTRALES
	$scope.verificarNotasFinales = function(event){
		var idEstuYCurso = event.target.id;
		var vector = idEstuYCurso.split("/");
		var idCurso = vector[0];
		var idEstu = vector[1];

		$scope.mensajeNotas = false;
		$scope.getUrl = $('#urlNotasAnual').val();
		$scope.mostrarNotasFinales($scope.getUrl, idCurso, idEstu);
	}

	$scope.mensajeNotas = false;
	$scope.mostrarNotasFinales = function(urlNotaFinal, idCurso, idEstu){
        $http({
            method: "post",
            url: urlNotaFinal,
            data:   "idCurso="+idCurso
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
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
