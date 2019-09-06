var myApp =angular.module("myApp",["ngRoute"]);


myApp.config(function($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl: "index.blade.php",
            controller: "importController"
        })

})

myApp.controller("importController", function ($scope ,$http) {

    $scope.load = function () {

        $http.get('/index')

            .then(function success(e) {
                console.log(e);

            });
    };
    $scope.load();

    $scope.dataExcel={
        import_file:''

    };

    $scope.importExcel = function () {

        var payload = new FormData();
        var files = document.getElementById('import_file').files[0];
        payload.append('import_file',files);

        $http({
            method: 'POST',
            url: '/index/import',
            data: payload,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined},
            dataType: 'json',
        }).then(function successCallback(response) {
            console.log(response);
             alert('Success');

        }, function error(error) {
             alert('fail');
           $scope.recordErrors(error);
        });
    }

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.import_file) {
            $scope.errors.push(error.data.errors.import_file[0]);
        }
    }

})
