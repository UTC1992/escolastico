app.controller('notasIngresoExaCtrl', function(Excel, $timeout,$scope, $http) {

	listarAnios();
	listarCursos();
	listarParalelos();
	//listarAsginaturas();
	listarAniosLectivos();

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
		if ($('#urlBuscarAniosLectivosActivo').val() != null) {
			var url = $('#urlBuscarAniosLectivosActivo').val();
			$http.get(url)
			.success(function(response){
				//console.log(response);
				$scope.AL = response[0];
				$scope.aniosL = response[0]['anioinicio_pera'] + "-" + response[0]['aniofin_pera'];

				$scope.anioIDoce = response[0]['anioinicio_pera'];
				$scope.anioFDoce = response[0]['aniofin_pera'];
				obtenerDatosCargos();
			});
		}
	
	}

	/////////////////////CARGOS
	function obtenerDatosCargos (){
		
		var url = $('#urlCargosDocente').val();

		$http({
            method: "post",
            url: url,
			data:   "docente="+$('#nombreDoce').val()
					+"&anioI="+$scope.anioIDoce
					+"&anioF="+$scope.anioFDoce,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);

			$scope.datosCargo = response.unique();

			var cursos = [];
			var materia = [];
			var paralelo = [];
			for (var i = 0; i < response.length; i++) {
				cursos[i] = response[i]['curso_cargo'];
				materia[i] = response[i]['asignatura_cargo'];
				paralelo[i] = response[i]['paralelo_cargo'];
				
			}
			$scope.docenteCursos = cursos.unique();
			$scope.docenteMaterias = materia.unique();
			$scope.docenteParalelo = paralelo.unique();
			
        }, function (error) {
                console.log(error);
        });
	}	

	Array.prototype.unique=function(a){
	return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
	});
	////////////////////FIN CARGOS LISTAR

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

