app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "http://localhost/escolastico/admin_/periodoacademico/nuevo",
        controller : "parisCtrl"
    })
    .when("/london", {
        templateUrl : "london.html",
        controller : "londonCtrl"
    })
    .when("/paris", {
        templateUrl : "paris.html",
        controller : "parisCtrl"
    });
});
app.controller("londonCtrl", function ($scope) {
    $scope.msg = "I love London";
});
app.controller("parisCtrl", function ($scope) {
    $scope.msg = "I love Paris";
});
