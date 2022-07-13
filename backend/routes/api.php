<?php
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::any('signup', 'App\Http\Controllers\AuthController@signup');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

//using jwt

//Route::any('/signin','App\Http\Controllers\jwtAuthController@Signin');
// $router->post('/logoutuser','jwtAuthController@LogoutUser');
// $router->post('/me','jwtAuthController@me');
// $router->post('/refresh','jwtAuthController@refresh');
// Route::get('/hello',function(){
//     return "hello"; });