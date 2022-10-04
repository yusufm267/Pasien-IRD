var app = angular.module('telekonsultasi', ['angularUtils.directives.dirPagination', 'ngTextTruncate', 'angular.chosen'])
.directive('castToInteger', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$parsers.unshift(function(value) {
                return parseInt(value, 10);
            });
        }
    };
})
.filter('fullFormatDate', function(){
	return function(tanggal) {
		var nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var tanggal_format = new Date(tanggal);
        var nama_hari_input = tanggal_format.getDay();
        if(typeof tanggal === 'undefined'){
        	return '';
        }else{
        	return nama_hari[nama_hari_input];
        }
    };
})
.directive('pressEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.pressEnter);
                });
                event.preventDefault();
            }
        });
    };
});

app.run(function($rootScope){
    $rootScope.lost_focus_index = true;
    $rootScope.abort_ajax = function(){
        $rootScope.ajaxRequest.abort();
        $rootScope.ajaxRequestDetail.abort();
    }
});