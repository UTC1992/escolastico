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

    $scope.inicializarInput = function (){
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

    // declaro la función para mostrar el formulario de edicion
    $scope.mostrarFormEditar = function (event) {
        var url = event.target.id;
        $http.get(url)
        .success(function(datosP){
            $scope.lista = datosP;
            
            $scope.idDocente =  datosP[0]['id_doce'];
            $scope.cedula = datosP[0]['cedula_doce'];
            $scope.nombres = datosP[0]['nombres_doce'];
            $scope.apellidos = datosP[0]['apellidos_doce'];

            var fechaNacimiento = datosP[0]['fechanacimiento_doce'];
            var vectorFN = fechaNacimiento.split("-");
            $scope.anioNacimiento = vectorFN[0];
            $scope.mesNacimiento = vectorFN[1];
            $scope.diaNacimiento = vectorFN[2];
            
            $scope.titulo = datosP[0]['titulo_especializacion_senescyt_doce'];
            
            var fechaIngresoMagis = datosP[0]['fecha_ingreso_magisterio_doce'];
            var vectorFIM = fechaIngresoMagis.split("-");
            $scope.anioIngresoMagis = vectorFIM[0];
            $scope.mesIngresoMagis = vectorFIM[1];
            $scope.diaIngresoMagis = vectorFIM[2];

            var fechaIngresoInst = datosP[0]['fecha_ingreso_institucion_doce'];
            var vectorFII = fechaIngresoInst.split("-");
            $scope.anioIngresoInst = vectorFII[0];
            $scope.mesIngresoInst = vectorFII[1];
            $scope.diaIngresoInst = vectorFII[2];

            $scope.relacionLab = datosP[0]['relacion_laboral_doce'];
            $scope.categoriaContrato = datosP[0]['categoria_contrato_doce'];
            $scope.funcion = datosP[0]['funcion_doce'];
            $scope.horasPedagogicas = parseInt(datosP[0]['numero_horas_pedagogicas_doce']);
            $scope.lugarRecidencia = datosP[0]['lugar_residencia_doce'];
            $scope.telefono = datosP[0]['telefono_domicilio_doce'];
            $scope.movil = datosP[0]['telefono_movil_doce'];
            $scope.correo = datosP[0]['email_doce'];
            $scope.estado = datosP[0]['estado_doce'];
        });
    }

    // funcion para enviar datos para actualizar periodo
    $scope.actualizar = function () {
        //alert("actulizar");
        $scope.getUrl = $('#urlActualizarD').val();
        $scope.getId = $('#idDocente').val();
        $scope.urlActualizar = $scope.getUrl + $scope.getId;
        $http({
            method: "post",
            url: $scope.urlActualizar,
            data: "cedula_doce="+$scope.cedula
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
        }, function (error) {
                console.log(error);
        });
    }
});