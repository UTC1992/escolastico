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
				$scope.notasParcial = [];

				for (var i = 0; i < response.length; i++) {
					var comportaLetras = '';
					if( (parseFloat(response[i].comporta) >=9) && (parseFloat(response[i].comporta) <= 10) ){
						comportaLetras = 'A';
					}
					if( (parseFloat(response[i].comporta) >=6) && (parseFloat(response[i].comporta) <= 8) ){
						comportaLetras = 'B';
					}
					if( (parseFloat(response[i].comporta) >=4) && (parseFloat(response[i].comporta) <= 5) ){
						comportaLetras = 'C';
					}
					if( (parseFloat(response[i].comporta) >=1) && (parseFloat(response[i].comporta) <= 3) ){
						comportaLetras = 'D';
					}

					response[i].comporLetra = comportaLetras;
					$scope.notasParcial.push(response[i]);	
				}
				
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
				$scope.notasParcial = [];

				for (var i = 0; i < response.length; i++) {
					var comportaLetras = '';
					if( (parseFloat(response[i].comporta) >=9) && (parseFloat(response[i].comporta) <= 10) ){
						comportaLetras = 'A';
					}
					if( (parseFloat(response[i].comporta) >=6) && (parseFloat(response[i].comporta) <= 8) ){
						comportaLetras = 'B';
					}
					if( (parseFloat(response[i].comporta) >=4) && (parseFloat(response[i].comporta) <= 5) ){
						comportaLetras = 'C';
					}
					if( (parseFloat(response[i].comporta) >=1) && (parseFloat(response[i].comporta) <= 3) ){
						comportaLetras = 'D';
					}

					response[i].comporLetra = comportaLetras;
					$scope.notasParcial.push(response[i]);	
				}
				
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });	
	}

	//////////ANUAL
	$scope.buscarMatriculaAnual = function(){
		$scope.notasParcial = [];
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
			buscarAsignaturasDeCurso(response[0].id_curs, response[0].id_estu, response[0].paralelo_matr);
        }, function (error) {
                console.log(error);
        });	
	}

