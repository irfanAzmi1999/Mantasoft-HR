var validationApp = angular.module('validationApp', []);
validationApp.controller('mainController', function ($scope) {
    $scope.submitForm = function (isValid) {
        if (isValid) {
        	Swal.alert(
        		'Thanks for your suggestion!',
        		'Your suggestion will be helpful for us to improve this website.',
                'success'
            )
        	document.getElementById("forms").reset();
        } else {
        	Swal.alert(
        		'Something went wrong!',
        		'Ensure that you have filled all required data<br/> and are filled correctly.',
                'error'
            )
        }
    };
});