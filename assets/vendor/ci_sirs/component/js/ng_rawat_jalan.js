var app = angular.module('rawat_jalan', ['angularUtils.directives.dirPagination', 'ngTextTruncate', 'angular.chosen'])
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

.factory('myService',function(){
    var saveData = {};
    return {
        setdetails: function(value){
            saveData = value;
        },
        getdetails: function(){
            return saveData;
        }
    }
});

.service('detail',function(){
    return {
        setdetails: function(value){
            v = value;
        },
        getdetails: function(){
            return v;
        }
    }
});

app.all('*', function(req, res,next) {


    /**
     * Response settings
     * @type {Object}
     */
    var responseSettings = {
        "AccessControlAllowOrigin": req.headers.origin,
        "AccessControlAllowHeaders": "Content-Type,X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5,  Date, X-Api-Version, X-File-Name",
        "AccessControlAllowMethods": "POST, GET, PUT, DELETE, OPTIONS",
        "AccessControlAllowCredentials": true
    };

    /**
     * Headers
     */
    res.header("Access-Control-Allow-Credentials", responseSettings.AccessControlAllowCredentials);
    res.header("Access-Control-Allow-Origin",  responseSettings.AccessControlAllowOrigin);
    res.header("Access-Control-Allow-Headers", (req.headers['access-control-request-headers']) ? req.headers['access-control-request-headers'] : "x-requested-with");
    res.header("Access-Control-Allow-Methods", (req.headers['access-control-request-method']) ? req.headers['access-control-request-method'] : responseSettings.AccessControlAllowMethods);

    if ('OPTIONS' == req.method) {
        res.send(200);
    }
    else {
        next();
    }


});

app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

app.run(function($rootScope){
    $rootScope.lost_focus_index = true;
    $rootScope.abort_ajax = function(){
        $rootScope.ajaxRequest.abort();
        $rootScope.ajaxRequestDetail.abort();
    }
});