////////////////////////ANUALES OBTENER NOTAS
	$scope.verificarNotasFinales = function(event){
		$scope.notasParcial = [];
		var idEstuYCurso = event.target.id;
		var vector = idEstuYCurso.split("/");
		var idCurso = vector[0];
		var idEstu = vector[1];

		//año lectivo
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];

		buscarAsignaturasDeCurso(idCurso, idEstu);

	}

	function buscarAsignaturasDeCurso(idCurso, idEstu, paraleloMatri){
		var urlAsig = $('#urlAsignaturasCurso').val();
		$http({
            method: "post",
            url: urlAsig,
            data:   "idCurso="+idCurso,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			console.log(response);
			for (var i = 0; i < response.length; i++) {
				//alert(response[i]['asig']);
				var asignatura = response[i]['asig'];
				//alert(idCurso +" - " + idEstu + " - " + asignatura);
				$scope.mostrarNotasFinales(idCurso, idEstu, asignatura, paraleloMatri);
			}

        }, function (error) {
                console.log(error);
        });
	}

	$scope.mensajeNotas = false;
	$scope.notasParcial = [];
	$scope.suple = '';
	$scope.mostrarNotasFinales = function(idCurso, idEstu, asignatura, paraleloMatri){
		var urlNotaFinalAsig = $('#urlNotasAnual').val();
		$scope.suple = '';
        $http({
            method: "post",
            url: urlNotaFinalAsig,
            data:   "idCurso="+idCurso
                    +"&paralelo="+paraleloMatri
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			if(response.length == 0){
				$scope.mensajeNotas = true;
				
				
			} else {
				if (response.length > 0) {
					//añadir un elemento en el interior de un array en un elemento JSON
					//response[0].mejora = 'hola';
					
					obtenerNotaMejora($scope.anioI, $scope.anioF, idEstu, asignatura, response);
					
					$scope.mensajeNotas = false;
					//$scope.notasParcial.push(response[0]);
					
				}
			}

        }, function (error) {
                console.log(error);
        });	
	}

	function obtenerNotaMejora(anioI, anioF, idEstu, asignatura, datosMejora){
		var urlNotaSuple = $('#urlNotasMejora').val();
        
		$http({
            method: "post",
            url: urlNotaSuple,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			if(response.length == 0){
					datosMejora[0].mejora = 0;
					obtenerNotaSupletorio(anioI, anioF, idEstu, asignatura, datosMejora);
			} else {
				if (response.length > 0) {
					//se asigna el valor a la variable suple de scope para mostrar en la tabla

					datosMejora[0].mejora = response[0].nota_mejo;
					//se ingresa al json el valor de la nota de supletorio
					//$scope.notasParcial.push(datos[0]);

					obtenerNotaSupletorio(anioI, anioF, idEstu, asignatura, datosMejora);
				}	
			}
        }, function (error) {
                console.log(error);
        });
		
		
	}
	
	function obtenerNotaSupletorio(anioI, anioF, idEstu, asignatura, datosSuple){
		var urlNotaSuple = $('#urlNotasSuple').val();
        
		$http({
            method: "post",
            url: urlNotaSuple,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			if(response.length == 0){
					datosSuple[0].suple = 0;
					obtenerNotaRemedial(anioI, anioF, idEstu, asignatura, datosSuple);
			} else {
				if (response.length > 0) {
					//se asigna el valor a la variable suple de scope para mostrar en la tabla

					datosSuple[0].suple = response[0].nota_suple;
					//se ingresa al json el valor de la nota de supletorio
					//$scope.notasParcial.push(datosSuple[0]);

					obtenerNotaRemedial(anioI, anioF, idEstu, asignatura, datosSuple);
				}	
			}
        }, function (error) {
                console.log(error);
        });
		
		
	}

	function obtenerNotaRemedial(anioI, anioF, idEstu, asignatura, datosRemedial){
		var urlNotaSuple = $('#urlNotasRemedial').val();
        
		$http({
            method: "post",
            url: urlNotaSuple,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			if(response.length == 0){
					datosRemedial[0].remedial = 0;
					obtenerNotaGracia(anioI, anioF, idEstu, asignatura, datosRemedial);
			} else {
				if (response.length > 0) {
					//se asigna el valor a la variable suple de scope para mostrar en la tabla

					datosRemedial[0].remedial = response[0].nota_reme;
					//se ingresa al json el valor de la nota de supletorio
					//$scope.notasParcial.push(datosRemedial[0]);

					obtenerNotaGracia(anioI, anioF, idEstu, asignatura, datosRemedial);
				}	
			}
        }, function (error) {
                console.log(error);
        });
	}

	function obtenerNotaGracia(anioI, anioF, idEstu, asignatura, datosGracia){
		var urlNotaSuple = $('#urlNotasGracia').val();
        
		$http({
            method: "post",
            url: urlNotaSuple,
            data:   "&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			if(response.length == 0){
					datosGracia[0].gracia = 0;
					//sacar el promedio
					var promedio = 0;
					if(parseFloat(datosGracia[0].Q1) > 0 && parseFloat(datosGracia[0].Q2) > 0){
						promedio = (parseFloat(datosGracia[0].Q1) + parseFloat(datosGracia[0].Q2)) / 2;
					}
					datosGracia[0].promedio1 = promedio.toFixed(2);

					var subPromedio = 0;
					//onbtener promedio al calcularlo con la nota de mejora
					if(parseFloat(datosGracia[0].mejora) > 0){
						if(parseFloat(datosGracia[0].Q1) < parseFloat(datosGracia[0].Q2) ){
							subPromedio = (parseFloat(datosGracia[0].Q1) + parseFloat(datosGracia[0].mejora)) / 2;
							subPromedio = (subPromedio + parseFloat(datosGracia[0].Q2) ) / 2;
						} else {
							subPromedio = (parseFloat(datosGracia[0].Q2) + parseFloat(datosGracia[0].mejora)) / 2;
							subPromedio = (subPromedio + parseFloat(datosGracia[0].Q1) ) / 2;
						}
					}
					//calcular nota suple
					if(parseFloat(datosGracia[0].suple) > 0){
						if(parseFloat(datosGracia[0].suple) >= 7){
							subPromedio = 7;
						}
					}
					//calcular nota remedial
					if(parseFloat(datosGracia[0].remedial) > 0){
						if(parseFloat(datosGracia[0].remedial) >= 7){
							subPromedio = 7;
						}
					}
					//calcular nota gracia
					if(parseFloat(datosGracia[0].gracia) > 0){
						if(parseFloat(datosGracia[0].gracia) >= 7){
							subPromedio = 7;
						}
					}
					//calculando equivalencias de comportamiento
					var comportaLetras = '';
					if( (parseFloat(datosGracia[0].comportaF) >=9) && (parseFloat(datosGracia[0].comportaF) <= 10) ){
						comportaLetras = 'A';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=6) && (parseFloat(datosGracia[0].comportaF) <= 8) ){
						comportaLetras = 'B';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=4) && (parseFloat(datosGracia[0].comportaF) <= 5) ){
						comportaLetras = 'C';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=1) && (parseFloat(datosGracia[0].comportaF) <= 3) ){
						comportaLetras = 'D';
					}

					datosGracia[0].comporLetra = comportaLetras;
					datosGracia[0].promedioFinal = subPromedio.toFixed(2);
					$scope.notasParcial.push(datosGracia[0]);
			} else {
				if (response.length > 0) {
					//se asigna el valor a la variable suple de scope para mostrar en la tabla
					datosGracia[0].gracia = response[0].nota_gra;
					var promedio = 0;
					if(parseFloat(datosGracia[0].Q1) > 0 && parseFloat(datosGracia[0].Q2) > 0){
						promedio = (parseFloat(datosGracia[0].Q1) + parseFloat(datosGracia[0].Q2)) / 2;
					}
					datosGracia[0].promedio1 = promedio.toFixed(2);

					var subPromedio = 0;
					//onbtener promedio al calcularlo con la nota de mejora
					if(parseFloat(datosGracia[0].mejora) > 0){
						if(parseFloat(datosGracia[0].Q1) < parseFloat(datosGracia[0].Q2) ){
							subPromedio = (parseFloat(datosGracia[0].Q1) + parseFloat(datosGracia[0].mejora)) / 2;
							subPromedio = (subPromedio + parseFloat(datosGracia[0].Q2) ) / 2;
						} else {
							subPromedio = (parseFloat(datosGracia[0].Q2) + parseFloat(datosGracia[0].mejora)) / 2;
							subPromedio = (subPromedio + parseFloat(datosGracia[0].Q1) ) / 2;
						}
					}
					//calcular nota suple
					if(parseFloat(datosGracia[0].suple) > 0){
						if(parseFloat(datosGracia[0].suple) >= 7){
							subPromedio = 7;
						}
					}
					//calcular nota remedial
					if(parseFloat(datosGracia[0].remedial) > 0){
						if(parseFloat(datosGracia[0].remedial) >= 7){
							subPromedio = 7;
						}
					}
					//calcular nota gracia
					if(parseFloat(datosGracia[0].gracia) > 0){
						if(parseFloat(datosGracia[0].gracia) >= 7){
							subPromedio = 7;
						}
					}
					//calculando equivalencias de comportamiento
					var comportaLetras = '';
					if( (parseFloat(datosGracia[0].comportaF) >=9) && (parseFloat(datosGracia[0].comportaF) <= 10) ){
						comportaLetras = 'A';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=6) && (parseFloat(datosGracia[0].comportaF) <= 8) ){
						comportaLetras = 'B';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=4) && (parseFloat(datosGracia[0].comportaF) <= 5) ){
						comportaLetras = 'C';
					}
					if( (parseFloat(datosGracia[0].comportaF) >=1) && (parseFloat(datosGracia[0].comportaF) <= 3) ){
						comportaLetras = 'D';
					}

					datosGracia[0].comporLetra = comportaLetras;
					datosGracia[0].promedioFinal = subPromedio.toFixed(2);
					//se ingresa al json el valor de la nota de supletorio
					$scope.notasParcial.push(datosGracia[0]);
					
				}	
			}
        }, function (error) {
                console.log(error);
        });
	}

});
