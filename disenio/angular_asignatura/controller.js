var app = angular.module('appAsignatura', ["ngRoute"]);

app.controller('asignaturaDatos', function($scope, $http) {
    
    
    //alert(atributo);
    //$scope.dato = "perro";
    /*$scope.obtener = function (){
        var elemento = angular.element(".nombre");
        var atributo = elemento.attr("value");
        alert("hoa"+atributo);
    };
    */
    
    /*$('.btn').on('mousemove',function () {
        //alert($(this).data("id"));
        var datos = $(this).data("id");
        //$scope.datosModel = datos;
        alert(datos);
    });
    */

    $scope.idEditar = "300";

    $scope.ShowId = function(event) {
        alert("hola" + event.target.href);
    };

});

