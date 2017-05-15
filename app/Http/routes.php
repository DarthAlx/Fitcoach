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
    return view('inicio');
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
