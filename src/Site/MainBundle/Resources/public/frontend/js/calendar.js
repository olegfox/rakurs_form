angular.element(document).ready(function () {

    $(".hide").removeClass("hide");

});

angular.
    module("calendar", []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{[{").endSymbol("}]}");
    })
    .controller("CalendarController", function ($scope, $http) {
        $scope.calendar = JSON.parse(window.calendar);

        $scope.days = {
            0 : "Пн",
            1 : "Вт",
            2 : "Ср",
            3 : "Чт",
            4 : "Пт",
            5 : "Сб",
            6 : "Вс"
        };

        $scope.couchs = JSON.parse(window.couchs);
        $scope.groups = JSON.parse(window.groups);

        console.log($scope.calendar);
        console.log($scope.couchs);
        console.log($scope.groups);

        $scope.typeTraining = "all";

        // Изменение типа тренировок
        $scope.typeChange = function() {
            var typeTraining = $("#type").val();

            angular.forEach($scope.calendar, function(keytime, keytimeIndex){
                angular.forEach(keytime, function(keyday, keydayIndex){
                    angular.forEach(keyday, function(training, trainingIndex){
                        if(training.typeTraining != undefined) {
                            if($scope.calendar[keytimeIndex][keydayIndex][trainingIndex].typeTraining.id == typeTraining || typeTraining === 'all') {
                                $scope.calendar[keytimeIndex][keydayIndex][trainingIndex].enable = true;
                            } else {
                                $scope.calendar[keytimeIndex][keydayIndex][trainingIndex].enable = false;
                            }
                        }
                    });
                });
            });
        };

        // Показать окошко с событием
        $scope.eventClick = function(e, id, currentTraining) {
            $(".tooltip").show();

            var left = $("#event" + id).offset().left + $("#event" + id).width()/2 - 119, // Center
                angleLeft = '109px';

            if((left + $(".tooltip").outerWidth()) > $('body, html').width()) {
                left -= (left + $(".tooltip").outerWidth()) - $('body, html').width() + 8;
                angleLeft = $("#event" + id).offset().left - left + $("#event" + id).outerWidth()/2 - $(".tooltip .angle").outerWidth()/2;
            }

            $scope.currentTraining = currentTraining;

            $(".tooltip").css({
               'top':  $("#event" + id).offset().top + $("#event" + id).outerHeight() + 12,
               'left': left
            });
            $(".tooltip .angle").css({
                'left': angleLeft
            });
        };

        // Закрыть окошка с событием
        $scope.eventClose = function() {
            $(".tooltip").hide();
        };

        // Переключение вкладок в окошке с событием
        $scope.tabChange = function(e) {
            $(".tooltip__tabs__item").removeClass("active");

            $(e.target).parent().addClass("active");
            $(".tooltip__tab__content").hide();
            $("#" + $(e.target).parent().data("rel")).show();
        };
    });

