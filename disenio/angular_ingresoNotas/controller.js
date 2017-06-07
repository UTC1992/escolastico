app.controller('notasIngresoCtrl', function($scope, $http) {
	listarAnios();
	listarCursos();
	listarParalelos();
	listarAsginaturas();

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

	$scope.mensaje = false;

	$scope.mostrarEstudiantes = function(){
		$scope.mensajeIngreso = false;
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
				$scope.estudiantesMatriculados = response;
				
			} else {
				$scope.mensaje = false;
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, $scope.anioI, 
				$scope.anioF, $scope.materia, $scope.parcial, $scope.quimestre);
				$scope.estudiantesMatriculados = response;
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

	function llenarDatosInformativos(cursoId, paralelo, anioI, anioF, materia, parcial, quimestre){
		//$scope.CursoInfo = cursoId;
		consultarNombreCurso(cursoId);
		$scope.ParaleloInfo = paralelo;
		$scope.anioIInfo = anioI;
		$scope.anioFInfo = anioF;
		$scope.MateriaInfo = materia;
		$scope.ParcialInfo = parcial;
		$scope.QuimestreInfo = quimestre;

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

	$scope.mostrarDatos = function(){
		var notas = document.getElementsByName('notaE');
		for(var i = 0; i < notas.length; i+=5){
			/*alert(notas[i].value + " - " 
					+ notas[i+1].value + " - "
					+ notas[i+2].value+ " - " 
					+ notas[i+3].value + "-" 
					+ notas[i+4].value);
					*/
			var idEstu = notas[i].value;
			var deberes = notas[i+1].value;
			var lecciones = notas[i+2].value;
			var trabajos = notas[i+3].value;
			var investigacion = notas[i+4].value;
			var parcial = $scope.parcial+"";

			switch (parcial) {
			case '1ero':
				$scope.getUrl = $('#urlIngresarNotasParcial1').val();
				ingresarNotasParcial(idEstu, deberes, lecciones, trabajos, investigacion, $scope.getUrl);
				break;
			case '2do':
				$scope.getUrl = $('#urlIngresarNotasParcial2').val();
				ingresarNotasParcial(idEstu, deberes, lecciones, trabajos, investigacion, $scope.getUrl);
				break;
			case '3ero':
				$scope.getUrl = $('#urlIngresarNotasParcial3').val();
				ingresarNotasParcial(idEstu, deberes, lecciones, trabajos, investigacion, $scope.getUrl);
				break;
		
			default:
				alert("No hay parcial");
				break;
			}
		}
	}
	
	$scope.mensajeIngreso = false;
	function ingresarNotasParcial(idEstu, deberes, lecciones, trabajos, investigacion, urlIngresoNotas){
		//alert(idEstu + " - "+ deberes + " - "+ lecciones+ " - " + trabajos + "-"+ investigacion);
		$scope.mostrarCargando = true;
		//alert($scope.getUrl);
		$http({
            method: "post",
            url: urlIngresoNotas,
            data:   "parametro1="+deberes
                    +"&parametro2="+lecciones
                    +"&parametro3="+trabajos
                    +"&parametro4="+investigacion
					+"&quimestre="+$scope.QuimestreInfo
					+"&asignatura="+$scope.MateriaInfo
					+"&anioInicio="+$scope.anioIInfo
					+"&anioFin="+$scope.anioFInfo
					+"&id_estu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
				$scope.estudiantesMatriculados = [];
				$scope.mensajeIngreso = true;
				//console.log("exito");
        }, function (error) {
                console.log(error);
				$scope.mensajeIngreso = false;
        });

		$scope.mostrarCargando = false;
	}

	$scope.mostrarDatosInformes = function(){
		$scope.mensajeIngreso = false;
		var parcial = $scope.parcial+"";
		
		switch (parcial) {
			case '1ero':
				$scope.getUrl = $('#urlInformes1').val();
				consultarParcial($scope.getUrl);
				break;
			case '2do':
				$scope.getUrl = $('#urlInformes2').val();
				consultarParcial($scope.getUrl);
				break;
			case '3ero':
				$scope.getUrl = $('#urlInformes2').val();
				consultarParcial($scope.getUrl);
				break;
		
			default:
				alert("No hay parcial");
				break;
		}

	}

	function consultarParcial(urlInforme){
		$scope.mensajeIngreso = false;
        $http({
            method: "post",
            url: urlInforme,
            data:   "cursoId="+$scope.cursoId
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&materia="+$scope.materia
					+"&quimestre="+$scope.quimestre,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			if(response.length == 0){
				$scope.mensaje = true;
				limpiarVariables();
				$scope.estudiantesInformes = response;
			} else {
				$scope.mensaje = false;
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, $scope.anioI, 
				$scope.anioF, $scope.materia, $scope.parcial, $scope.quimestre);
				$scope.estudiantesInformes = response;
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

	
	function limpiarVariables(){
		$scope.ParaleloInfo = "";
		$scope.anioIInfo = "";
		$scope.anioFInfo = "";
		$scope.MateriaInfo = "";
		$scope.ParcialInfo = "";
		$scope.QuimestreInfo = "";
		$scope.CursoInfo = "";
	}

});
