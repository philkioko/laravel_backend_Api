
(function(){

'use strict';

angular
        .module('authApp')
        .controller('RegisterController',RegisterController); 

	      function RegisterController( $state,$scope,$http,$auth,$rootScope,$timeout){ 

	      	$scope.formData=this;

	      	$scope.signup= function(){

	      		var credentials={
	      			firstname    :$scope.formData.firstname,
	      			lastname     :$scope.formData.lastname,
	      			email        :$scope.formData.email,
	      			password     :$scope.formData.password,
	      			passwordconfirmation:$scope.formData.passwordconfirmation
	      		}
	      		$auth.signup(credentials)
	      		.then(function(data){
	      			if (data.status==200) {
	      				$scope.usersuccess=true;
	      				 $scope.erroremail=false;
	      				$scope.validationerror=false;
	      				$timeout(function() {
	      					$scope.loader=false;
				       $state.go('auth');
				      }, 3000);  
					    
	      			}
	      			
	      		})
	      		.catch(function(error){
	      			if (error.status==400) {
	      			 $scope.erroremail=true;
	      			 $scope.validationerror=false;
	      			 $scope.usersuccess=false;
	      			}
	      			else if(error.status==401){
	      			$scope.validationerror=true;
	      			$scope.erroremail=false;
	      			$scope.usersuccess=false;
	      			}
	      			
	      		});
	      	}

	    }

	    function RegisterController( $state,$scope,$http){
	    	$scope.formData=this;

	      	$scope.passwordreset= function(){
	      		var data=$scope.formData.emails;
	      		console.log(data);
	      		$http({
	      			method:'POST',
	      			url:'http://localhost:8000/api/password/email',
	      			data:$.param(data),
	      			headers: { 'Authorization':'satellizer_token','Content-Type':'application/json'},
	      		})
	      		.then(function(data){
	      			console.log(data);
	      		}).catch(function(error){
	      			console.log(error);
	      		});
	      	}
	    }
})();