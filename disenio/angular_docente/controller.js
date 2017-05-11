app.controller('docenteCtrl', function($scope, $http, $location, $route) {
    
    //activar funcion
    listarDias();
    listarMeses();
    listarAnios();
    listarDocente();
    
    
    //obtener todos los periodos de la tabla
    function listarDocente() {
        $scope.getUrl = $('#urlDocentes').val();
        if ($scope.getUrl != null) {
            $http.post($scope.getUrl)
            .success(function(response){
                $scope.docentes = response;
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

    //listar dias
    function listarDias(){
        $scope.dias = [];
        var contador = 0;
        for (var i = 1; i <= 31; i++) {
            $scope.dias[contador] = i;
            contador++;
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
        $scope.cedula = "";
        $scope.nombres = "";
        $scope.apellidos = "";
        $scope.anioNacimiento = "";
        $scope.mesNacimiento = "";
        $scope.diaNacimiento = "";
        $scope.titulo = "";
        $scope.anioIngresoMagis = "";
        $scope.mesIngresoMagis = "";
        $scope.diaIngresoMagis = "";
        $scope.anioIngresoInst = "";
        $scope.mesIngresoInst = "";
        $scope.diaIngresoInst = "";
        $scope.relacionLab = "";
        $scope.categoriaContrato = "";
        $scope.funcion = "";
        $scope.horasPedagogicas = "";
        $scope.lugarRecidencia = "";
        $scope.telefono = "";
        $scope.movil = "";
        $scope.correo = "";
        $scope.estado = "";

    }

    // declaro la función enviar
    $scope.registrarNuevo = function () {
        $scope.getUrl = $('#urlInsertarD').val();
        $http({
            method: "post",
            url: $scope.getUrl,
            data:   "cedula_doce="+$scope.cedula
                    +"&nombres_doce="+$scope.nombres
                    +"&apellidos_doce="+$scope.apellidos
                    +"&fechanacimiento_doce="+$scope.anioNacimiento+"-"
                                            +$scope.mesNacimiento+"-"
                                            +$scope.diaNacimiento
                    +"&titulo_especializacion_senescyt_doce="+$scope.titulo
                    +"&fecha_ingreso_magisterio_doce="+$scope.anioIngresoMagis+"-"
                                                        +$scope.mesIngresoMagis+"-"
                                                        +$scope.diaIngresoMagis
                    +"&fecha_ingreso_institucion_doce="+$scope.anioIngresoInst+"-"
                                                        +$scope.mesIngresoInst+"-"
                                                        +$scope.diaIngresoInst
                    +"&relacion_laboral_doce="+$scope.relacionLab
                    +"&categoria_contrato_doce="+$scope.categoriaContrato
                    +"&funcion_doce="+$scope.funcion
                    +"&numero_horas_pedagogicas_doce="+$scope.horasPedagogicas
                    +"&lugar_residencia_doce="+$scope.lugarRecidencia
                    +"&telefono_domicilio_doce="+$scope.telefono
                    +"&telefono_movil_doce="+$scope.movil
                    +"&email_doce="+$scope.correo
                    +"&estado_doce="+$scope.estado,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            window.location.reload(false);
            //$scope.mensajeInsertC = false;
        }, function (error) {
                console.log(error);
        });
    }

});