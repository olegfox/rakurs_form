angular.element(document).ready(function () {

    $(".hide").removeClass("hide");

});

angular.
    module("registration", []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{[{").endSymbol("}]}");
    })
    .controller("RegistrationController", function ($scope, $http) {
        $("#timer")
            .countdown(window.timer_register, function(event) {
                $(this).text(
                    event.strftime('%D дн.')
                );
            });

        $scope.submit = function() {

            var $form = jQuery('form');

            var load = $.modal("", {overlayClose: true});

            $http({
                method: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function() {
                load.close();
                $.modal("Спасибо за регистрацию! Вы получите подтверждение регистрации на указанный электронный адрес.", {overlayClose: true});
                $form.get(0).reset();
            }, function(){
                load.close();
                $.modal("Ошибка отправки! Попробуйте еще раз.", {overlayClose: true});
            });

            return false;

        };
    });

