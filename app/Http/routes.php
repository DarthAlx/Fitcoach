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

Route::get('/', function () {

$usuario = App\User::find(1);

    return view('inicio', ['usuario'=>$usuario]) ;
});

Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/proximamente', function () {
    return view('proximamente');
});

Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/clasesdeportivas', function () {
    return view('clasesdeportivas');
});

Route::get('/aviso', function () {
    return view('aviso');
});




// Authentication routes...
Route::get('entrar', 'Auth\AuthController@getLogin');
Route::post('entrar', 'Auth\AuthController@postLogin');
Route::get('salir', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('registro', 'Auth\AuthController@getRegister');
Route::post('registro', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}/{email}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//DetallesController
Route::get('completar-registro', 'DetallesController@create');
Route::post('completar-registro', 'DetallesController@store');
