app.controller('estudianteCtrl', function($scope, $http, $filter, NgTableParams) {
    //mostrar estudiantes
    //listarEstudiantes();
    listarAnios();
    listarMeses();
    listarDias();
	listarAniosLectivos();

	activarMenu();
	function activarMenu(){
		$('#estudiantesMenu').addClass('active');
		$('#dropdownMenuButtonTablas').addClass('active');
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
                    +"&telefono_representante_estu="+$scope.telefonoRepre
					+"&correo_repre_estu="+$scope.correoRepre,
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
			//alert('id ==>' +$scope.idEstu);
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
			$scope.correoRepre = datosP[0]['correo_repre_estu'];

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
                    +"&telefono_representante_estu="+$scope.telefonoRepre
					+"&correo_repre_estu="+$scope.correoRepre,
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

	$scope.mensajeEstudiantes = false;
	$scope.mostrarEstudiantes = function(){
		$scope.mensajeEstudiantes = false;

		var nivel = $('#nivelEstudiantes').val();
		var url = $('#urlEstudiantes').val();
		var anioslectivos = $scope.aniosL+"";
		var vectorAL = anioslectivos.split('-');

		$http({
			method: "post",
            url: url,
            data: 	"fechainicio_matr="+vectorAL[0]
                    +"&fechafin_matr="+vectorAL[1]
					+"&nivel_matr="+nivel,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			$scope.datosEstu = response;
			if (response.length > 0) {
				$scope.estudiantesTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					apellidos_estu: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   $filter('filter')($scope.datosEstu, params.filter()) : $scope.datosEstu;
						
						var orderedData = params.sorting() ?
								$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.datosEstu;

						params.total(orderedData.length);
                        $scope.dataAsig = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
                        return $scope.dataAsig;
                    }
					
                });	
				$scope.mensajeEstudiantes = false;
			} else{
				$scope.estudiantesTable = new NgTableParams(
                {
                 count: 5,
				 sorting: {
					apellidos_estu: 'asc'     // initial sorting
				}
                }, {
                    counts: [5, 10, 20, 50, 100],
                    getData: function (params) {
   						$scope.dataAsig = params.filter() ? 
						   $filter('filter')($scope.datosEstu, params.filter()) : $scope.datosEstu;
						
						var orderedData = params.sorting() ?
								$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.datosEstu;

						params.total(orderedData.length);
                        $scope.dataAsig = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
                        return $scope.dataAsig;
                    }
					
                });	
				$scope.mensajeEstudiantes = true;
			}
			

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

///////////////////////////CERTIFICADO
	$scope.printToCart = function(printSectionId) {
        var innerContents = document.getElementById(printSectionId).innerHTML;
        var popupWinindow = window.open('', '_blank', 'width=1000px,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
        popupWinindow.document.open();
        popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css"/></head><body onload="window.print()">' + innerContents + '</html>');
        popupWinindow.document.close();
    }

    $scope.generarCerti = function(event){
        var id = event.target.id;
        var url = event.target.name;
		//alert(url);
        $http.get(url)
            .success(function(datosP){
                $scope.datosCertiImprimir = datosP;

                $scope.matriculaNum = datosP[0]['id_matr'];
                var fechaI = datosP[0]['fechainicio_matr'].split("-");
                $scope.anioI = fechaI[0];
                var fechaF = datosP[0]['fechafin_matr'].split("-");
                $scope.anioF = fechaF[0];
                var nombreEstu = datosP[0]['apellidos_estu'] + " " + datosP[0]['nombres_estu'];
                $scope.estudiante = nombreEstu.toUpperCase();
                $scope.padre = datosP[0]['nombre_padre_estu'].toUpperCase();;
                $scope.madre = datosP[0]['nombre_madre_estu'].toUpperCase();;
                $scope.fechaN = obtenerFechaTexto(datosP[0]['fechanacimiento_estu']).toUpperCase();
                
				$scope.edadEstu = obtenerEdadEstudiante(datosP[0]['fechanacimiento_estu']);

                $scope.direccion = datosP[0]['direccion_estu'].toUpperCase();
                $scope.curso = datosP[0]['nombre_curs'].toUpperCase();
                $scope.paraleloCerti = datosP[0]['paralelo_matr'].toUpperCase();
                $scope.ciclo = datosP[0]['nivel_matr'].toUpperCase();
                $scope.fechaActual = "LATACUNGA, " + obtenerFechaActual().toUpperCase();
            });
    }

    function obtenerFechaActual(){
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var date = new Date();
        var fechaA = date.getDate() + " de " + meses[date.getMonth()] + " del " + date.getFullYear();
        return fechaA;
    }

    function obtenerFechaTexto(fecha){
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var vector = fecha.split("-");
        var date = new Date();
        var fecha = vector[2] + " de " + meses[vector[1]-1] + " de " + vector[0];
        return fecha;
    }

	function obtenerEdadEstudiante(fecha){

		// Si la fecha es correcta, calculamos la edad
		var values=fecha.split("-");
		var dia = values[2];
		var mes = values[1];
		var ano = values[0];

		// cogemos los valores actuales
		var fecha_hoy = new Date();
		var ahora_ano = fecha_hoy.getYear();
		var ahora_mes = fecha_hoy.getMonth()+1;
		var ahora_dia = fecha_hoy.getDate();

		// realizamos el calculo
		var edad = (ahora_ano + 1900) - ano;
		if ( ahora_mes < mes )
		{
			edad--;
		}
		if ((mes == ahora_mes) && (ahora_dia < dia))
		{
			edad--;
		}
		if (edad > 1900)
		{
			edad -= 1900;
		}

		// calculamos los meses
		var meses=0;
		if(ahora_mes>mes)
			meses=ahora_mes-mes;
		if(ahora_mes<mes)
			meses=12-(mes-ahora_mes);
		if(ahora_mes==mes && dia>ahora_dia)
			meses=11;

		// calculamos los dias
		var dias=0;
		if(ahora_dia>dia)
			dias=ahora_dia-dia;
		if(ahora_dia<dia)
		{
			ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
			dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
		}

		//alert("Tienes "+edad+" años, "+meses+" meses y "+dias+" días");
		return edad; 
	}


});
