(function(){

	'use strict';

	angular
	  	 .module('authApp')
	  	 .controller('UserController', UserController);

	  	 function UserController($http,$scope,$auth,$rootScope,$state){
	  	 	$scope.userz=this;
	  	 	// vm.users;
	  	 	// vm.errors;

	  	 	$scope.getUsers=function(){
	  	 		$http.get('http://localhost:8000/api/Users').success(function(data) {
                $scope.userz = data;
                console.log(data);
            })
	  	 		.catch(function(error) {
                // $scope.error = error.status;
                console.log(error.status);
            });
	  	 	}

	  	 	$scope.logout=function(){
	  	    $auth.logout().then(function() {
	  	 		// Remove the authenticated user from local storage
	  	 		localStorage.removeItem('user');
	  	 		// return $http::get('http://localhost:8000/api/logout');
	  	 		// Flip authenticated to false so that we no longer
                // show UI elements dependant on the user being logged in//
	  	 		$rootScope.authenticated=false;
	  	 		// Remove the current user info from rootscope
	  	 		$rootScope.currentUser=null;

	  	 		//redirect to login//
	  	 		$state.go('auth');
	  	 	});
	  	 	}
	  	 }

})();