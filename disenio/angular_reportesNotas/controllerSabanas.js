app.controller('repoSabanaCtrl', function(Excel, $timeout, $scope, $http, $filter, NgTableParams) {
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

	$scope.estudiantesMatriculados = [];
	$scope.mostrarEstudiantesNotas = function(){
		$scope.notasParcial = [];
		$scope.estudiantesMatriculados = [];

		//datos finales inicializar
		

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
				
				$scope.sabanaFinal = [];
				$scope.cargando = false;
				$scope.tablaMostrar = false;

				$scope.mensaje = true;
				limpiarVariables();
				$scope.estudiantesMatriculados = [];
				$scope.ingresarDesactivar = false;
				
			} else {

				$scope.sabanaFinal = [];
				$scope.cargando = true;
				$scope.tablaMostrar = false;

				$scope.mensaje = false;
				var anioslectivos = $scope.aniosL+"";
				var vectorAL = anioslectivos.split('-');
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, vectorAL[0], 
				vectorAL[1], $scope.parcial, $scope.quimestre);
				$scope.estudiantesMatriculados = [];

				//ENVIAR ESTUDIANTES
				obtenerDatosEstudiantesNotas(response);

				//desaparecer el boton de envio de datos
				$scope.ingresarDesactivar = false;
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

	function obtenerDatosEstudiantesNotas(datosEstudiantes){
		$scope.notas = [];
		console.log('Hola funcion estudiantes');
		console.log(datosEstudiantes);
		for (var i = 0; i < datosEstudiantes.length; i++) {
			var idCurso =  datosEstudiantes[i].id_curs;
			var idEstu = datosEstudiantes[i].id_estu;
			var estu = datosEstudiantes[i].apellidos_estu + " " + datosEstudiantes[i].nombres_estu;
			
			buscarAsignaturasDeCurso(idCurso, idEstu, estu , datosEstudiantes, i , datosEstudiantes.length);
			
		}

		$scope.arrayEstu = datosEstudiantes;

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

	$scope.notasParcial = [];
	$scope.notas = [];
	$scope.sabanaFinal = [];

	$scope.cargando = false;
	$scope.tablaMostrar = false;
	function buscarAsignaturasDeCurso(idCurso, idEstu, estu, datosEstudiantes, cont, numEstu){
		
		//año lectivo
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];

		var urlAsig = $('#urlAsignaturasCurso').val();
		$http({
            method: "post",
            url: urlAsig,
            data:   "idCurso="+idCurso,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			$scope.arrayAsig = response;
			$scope.notasParcial = [];
			for (var i = 0; i < response.length; i++) {

				var asignatura = response[i]['asig'];
				var idAsig = response[i]['id_asig'];
				$scope.mostrarNotasFinales(idCurso, idEstu, asignatura, idAsig, estu);
				
			}

			$scope.sabanaFinal = datosEstudiantes;

			setTimeout(function(){
				//unitilzar apply para actualizar datos de array
				$scope.$apply(function () {
					if(numEstu == (cont+1) ){
						$scope.notas.push($scope.notasParcial);
						mostrarNotas($scope.notas, datosEstudiantes);
					}
				});
			},28000,"JavaScript");
			
        }, function (error) {
                console.log(error);
		});
		
	}

	//CREACION DEL ARRAY COMPLETO DE ESTUDIANTES Y NOTAS
	function mostrarNotas(notasData, datosEstudiantes){
		console.log('Materias finalizadas');
		//console.log(response);

		for (var i = 0; i < datosEstudiantes.length; i++) {

			var nombreEstu = datosEstudiantes[i].apellidos_estu + " " + datosEstudiantes[i].nombres_estu;
			var vectorNotas = [];
			//console.log("Estu ==> "+nombreEstu);
			for (var j = 0; j < notasData.length; j++) {

				var vectorResponse = notasData[j]; 
				for (var k = 0; k < vectorResponse.length; k++) {
					
					//console.log(vectorResponse[k].estu);
					if(nombreEstu == vectorResponse[k].estu){
						vectorNotas.push(vectorResponse[k]);

					}
				}
				
			}
			vectorNotas = ordenarDatosNotas(vectorNotas);
			datosEstudiantes[i].arrayNotas = vectorNotas;
		}

		$scope.sabanaFinal = datosEstudiantes;
		console.log($scope.sabanaFinal);
		
		//imagenes de cargando
		$scope.cargando = false;
		$scope.tablaMostrar = true;
		
	}

	function ordenarDatosNotas(array){
		var arrayOrdenado = [];
		var menor;

		for (i=0;i<(array.length-1);i++)
		{
			for(j=(i+1);j<array.length;j++)
			{
				if(parseInt(array[j].idAsig) < parseInt(array[i].idAsig) )
				{
				   menor=array[j];
				   array[j]=array[i];
				   array[i]=menor;
				}
			}
		}
		arrayOrdenado = array;
		console.log(arrayOrdenado);
		return arrayOrdenado;
	}

	
	$scope.mostrarNotasFinales = function(idCurso, idEstu, asignatura, idAsig, estu){
		var urlNotaFinalAsig = $('#urlNotasAnual').val();
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
			//console.log('Notas finales');
			//console.log(response);
			if(response.length == 0){

				$scope.mensajeNotas = true;
					obtenerNotaMejora($scope.anioI, $scope.anioF, idEstu, asignatura, idAsig, response, estu);

			} else {
				if (response.length > 0) {

					obtenerNotaMejora($scope.anioI, $scope.anioF, idEstu, asignatura, idAsig, response, estu);
					
				}
			}

        }, function (error) {
                console.log(error);
        });	
	}

	function obtenerNotaMejora(anioI, anioF, idEstu, asignatura, idAsig, datosMejora, estu){
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
			//console.log('Notas Mejora');
			//console.log(response);
			if(response.length == 0){
					
					datosMejora[0] = {};
					datosMejora[0].estu = estu;
					datosMejora[0].idAsig = idAsig;
					datosMejora[0].Q1 = 0;
					datosMejora[0].Q2 = 0;
					datosMejora[0].asignatura = asignatura;
					datosMejora[0].mejora = 0;
					
					obtenerNotaSupletorio(anioI, anioF, idEstu, asignatura, datosMejora);
			} else {
				if (response.length > 0) {

					datosMejora[0].estu = estu;
					datosMejora[0].idAsig = idAsig;
					datosMejora[0].asignatura = asignatura;
					datosMejora[0].mejora = response[0].nota_mejo;

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
			//console.log('Notas Supletorio');
			//console.log(response);
			if(response.length == 0){
					datosSuple[0].suple = 0;
					obtenerNotaRemedial(anioI, anioF, idEstu, asignatura, datosSuple);
			} else {
				if (response.length > 0) {

					datosSuple[0].suple = response[0].nota_suple;

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
			//console.log('Notas Remedial');
			//console.log(response);
			if(response.length == 0){
					datosRemedial[0].remedial = 0;
					obtenerNotaGracia(anioI, anioF, idEstu, asignatura, datosRemedial);
			} else {
				if (response.length > 0) {

					datosRemedial[0].remedial = response[0].nota_reme;

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
			//console.log('Notas Gracia');
			//console.log(response);
			if(response.length == 0){

					datosGracia[0].gracia = 0;
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

	$scope.printToCart = function(printSectionId) {
        var innerContents = document.getElementById(printSectionId).innerHTML;
        var popupWinindow = window.open('', '_blank', 'width=1000px,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
        popupWinindow.document.open();
        popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css"/></head><body onload="window.print()">' + innerContents + '</html>');
        popupWinindow.document.close();
    }

	$scope.descargarPdf = function()
	{
		var columns = ["ID", "Name", "Country"];
		var rows = [
			[1, "Shaw", "Tanzania"],
			[2, "Nelson", "Kazakhstan"],
			[3, "Garcia", "Madagascar"]
		];

		var doc = new jsPDF();

		doc.setFontSize(18);
		doc.text('Titulo', 14, 22);
		doc.setFontSize(11);
		doc.setTextColor(100);
		
		doc.text('text', 14, 30);

		//columns.splice(0, 2);
		doc.autoTable(columns, rows, {startY: 50, showHeader: 'firstPage'});
		
		doc.text('hola', 14, doc.autoTable.previous.finalY + 10);

		doc.save('table.pdf');


	}


});
