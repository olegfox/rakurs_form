angular.element(document).ready(function () {

    $(".hide").removeClass("hide");

});

angular.
    module("registration15", []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{[{").endSymbol("}]}");
    })
    .controller("RegistrationController", function ($scope, $http) {
        
    });

