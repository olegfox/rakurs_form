angular.element(document).ready(function () {

    $(".hide").removeClass("hide");

});

angular.
    module("registration14", []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{[{").endSymbol("}]}");
    })
    .controller("RegistrationController", function ($scope, $http) {

    });

