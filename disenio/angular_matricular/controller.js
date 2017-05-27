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
        var id = event.target.id;
        $('#idEstu').val(id);
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

});