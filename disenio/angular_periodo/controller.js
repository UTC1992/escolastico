app.controller('periodoAcademicoDatos', function($scope, $http, $location, $route) {
    //llenado de los selects de html
    listarMeses();
    listarAnios();
    listarPeriodos();
    inicializarSelects();

    //listar meses
    function listarMeses(){
        $scope.meses = [
            {name : "Enero", num : "1"},
            {name : "Febrero", num : "2"},
            {name : "Marzo", num : "3"},
            {name : "Abril", num : "4"},
            {name : "Mayo", num : "5"},
            {name : "Junio", num : "6"},
            {name : "Julio", num : "7"},
            {name : "Agosto", num : "8"},
            {name : "Septiembre", num : "9"},
            {name : "Octubre", num : "10"},
            {name : "Noviembre", num : "11"},
            {name : "Disciembre", num : "12"}
        ];
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

   
    //obtener todos los periodos de la tabla
    function listarPeriodos() {
        $scope.getUrl = $('#urlPeriodos').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.periodos = response;
            }, function (error) {
                console.log(error);
            });
        } else {
            $scope.mensaje = "No existen datos por el momento.";
        }
    }

    //campos de los diferentes selects a validad
    function inicializarSelects() {
        $scope.mesInicio = "";
        $scope.anioInicio = "";
        $scope.mesFin = "";
        $scope.anioFin = "";
    }
    
    $scope.mensajeInsertP = true;

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarP').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data: "mesInicio="+$scope.mesInicio+"&anioInicio="+$scope.anioInicio+"&mesFin="+$scope.mesFin+"&anioFin="+$scope.anioFin,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
            $scope.mensajeInsertP = false;
        });
    }


    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
        var url = event.target.id;
        $http.get(url)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idPeriodo =  datosP[0]['id_pera'];
            $scope.mesInicioEdit =  datosP[0]['mesinicio_pera'];
            $scope.anioInicioEdit =  datosP[0]['anioinicio_pera'];
            $scope.mesFinEdit =  datosP[0]['mesfin_pera'];
            $scope.anioFinEdit =  datosP[0]['aniofin_pera'];
        });
    }

    // funcion para enviar datos para actualizar periodo
    $scope.actualizar = function () {
        
        //alert("actulizar");
        $scope.getUrl = $('#urlActualizarP').val();
        $scope.getId = $('#idPeriodo').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
        $http({
            method: "post",
            url: $scope.urlActualizar,
            data: "mesInicio="+$scope.mesInicioEdit+"&anioInicio="+$scope.anioInicioEdit+"&mesFin="+$scope.mesFinEdit+"&anioFin="+$scope.anioFinEdit,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
        });
    }

    
});

//obtener dato del elemento que se aya presionado
/*
app.controller('periodoUrl', function($scope) {
    $scope.obtenerUrlEditar = function (event) {
        $scope.urlEditarP =  event.target.id;
        alert($scope.urlEditarP);
        $('#urlEditarPeriodo').val($scope.urlEditarP);
    };
});
*/