//////////////////////////////////////////////////////////////////////////
	$scope.mensajeNumRegistros = false;
	$scope.verificarRegistro = function(){

		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];
		$scope.mensajeIngreso = false;

		var vectorCargos = $scope.cargoCPM.split("-");
		buscarIdCurso(vectorCargos[0]+"");
	}

	function buscarIdCurso(nombreCurs){
		var url = $('#urlNombreCurso').val();
		$http({
            method: "post",
            url: url,
            data:   "cursoNombre="+nombreCurs,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			
			$scope.getUrl = $('#urlNumRegistros1').val();
			conntarRegistros($scope.getUrl, response[0]['id_curs']);
			
			
        }, function (error) {
                console.log(error);
        });
	}

	function conntarRegistros(url, idCurso){
		$scope.cursoId = idCurso;
		var vectorCargos = $scope.cargoCPM.split("-");
		$scope.paralelo = vectorCargos[1];
		$scope.materia = vectorCargos[2];

		$http({
            method: "post",
            url: url,
            data:   "cursoId="+$scope.cursoId
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&materia="+$scope.materia
					+"&quimestre="+$scope.quimestre,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			var numNotas = response[0]['conteo'];
			//alert(numNotas);
			if(numNotas == 0){
				$scope.mensajeNumRegistros = false;
				mostrarEstudiantes();
			} else {
				limpiarVariables();
				$scope.mensajeNumRegistros = true;
				$scope.estudiantesMatriculados = [];
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

//////////////////////////////////////////////////////////////////////////
	$scope.mensaje = false;
	function mostrarEstudiantes(){
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
				$scope.ingresarDesactivar = false;
				
			} else {
				$scope.mensaje = false;
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, $scope.anioI, 
				$scope.anioF, $scope.materia, $scope.parcial, $scope.quimestre);
				$scope.estudiantesMatriculados = response;
				//desaparecer el boton de envio de datos
				$scope.ingresarDesactivar = false;
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

	$scope.enviarDatosExa = function(){
		var notas = document.getElementsByName('notaE');
		for(var i = 0; i < notas.length; i+=2){
			/*alert(notas[i].value + " - "+ notas[i+1].value + " - "+ notas[i+2].value+ " - "+ notas[i+3].value + "-"+ notas[i+4].value);
			*/
			var idEstu = notas[i].value;
			var examenQuimestral = notas[i+1].value;
			$scope.getUrl = $('#urlIngresarNotasExamen').val();
			ingresarNotasExa(idEstu, examenQuimestral, $scope.getUrl);
		}
	}

	//desactivar boton de inrgeso
	$scope.ingresarDesactivar = false;
	$scope.mensajeIngreso = false;
	function ingresarNotasExa(idEstu, examenQuimestral, urlIngresoNotasExa){
		//alert(idEstu + " - "+ deberes + " - "+ lecciones+ " - " + trabajos + "-"+ investigacion);
		$scope.mostrarCargando = true;
		//desaparecer el boton de envio de datos
		$scope.ingresarDesactivar = true;
		//alert($scope.getUrl);
		$http({
            method: "post",
            url: urlIngresoNotasExa,
            data:   "examen="+examenQuimestral
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

	/**
	 * INFORMES ==========================================================0
	 */
	$scope.mostrarDatosInformes = function(){
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');
		$scope.anioI = vectorAL[0];
		$scope.anioF = vectorAL[1];

		$scope.mensajeIngreso = false;
		
		var vectorCargos = $scope.cargoCPM.split("-");
		buscarIdCursoConsulta(vectorCargos[0]+"");
	}

	function buscarIdCursoConsulta(nombreCurs){
		var url = $('#urlNombreCurso').val();
		$http({
            method: "post",
            url: url,
            data:   "cursoNombre="+nombreCurs,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			
			$scope.getUrl = $('#urlInformes1').val();
			consultarExamenes($scope.getUrl, response[0]['id_curs']);
			
			
        }, function (error) {
                console.log(error);
        });
	}

	function consultarExamenes(urlInforme, idCurso){
		$scope.cursoId = idCurso;
		var vectorCargos = $scope.cargoCPM.split("-");
		$scope.paralelo = vectorCargos[1];
		$scope.materia = vectorCargos[2];
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

	$scope.mostrarNotasEditar = function(event){
		var parcial = $scope.parcial+"";
		var idExa = event.target.id;
		//alert(parcial+idParcial);
		
		$scope.getUrl = $('#urlNotasEdit1').val();
		consultarNotasExamenes($scope.getUrl, idExa);
	}

	function consultarNotasExamenes(url, id){
		$scope.edicionExitosa = false;
		$scope.edicionFallida = false;
		var urlExa = url +'/'+id;
		$http.get(urlExa).success(function(response){
			//console.log(response);
			$scope.datos = response;

			$scope.idExa 		= 	response[0]['id_exa'];
			$scope.notaExa 		= 	response[0]['nota_exa'];
        }, function (error) {
                console.log(error);
        });
	}

	$scope.procesoActualizar = function(){
		var idExaEdit = $('#idExaEdit').val();

		$scope.getUrl = $('#urlActualizarExa').val();
		actualizarNotasExa($scope.getUrl, idExaEdit);
		
	}

	$scope.edicionExitosa = false;
	$scope.edicionFallida = false;
	function actualizarNotasExa(url, id){
		$scope.urlActualizar = url + id;
        $http({
            method: "post",
            url: $scope.urlActualizar,
            data: 	"notaExa="+$scope.notaExa,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            $scope.mostrarDatosInformes();
			$scope.edicionExitosa = true;
        }, function (error) {
                $scope.edicionFallida = true;
				console.log(error);

        });
	}
	
	$scope.cargarAsignaturas = function(){
		var urlAsig = $('#urlAsignaturasCurso').val();
		$http({
            method: "post",
            url: urlAsig,
            data:   "idCurso="+$scope.cursoId,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			//console.log(response);
			$scope.asignatura = response;
        }, function (error) {
                console.log(error);
        });
	}

});
