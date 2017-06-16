app.controller('adminCtrl', function($scope, $http) {

	activarMenu();
	function activarMenu(){
		$('#perfilMenu').addClass('active');
	}

	if ($('#urlAdminMostrar').val() != "" && $('#idAdmin').val() != "") {
		mostrarDatosAdmin();
	}

	function mostrarDatosAdmin(){
		var url = $('#urlAdminMostrar').val();
		var id = $('#idAdmin').val();

		$http.get(url + "/" + id).success(function(response){
			$scope.datos = response;

			$scope.cedula = response[0]['cedula_admin'];
			$scope.nombres = response[0]['nombres_admin'];
			$scope.apellidos = response[0]['apellidos_admin'];
			$scope.email = response[0]['correo_admin'];
			$scope.password = response[0]['password_admin'];
		},function (error) {
                console.log(error);
        });
	}

	$scope.mensajeActualizar = false;
	$scope.actualizarAdmin = function(){
		//alert("actulizar");
        var url = $('#urlAdminEdit').val();
        var id = $('#idAdmin').val();
        var urlActualizar = url +"/"+ id;
        $http({
            method: "post",
            url: urlActualizar,
            data: 	"cedula_admin="+$scope.cedula
					+"&nombres_admin="+$scope.nombres
                    +"&apellidos_admin="+$scope.apellidos
					+"&correo_admin="+$scope.email
					+"&password_admin="+$scope.password,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(){
            $scope.mensajeActualizar = true;
			mostrarDatosAdmin();
        }, function (error) {
                console.log(error);
        });
	}

});
