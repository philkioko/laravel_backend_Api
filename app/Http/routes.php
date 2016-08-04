<?php

Route::get('/','\App\Http\Controllers\HomeController@index');
$api = app('Dingo\Api\Routing\Router');

  $api->version('v1', function ($api) {
  $api->group(['middleware' => 'cors'], function ($api) {
  $api->post('/login','\App\Http\Controllers\Auth\AuthController@authentications');
  $api->post('/signup','\App\Http\Controllers\Auth\AuthController@create');

     //check existence of token//
 $api->group(['middleware' => ['jwt.auth']], function ($api) {
                /* get users*/
       $api->get('/Users',  '\App\Http\Controllers\HomeController@Users');
       $api->get('/user',   '\App\Http\Controllers\HomeController@getAuthenticatedUser');
       $api->post('password/email', '\App\Http\Controllers\Auth\PasswordController@sendResetLinkEmail');
       $api->post('password/reset', '\App\Http\Controllers\Auth\PasswordController@reset');
       
     });
//find out how to manage logout with jwt//
  $api->group(['middleware' => ['jwt.auth', 'jwt.refresh']], function($api){
     $api->get('/logout','\App\Http\Controllers\Auth\AuthController@logout');
   });

  });
});
