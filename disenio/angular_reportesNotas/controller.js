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
				alert("No hay parcial");
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
				$scope.notasParcial = response;
				
			}
            
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
			console.log(response);

			for (var i = 0; i < response.length; i++) {
				//alert(response[i]['asig']);
				var asignatura = response[i]['asig'];
				//alert(idCurso +" - " + idEstu + " - " + asignatura);
				$scope.mostrarNotasFinales(idCurso, idEstu, asignatura);
			}

        }, function (error) {
                console.log(error);
        });
	}

	$scope.mensajeNotas = false;
	$scope.notasParcial = [];
	$scope.mostrarNotasFinales = function(idCurso, idEstu, asignatura){
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
			console.log(response[0]);
			if(response.length == 0){
				$scope.mensajeNotas = true;
				$scope.notasParcial.push(" ");
			} else {
				$scope.mensajeNotas = false;
				$scope.notasParcial.push(response[0]);
			}

            //$scope.mensajeInsertC = false;
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
