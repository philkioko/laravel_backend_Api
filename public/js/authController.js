(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('AuthController', AuthController); 


    function AuthController($auth, $state,$scope,$http,$rootScope) { 

        $scope.formData=this;

        var adminId ="2";
        var userId  ="3";

        $scope.login = function() {
            
            var credentials = {
                email: $scope.formData.email,
                password:$scope.formData.password
            }
            // Use Satellizer's $auth service to login
            $auth.login(credentials).then(function() {
                $scope.loginuser=true;
                $scope.validateerror=false; 
                $scope.wrongentry=false;
                // Return an $http request for the now authenticated
                // user so that we can flatten the promise chain 
                return $http.get('http://localhost:8000/api/user');

            // Handle errors
            }, function(error) {
                if (error.status==401) {
                 $scope.validateerror=true; 
                 $scope.rongentry=false;
               }else if(error.status==400){
                $scope.wrongentry=true;
                $scope.validateerror=false; 
               }

            // Because we returned the $http.get request in the $auth.login
            // promise, we can chain the next promise to the end here
            }).then(function(response) {
                // Stringify the returned data to prepare it
                // to go into local storage
                var user = JSON.stringify(response.data);
                var role = JSON.stringify(response.data.role);
                // Set the stringified user data into local storage
                localStorage.setItem('user', user);
                console.log(response);

                // The user's authenticated state gets flipped to
                // true so we can now show parts of the UI that rely
                // on the user being logged in
                $rootScope.authenticated = true;

                // Putting the user's data on $rootScope allows
                // us to access it anywhere across the app
                $rootScope.currentUser = response.data.user;
                var access=response.data.role.role_id;
                if (access==adminId) {
                    console.log("am admin");
                }else if(access==userId) {
                    console.log("am a user");
                }
                // $state.go('users');
            });
        }

        $scope.logout = function() {
        $auth.logout().then(function() {
             $rootScope.currentUser = null;
             $rootScope.currentRole= null;
        });
    }

    }

})();