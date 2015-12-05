<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'man_payment' => 'PaymentController',
    'man_employee' => 'EmployeeController',
    'man_artwork' => 'ArtworkController',
    'man_exposition' => 'ExpositionController',
    'man_room' => 'RoomController',
    'man_spot' => 'SpotController',
    'man_equipment' => 'EquipmentController',
]);

Route::get('/user/account', ['middleware' => "user", "uses" => "AccountController@show"]);

Route::get('/admin/account', ['middleware' => "admin", "uses" => "AccountController@show"]);

Route::get('/about', function () { return view("about"); });

Route::get('/', 'HomeController@get');
