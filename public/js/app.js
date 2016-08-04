(function(){

    'use strict';

    angular
           .module('authApp', ['ui.router', 'satellizer'])

           .config(function($stateProvider, $urlRouterProvider, $authProvider, $provide,$locationProvider){

                  var a=localStorage.getItem('user');
                   
                    $authProvider.loginUrl='http://localhost:8000/api/login';
                    $authProvider.signupUrl='http://localhost:8000/api/signup';
                    // Redirect to the auth state if any other states
                    // are requested other than users
    
                    $stateProvider
                    .state('auth',{
                        url:'/auth',
                        templateUrl:'views/user_pages/loginform.html',
                        controller:'AuthController as auth'
                    })
                    .state('users',{
                        url:'/users',
                        templateUrl:'views/admin_partials/userView.html',
                        controller:'UserController as user'
                    })
                    .state('about',{
                        url:'/about',
                        templateUrl:'views/user_pages/about.html',
                        controller:'aboutController as about'
                    })
                    .state('contact',{
                        url:'/contact',
                        templateUrl:'views/user_pages/contact.html'
                        // controller:'contactController as contact'
                    })
                    .state('register',{
                        url:'/register',
                        templateUrl:'views/user_pages/signup.html',
                        controller:'RegisterController as register' 
                    })
                    .state('forgotpassword',{
                        url:'/forgotpassword',
                        templateUrl:'views/user_pages/forgotpwd.html',
                        controller:'RegisterController as forgotpassword'
                    });


                     // use the HTML5 History API
                    // $locationProvider.html5Mode(true);
           });

})();