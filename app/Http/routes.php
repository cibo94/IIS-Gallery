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
    'man_employee' => 'Inserters\EmployeeInsertController',
    'man_artwork' => 'Inserters\ArtworkInsertController',
    'man_exposition' => 'Inserters\ExpositionInsertController',
    'man_room' => 'Inserters\RoomInsertController',
    'man_spot' => 'Inserters\SpotInsertController',
    'man_equipment' => 'Inserters\EquipmentInsertController',
]);

Route::get('/user/account', ['middleware' => "user", "uses" => "AccountController@show"]);

Route::get('/admin/account', ['middleware' => "admin", "uses" => "AccountController@show"]);

Route::get('/exhibition', "ExhibitionController@getGuests");

Route::get('/user/exhibition', ["middleware" => "user", "uses" => "ExhibitionController@getUsers" ]);

Route::get('/admin/exhibition', ["middleware" => "admin", "uses" => "ExhibitionController@getAdmins" ]);

Route::get('/about', function () { return view("about"); });

Route::get('/', 'HomeController@get');
