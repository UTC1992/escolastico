app.controller('estudianteCtrl', function($scope, $http, $location, $route) {
    //mostrar estudiantes
    //listarEstudiantes();
    listarAnios();
    listarMeses();
    listarDias();

	$scope.buscarEstudiante = function(){
        //validar cedula
        var cedula = String($scope.cedulaEstu);
        if(cedula.length < 10){ 
            $scope.validarBuscar = true;
        }else{ 
            $scope.validarBuscar = false;
            //buscar studiante
            obtenerEstudiante(cedula); 
        }
    }

    function obtenerEstudiante(cedula) {
            var url = $('#urlBuscarEstu').val();
            var datos = [];
            $http.get(url+"/"+cedula)
            .success(function(datosP){
                //alert(datosP.length);
                if(datosP.length == 0){
                    $scope.busqueda = true;
                    $scope.datos = datosP;
                }else{
                    $scope.busqueda = false;
                    $scope.datos = datosP;
                    $scope.cedulaEstu = "";
                }
            });
    }

    //obtener todos los periodos de la tabla
    function listarEstudiantes() {
        $scope.getUrl = $('#urlEstudiantes').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.estudiantes = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    //listar meses
    function listarMeses(){
        $scope.meses = [
            {name : "Enero", num : "01"},
            {name : "Febrero", num : "02"},
            {name : "Marzo", num : "03"},
            {name : "Abril", num : "04"},
            {name : "Mayo", num : "05"},
            {name : "Junio", num : "06"},
            {name : "Julio", num : "07"},
            {name : "Agosto", num : "08"},
            {name : "Septiembre", num : "09"},
            {name : "Octubre", num : "10"},
            {name : "Noviembre", num : "11"},
            {name : "Disciembre", num : "12"}
        ];
    }

    //listar dias
    function listarDias(){
        $scope.dias = [];
        var contador = 0;
        for (var i = 1; i <= 31; i++) {
            if (i <= 9 ) {
                $scope.dias[contador] = "0" + i;
                contador++;
            } else {
                $scope.dias[contador] = i;
                contador++;
            }
            
        }
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

    $scope.inicializarInput = function(){
        inicializarVariablesEstu();
		inicializarInputMatricula();
		$scope.confirmarMatri = false;
		$scope.confirmarMatriEdit = false;
    }

	function inicializarVariablesEstu(){
		$scope.cedula = "";
        $scope.nombres = "";
        $scope.apellidos = "";
        $scope.anioNacimiento = "";
        $scope.mesNacimiento = "";
        $scope.diaNacimiento = "";
        $scope.domicilio = "";
        $scope.lugarNacimiento = "";
        $scope.representante = "";
        $scope.cedulaRepre = "";
        $scope.padre = "";
        $scope.cedulaPadre = "";
        $scope.madre = "";
        $scope.cedulaMadre = "";
        $scope.telefonoRepre = "";
	}

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarE').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "cedula_estu="+$scope.cedula
                    +"&nombres_estu="+$scope.nombres
                    +"&apellidos_estu="+$scope.apellidos
                    +"&fechanacimiento_estu="+$scope.anioNacimiento+"-"
                                            +$scope.mesNacimiento+"-"
                                            +$scope.diaNacimiento
                    +"&direccion_estu="+$scope.domicilio
                    +"&lugar_nacimiento_estu="+$scope.lugarNacimiento
                    +"&representante_estu="+$scope.representante
                    +"&cedula_representante_estu="+$scope.cedulaRepre
                    +"&nombre_padre_estu="+$scope.padre
                    +"&cedula_padre_estu="+$scope.cedulaPadre
                    +"&nombre_madre_estu="+$scope.madre
                    +"&cedula_madre_estu="+$scope.cedulaMadre
                    +"&telefono_representante_estu="+$scope.telefonoRepre,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
			obtenerIdEstudiante($scope.cedula);
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
    }

	/////////////////////////MATRICULA
	function obtenerIdEstudiante(cedula){
		var url = $('#urlBuscarIdEstu').val();
		$http.get(url+"/"+cedula)
        .success(function(datosP){
			
            $scope.lista = datosP;
            $scope.idEstu =  datosP[0]['id_estu'];
			alert('id ==>' +$scope.idEstu);
			registrarMatricula($scope.idEstu);
        });
	}
	$scope.confirmarMatri = false;
	// declaro la función enviar
    function registrarMatricula(idEstu) {
        $scope.getUrl = $('#urlInsertarM').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "id_curs="+$scope.cursosID
                    +"&id_estu="+idEstu
                    +"&fechainicio_matr="+$scope.anioInicio+"-"
                                            +$scope.mesInicio+"-"
                                            +$scope.diaInicio
                    +"&fechafin_matr="+$scope.anioFin+"-"
                                            +$scope.mesFin+"-"
                                            +$scope.diaFin
                    +"&paralelo_matr="+$scope.paralelo
                    +"&nivel_matr="+$scope.categoriaNivel,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            inicializarVariablesEstu();
			inicializarInputMatricula();
            $scope.confirmarMatri = true;
			$scope.mostrarEstudiantes();
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
    }
	

	////////////////////////MATRICULA

    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
        var url = event.target.id;
		var urlMostrarMatri = event.target.name;
        $http.get(url)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idEstu =  datosP[0]['id_estu'];
            $scope.cedula = datosP[0]['cedula_estu'];
            $scope.nombres = datosP[0]['nombres_estu'];
            $scope.apellidos = datosP[0]['apellidos_estu'];
            var fechaNacimiento = datosP[0]['fechanacimiento_estu'];
            var vectorFN = fechaNacimiento.split("-");
            $scope.anioNacimiento = vectorFN[0];
            $scope.mesNacimiento = vectorFN[1];
            $scope.diaNacimiento = vectorFN[2];
            $scope.domicilio = datosP[0]['direccion_estu'];
            $scope.lugarNacimiento = datosP[0]['lugar_nacimiento_estu'];
            $scope.representante = datosP[0]['representante_estu'];
            $scope.cedulaRepre = datosP[0]['cedula_representante_estu'];
            $scope.padre = datosP[0]['nombre_padre_estu'];
            $scope.cedulaPadre = datosP[0]['cedula_padre_estu'];
            $scope.madre = datosP[0]['nombre_madre_estu'];
            $scope.cedulaMadre = datosP[0]['cedula_madre_estu'];
            $scope.telefonoRepre = datosP[0]['telefono_representante_estu'];

			mostrarFormEditMatricula(urlMostrarMatri);

        });
    }

	function mostrarFormEditMatricula(url){
		$scope.confirmarMatriEdit = false;
        $http.get(url)
            .success(function(datosP){
                $scope.datosCertiImprimir = datosP;
				var idMatricula = datosP[0]['id_matr'];
                $('#idMatri').val(idMatricula);
                var fechaI = datosP[0]['fechainicio_matr'].split("-");
                $scope.anioInicio = fechaI[0];
				$scope.mesInicio = fechaI[1];
				$scope.diaInicio = fechaI[2];
                var fechaF = datosP[0]['fechafin_matr'].split("-");
                $scope.anioFin = fechaF[0];
				$scope.mesFin = fechaF[1];
				$scope.diaFin = fechaF[2];
				$scope.cursoID2 = datosP[0]['id_curs'];
				var idCurso = $scope.cursoID2 + "";
				if (idCurso != "") {
					$scope.cursosMostrarVerficacion = true;
				} else {
					$scope.cursosMostrarVerficacion = false;
				}
				
                $scope.cursoNombre = datosP[0]['nombre_curs'];
                $scope.paraleloEdit = datosP[0]['paralelo_matr'];
                $scope.categoriaNivel = datosP[0]['nivel_matr'];
            });
	}

     // funcion para enviar datos para actualizar periodo
    $scope.actualizar = function () {
        //alert("actulizar");
        $scope.getUrl = $('#urlActualizarE').val();
        $scope.getId = $('#idEstu').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
        $http({
            method: "post",
            url: $scope.urlActualizar,
             data:   "cedula_estu="+$scope.cedula
                    +"&nombres_estu="+$scope.nombres
                    +"&apellidos_estu="+$scope.apellidos
                    +"&fechanacimiento_estu="+$scope.anioNacimiento+"-"
                                            +$scope.mesNacimiento+"-"
                                            +$scope.diaNacimiento
                    +"&direccion_estu="+$scope.domicilio
                    +"&lugar_nacimiento_estu="+$scope.lugarNacimiento
                    +"&representante_estu="+$scope.representante
                    +"&cedula_representante_estu="+$scope.cedulaRepre
                    +"&nombre_padre_estu="+$scope.padre
                    +"&cedula_padre_estu="+$scope.cedulaPadre
                    +"&nombre_madre_estu="+$scope.madre
                    +"&cedula_madre_estu="+$scope.cedulaMadre
                    +"&telefono_representante_estu="+$scope.telefonoRepre,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            actualizarMatricula();
        }, function (error) {
                console.log(error);
        });
    }

	function actualizarMatricula () {
		//alert("actulizar");
        $scope.getUrl = $('#urlActualizarM').val();
        $scope.getId = $('#idMatri').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
		$scope.cursoIdEdit = $('#cursosIDEdit').val();
        $http({
            method: "post",
            url: $scope.urlActualizar,
             data:   "id_curs="+$scope.cursoIdEdit
                    +"&fechainicio_matr="+$scope.anioInicio+"-"
                                            +$scope.mesInicio+"-"
                                            +$scope.diaInicio
                    +"&fechafin_matr="+$scope.anioFin+"-"
                                            +$scope.mesFin+"-"
                                            +$scope.diaFin
                    +"&paralelo_matr="+$scope.paraleloEdit
                    +"&nivel_matr="+$scope.categoriaNivel,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            $scope.confirmarMatriEdit = true;
			$scope.mostrarEstudiantes();
			//buscarMatriculaActualizada($('#idMatri').val());
        }, function (error) {
                console.log(error);
        });
	}
///////////////////////////////////////////MATRICULA

	listarCursos();
	listarParalelos();
	inicializarInputMatricula();

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

	$scope.mostrarEstudiantes = function(){
		var nivel = $('#nivelEstudiantes').val();
		var url = $('#urlEstudiantes').val();
		$http({
			method: "post",
            url: url,
            data: 	"fechainicio_matr="+$scope.anioInicio
                    +"&fechafin_matr="+$scope.anioFin
					+"&nivel_matr="+nivel,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			$scope.datos = response;
		}, function (error) {
			console.log(error);
		});
	}

    function inicializarInputMatricula(){
        $scope.anioInicio = "";
        $scope.mesInicio = "";
        $scope.diaInicio = "";
        $scope.anioFin = "";
        $scope.mesFin = "";
        $scope.diaFin = "";
        $scope.categoriaNivel = "";
        $scope.cursosID = "";
        $scope.paralelo = "";
    }


});
