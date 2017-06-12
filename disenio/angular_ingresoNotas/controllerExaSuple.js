app.controller('ingresoExaSupleCtrl', function($scope, $http) {

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

//////////////////////////////////////////////////////////////////////////
	$scope.mensajeNumRegistros = false;
	$scope.verificarRegistro = function(){
		$scope.mensajeIngreso = false;
		//var parcial = $scope.quimestre+"";
		$scope.getUrl = $('#urlNumRegistrosSuple').val();
		contarRegistros($scope.getUrl);
	}

	function contarRegistros(url){
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
				consultarEstudiantes();
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

///////////////////////////////CONSULTAR ESTUDIANTES CON NOTAS FINALES////////////////////////////
	$scope.mensaje = false;
	$scope.estudiantesMatriculados = [];
	function consultarEstudiantes(){
		$scope.estudiantesMatriculados = [];
		array = [];
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
				$scope.estudiantesMatriculados = [];
				array = [];
				$scope.ingresarDesactivar = false;
				
			} else {
				for (var i = 0; i < response.length; i++) {
					var cedula = response[i]['cedula_estu'];
					consultarNotasFinales(cedula);
				}
				$scope.mensaje = false;
				llenarDatosInformativos($scope.cursoId, $scope.paralelo, $scope.anioI, 
				$scope.anioF, $scope.materia, $scope.parcial, $scope.quimestre);
				$scope.estudiantesMatriculados = array;
				//desaparecer el boton de envio de datos
				$scope.ingresarDesactivar = false;
				//mostrar array lleno de datos
				console.log($scope.estudiantesMatriculados);
				
			}
            
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
	}

	var array = [];
	function consultarNotasFinales(cedula){
		var url = $('#urlNotasTotales').val();
		$http({
            method: "post",
            url: url,
            data:   "cursoId="+$scope.cursoId
                    +"&paralelo="+$scope.paralelo
                    +"&anioI="+$scope.anioI
                    +"&anioF="+$scope.anioF
					+"&materia="+$scope.materia
					+"&quimestre="+$scope.quimestre
					+"&cedula="+cedula,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
			if(response.length == 0){
				$scope.mensaje = true;
				limpiarVariables();
				$scope.ingresarDesactivar = false;
				$scope.estudiantesMatriculados = [];
				array = [];
				
			} else {
				if (response[0]['NotaF'] < 7) {
					array.push(response[0]);
				}
				//array.push(response[0]);
			}
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });

	}

/////////////////////////////////////////////////////////////////////////
	
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
			var notaSuple = notas[i+1].value;
			$scope.getUrl = $('#urlIngresarSupletorio').val();
			alert($scope.getUrl+"-"+idEstu + "-" + notaSuple);
			ingresarNotasExa(idEstu, notaSuple, $scope.getUrl);
		}
	}

	//desactivar boton de inrgeso
	$scope.ingresarDesactivar = false;
	$scope.mensajeIngreso = false;
	function ingresarNotasExa(idEstu, notaSuple, urlIngresoExaSuple){
		$scope.mostrarCargando = true;
		//desaparecer el boton de envio de datos
		$scope.ingresarDesactivar = true;
		//alert($scope.getUrl);
		$http({
            method: "post",
            url: urlIngresoExaSuple,
            data:   "examen="+notaSuple
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
		$scope.mensajeIngreso = false;
		var parcial = $scope.parcial+"";
		
		$scope.getUrl = $('#urlInformes1').val();
		consultarExamenes($scope.getUrl);
	}

	function consultarExamenes(urlInforme){
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
            mostrarDatosActualizados();
			$scope.edicionExitosa = true;
        }, function (error) {
                $scope.edicionFallida = true;
				console.log(error);

        });
	}

	function mostrarDatosActualizados(){
		$scope.mensajeIngreso = false;
		
		$scope.getUrl = $('#urlInformes1').val();
		consultarExamenes($scope.getUrl);

	}
	

});
