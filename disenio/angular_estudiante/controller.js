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
            alert();
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
            window.location.reload(false);
        }, function (error) {
                console.log(error);
        });
    }

});
