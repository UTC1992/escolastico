app.controller('matriculaCtrl', function($scope, $http, $location, $route) {
    //llenado de los selects de html

    $scope.cedulaEstu = "";
    $scope.dataEstudiante = [];
    listarCursos();
    listarAnios();
    listarParalelos();
    listarDias();
    listarMeses();
    inicializarInput();

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

    function inicializarInput(){
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
    
    $scope.enviarId = function(event){
		$scope.confirmarMatri = false;
		var id = event.target.id;
        $('#idEstu').val(id);
		inicializarInput();
    }

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarM').val();
        $scope.idEstu = $('#idEstu').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "id_curs="+$scope.cursosID
                    +"&id_estu="+$scope.idEstu
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
            inicializarInput();
            $scope.confirmarMatri = true;
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
    }

    $scope.buscarCertificado = function(){
        //validar cedula
        var cedula = $scope.cedulaCerti+"";
        var anioI = $scope.anioInicioCerti+"";
        var anioF = $scope.anioFinCerti+"";

        if(cedula.length < 10){ 
            $scope.validarBuscarCedula = true;
        }else{ 
            $scope.validarBuscarCedula = false;
        }

        if(anioI.length != 4 && anioF.length != 4){
            $scope.validarBuscarAnios = true;
        }else{
            $scope.validarBuscarAnios = false;
        }

        if(!$scope.validarBuscarAnios && !$scope.validarBuscarCedula){
            buscarMatricula(cedula, anioI, anioF);
        }
    }

	//buscarMatricula('0503254849', '1900', '1901');

    function buscarMatricula(cedula, anioI, anioF){
        var url = $('#urlBuscarCerti').val();
        //alert(url+"/"+cedula+"/"+anioI+"/"+anioF);
            var datos = [];
            $http.get(url+"/"+cedula+"/"+anioI+"/"+anioF)
            .success(function(datosP){
                //alert(datosP.length);
                if(datosP.length == 0){
                    $scope.Mensaje = true;
                    $scope.datosCerti = datosP;
                }else{
                    $scope.Mensaje = false;
                    $scope.datosCerti = datosP;
                    $scope.cedulaCerti = "";
                    $scope.anioInicioCerti = "";
                    $scope.anioFinCerti = "";
                }
            });
    }

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

	$scope.mostrarFormEdit = function(event){
		$scope.confirmarMatriEdit = false;
        var id = event.target.id;
		var url = event.target.name;
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
                $scope.cursoNombre = datosP[0]['nombre_curs'];
                $scope.paraleloEdit = datosP[0]['paralelo_matr'];
                $scope.categoriaNivel = datosP[0]['nivel_matr'];
            });
	}

	$scope.actualizar = function(){
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
			buscarMatriculaActualizada($('#idMatri').val());
        }, function (error) {
                console.log(error);
        });
	}

	function buscarMatriculaActualizada(idMatri){
		var url = $('#urlBuscarCertiActualizado').val();
        //alert(url+"/"+cedula+"/"+anioI+"/"+anioF);
            var datos = [];
            $http.get(url+"/"+idMatri)
            .success(function(datosP){
                //alert(datosP.length);
                if(datosP.length == 0){
                    $scope.Mensaje = true;
                    $scope.datosCerti = datosP;
                }else{
                    $scope.Mensaje = false;
                    $scope.datosCerti = datosP;
                    $scope.cedulaCerti = "";
                    $scope.anioInicioCerti = "";
                    $scope.anioFinCerti = "";
                }
            });
	} 

});
