app.controller('repoNotasAdminCtrl', function(Excel, $timeout, $scope, $http, $filter, NgTableParams) {
    listarAnios();
	listarCursos();
	listarParalelos();
	listarAniosLectivos();

	activarMenu();
	function activarMenu(){
		$('#notasMenu').addClass('active');
		$('#dropdownMenuButtonRepo').addClass('active');
	}

	//exportar tabla a formato xls
	$scope.exportToExcel=function(tableId){ // ex: '#my-table'
		$scope.exportHref=Excel.tableToExcel(tableId,'sheet name');
		$timeout(function(){location.href=$scope.exportHref;},100); // trigger download
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
            
			llenarBoletin(vectorAL[0], vectorAL[1], idEstu);

            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });	
	}

	function llenarBoletin(anioI, anioF, idEstu){

		var urlDatosMatri = $('#urlDatosBoletin').val();
		$http({
            method: "post",
            url: urlDatosMatri,
            data:   "&anioI="+anioI
                    +"&anioF="+anioF
					+"&idEstu="+idEstu,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			
			var nombreEstu = response[0]['apellidos_estu'] + " " + response[0]['nombres_estu']; 
			$scope.cadete = nombreEstu.toUpperCase();
			var cursoPa = response[0]['nombre_curs'] + " / " + response[0]['paralelo_matr'];
			$scope.cursoParalelo = cursoPa.toUpperCase();
			$scope.cedula = response[0]['cedula_estu'];
			$scope.anioLectivo = response[0]['fechainicio_matr'] + " / " + response[0]['fechafin_matr'];
			$scope.especialidad = "NINGUNA ESPECIALIDAD";
			$scope.nivel = response[0]['nivel_matr'].toUpperCase();
			$scope.fechaActual = obtenerFechaActual();
			$scope.periodo = verificarQuimestreBoletin();

        }, function (error) {
                console.log(error);
        });
	}

	function obtenerFechaActual(){
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var date = new Date();
        var fechaA = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        return fechaA;
    }

	function verificarQuimestreBoletin (){
		var quimestre = $scope.QuimestreInfo+"";
		var periodo = "";
		switch (quimestre) {
			case '1ero':
				periodo = 'PRIMER QUIMESTRE';
				break;
			case '2do':
				periodo = 'SEGUNDO QUIMESTRE';
				break;
		
			default:
				periodo = 'N/A';
				break;
		}
		return periodo;
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

			llenarBoletin(vectorAL[0], vectorAL[1], idEstu);
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });	
	}

	////////////////////////ANUALES
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

	function buscarAsignaturasDeCurso(idCurso, idEstu){
		var urlAsig = $('#urlAsignaturasCurso').val();
		$http({
            method: "post",
            url: urlAsig,
            data:   "idCurso="+idCurso,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			for (var i = 0; i < response.length; i++) {
				//alert(response[i]['asig']);
				var asignatura = response[i]['asig'];
				//alert(idCurso +" - " + idEstu + " - " + asignatura);
				$scope.mostrarNotasFinales(idCurso, idEstu, asignatura);
			}

			setTimeout(function(){
				$scope.$apply(function () {
					$scope.promedioGLobal();
				});
			},3000,"JavaScript");

        }, function (error) {
                console.log(error);
        });
	}

	$scope.mensajeNotas = false;
	$scope.notasParcial = [];
	$scope.suple = '';
	$scope.mostrarNotasFinales = function(idCurso, idEstu, asignatura){
		var urlNotaFinalAsig = $('#urlNotasAnual').val();
		$scope.suple = '';
        $http({
            method: "post",
            url: urlNotaFinalAsig,
            data:   "idCurso="+idCurso
                    +"&paralelo="+$scope.ParaleloInfo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&idEstu="+idEstu
					+"&asignatura="+asignatura,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			console.log(response);
			if(response.length == 0){
				$scope.mensajeNotas = true;
				obtenerNotaMejora($scope.anioI, $scope.anioF, idEstu, asignatura, response);
				
			} else {
				if (response.length > 0) {
					//añadir un elemento en el interior de un array en un elemento JSON
					//response[0].mejora = 'hola';
					
					obtenerNotaMejora($scope.anioI, $scope.anioF, idEstu, asignatura, response);
					
					$scope.mensajeNotas = false;
					//$scope.notasParcial.push(response[0]);
					
				}
			}
			llenarBoletin($scope.anioI, $scope.anioF, idEstu);

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
					datosMejora[0] = {};
					datosMejora[0].mejora = 0;
					datosMejora[0].Q1 = 0;
					datosMejora[0].Q2 = 0;
					datosMejora[0].asignatura = asignatura;

					datosMejora[0].FaltasJQ1 = 0;
					datosMejora[0].FaltasJQ2 = 0;
					datosMejora[0].FaltasIJQ1 = 0;
					datosMejora[0].FaltasIJQ2 = 0;

					datosMejora[0].HorasQ1 = 0;
					datosMejora[0].HorasQ2 = 0;
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

					if(comportaLetras == ''){
						datosGracia[0].comporLetra = '';
					}else{
						datosGracia[0].comporLetra = comportaLetras;
					}
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

					if(comportaLetras == ''){
						datosGracia[0].comporLetra = 'A';
					}else{
						datosGracia[0].comporLetra = comportaLetras;
					}
					datosGracia[0].promedioFinal = subPromedio.toFixed(2);
					//se ingresa al json el valor de la nota de supletorio
					$scope.notasParcial.push(datosGracia[0]);
					
				}	
			}
        }, function (error) {
                console.log(error);
        });
	}

	$scope.printToCart = function(printSectionId) {
        var innerContents = document.getElementById(printSectionId).innerHTML;
        var popupWinindow = window.open('', '_blank', 'width=1000px,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
        popupWinindow.document.open();
        popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css"/></head><body onload="window.print()">' + innerContents + '</html>');
        popupWinindow.document.close();
    }

	$scope.promedioGLobal = function () {
		var Q1 = document.getElementsByClassName('Q1');
		var Q2 = document.getElementsByClassName('Q2');
		var promedio1 = document.getElementsByClassName('promedio1');
		var mejora = document.getElementsByClassName('mejora');
		var suple = document.getElementsByClassName('suple');
		var remedial = document.getElementsByClassName('remedial');
		var gracia = document.getElementsByClassName('gracia');
		var promedioFinal = document.getElementsByClassName('promedioFinal');
		var comporLetra = document.getElementsByClassName('comporLetra');
		var faltasJQ1 = document.getElementsByClassName('faltasJQ1');
		var faltasJQ2 = document.getElementsByClassName('faltasJQ2');
		var faltasIJQ1 = document.getElementsByClassName('faltasIJQ1');
		var faltasIJQ2 = document.getElementsByClassName('faltasIJQ2');

		var horasQ1 = document.getElementsByClassName('horasQ1');
		var horasQ2 = document.getElementsByClassName('horasQ2');

		var TQ1 = 0, TQ2 = 0, TP1 = 0, TM = 0, TS = 0, 
			TR = 0, TG = 0, TPF = 0, TCL = 0, 
			FalJQ1 = 0, FalJQ2 = 0, FalIJQ1 = 0, FalIJQ2 = 0,
			hQ1 = 0, hQ2 = 0;
		for (var i = 0; i < promedioFinal.length; i++) {
			TQ1 = TQ1 + parseFloat(Q1[i].innerHTML);
			TQ2 = TQ2 + parseFloat(Q2[i].innerHTML);
			TP1 = TP1 + parseFloat(promedio1[i].innerHTML);
			FalJQ1 = FalJQ1 + parseInt(faltasJQ1[i].innerHTML);
			FalJQ2 = FalJQ2 + parseInt(faltasJQ2[i].innerHTML);
			FalIJQ1 = FalIJQ1 + parseInt(faltasIJQ1[i].innerHTML);
			FalIJQ2 = FalIJQ2 + parseInt(faltasIJQ2[i].innerHTML);

			hQ1 = hQ1 + parseInt(horasQ1[i].innerHTML);
			hQ2 = hQ2 + parseInt(horasQ2[i].innerHTML);
			/*
			TM = TM + parseFloat(mejora[i].innerHTML);
			TS = TS + parseFloat(suple[i].innerHTML);
			TR = TR + parseFloat(remedial[i].innerHTML);
			TG = TG + parseFloat(gracia[i].innerHTML);
			*/
			TPF = TPF + parseFloat(promedioFinal[i].innerHTML);
			
		}
		var TQ1 = TQ1 / Q1.length;
		document.getElementById('totalQ1').innerHTML = TQ1.toFixed(2);
		var TQ2 = TQ2 / Q1.length;
		document.getElementById('totalQ2').innerHTML = TQ2.toFixed(2);
		var TP1 = TP1 / Q1.length;
		document.getElementById('totalProm1').innerHTML = TP1.toFixed(2);

		
		document.getElementById('totalQ1FJ').innerHTML = FalJQ1.toFixed(0);
		document.getElementById('totalQ2FJ').innerHTML = FalJQ2.toFixed(0);
		document.getElementById('totalQ1FIJ').innerHTML = FalIJQ1.toFixed(0);
		document.getElementById('totalQ2FIJ').innerHTML = FalIJQ2.toFixed(0);

		document.getElementById('HorasQ1').innerHTML = hQ1.toFixed(0);
		document.getElementById('HorasQ2').innerHTML = hQ2.toFixed(0);

		document.getElementById('totalH').innerHTML = parseInt(hQ1) + parseInt(hQ2);
		document.getElementById('totalFJ').innerHTML = parseInt(FalJQ1) + parseInt(FalJQ2);
		document.getElementById('totalFIJ').innerHTML = parseInt(FalIJQ1) + parseInt(FalIJQ2);

		/*
		var TM = TM / Q1.length;
		document.getElementById('totalM').innerHTML = TM.toFixed(2);
		var TS = TS / Q1.length;
		document.getElementById('totalS').innerHTML = TS.toFixed(2);
		var TR = TR / Q1.length;
		document.getElementById('totalR').innerHTML = TR.toFixed(2);
		var TG = TG / Q1.length;
		document.getElementById('totalG').innerHTML = TG.toFixed(2);
		*/
		var TPF = TPF / Q1.length;
		document.getElementById('totalPromF').innerHTML = TPF.toFixed(2);

		var a = 0, b = 0, c = 0, d = 0;
		for (var i = 0; i < comporLetra.length; i++) {

			switch (comporLetra[i].innerHTML) {
				case 'A':
					a = a + 1;
					break;
				case 'B':
					b = b + 1;
					break;
				case 'C':
					c = c + 1;
					break;
				case 'D':
					d = d + 1;
					break;
			}
			//console.log(a+" "+b+" "+c+" "+d);
		}
		
		//console.log(a+" "+b+" "+c+" "+d);

		if (a > b && a > c && a > d) {
			var TCL = 'A';
		}
		if (b > a && b > c && b > d) {
			var TCL = 'B';	
		}
		if (c > a && c > b && c > d) {
			var TCL = 'C';	
		}
		if (d > a && d > b && d > c) {
			var TCL = 'D';	
		}

		if (a == b || a == c || a == d) {
			var TCL = 'A';
		}
		
		
		
		document.getElementById('totalComporta').innerHTML = TCL;
	}

});
