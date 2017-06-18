<?php

use Dingo\Api\Routing\Router;

// CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

/** @var Router $api */
$api = app('api.router');

$api->version('v1', function ($api) {
  $api->group(['prefix' => 'auth', 'middleware' => 'cors'], function(Router $api) {
    $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
    $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
    $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');

    $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    $api->get('refresh', 'App\Api\V1\Controllers\LoginController@refresh');
  });
  $api->group(['middleware' => 'cors'], function ($api) {
    $api->post('bottle/store', 'App\Api\V1\Controllers\BottleController@store');
    $api->get('bottle', 'App\Api\V1\Controllers\BottleController@index');
  });


  $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
    $api->get('protected', function() {
      return response()->json([
        'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
      ]);
    });
    $api->get('refresh', ['middleware' => 'jwt.refresh', function() {
        return response()->json([
          'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
        ]);
      }
    ]);
  });


});
