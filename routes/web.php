<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('player/{id}', 'PlayerController@show')->where('id', '[0-9]+');

Route::get('character/create', 'CharacterController@create');

Route::post('character/save', 'CharacterController@save');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/game', 'GameController@index');

Route::post('/move', 'GameController@move');