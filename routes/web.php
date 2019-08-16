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
Route::post('/menu', 'GameController@menu');

Route::post('/move', 'GameController@move');

Route::post('/combat', 'GameController@combat');

Route::post('/show_stats', 'GameController@show_stats');

Route::post('/train', 'GameController@train');

Route::post('/rest', 'GameController@rest');

Route::post('/equipment', 'GameController@equipment');

Route::post('/items', 'GameController@items');
Route::post('/item_pickup', 'GameController@item_pickup');

Route::get('/admin', 'AdminController@index');

Route::post('/admin/process', 'AdminController@process');

// Do this stuff better or different?

// TODO: Route these all through /admin and include an Auth Middleware
Route::get('room/all', 'RoomController@all');
Route::get('room/create', 'RoomController@create');
Route::get('room/edit/{id}', 'RoomController@edit')->where('id', '[0-9]+');
Route::post('room/save', 'RoomController@save');
Route::post('room/delete', 'RoomController@delete');

Route::get('zone/all', 'ZoneController@all');
Route::get('zone/create', 'ZoneController@create');
Route::get('zone/edit/{id}', 'ZoneController@edit')->where('id', '[0-9]+');
Route::post('zone/save', 'ZoneController@save');

Route::get('item/all', 'ItemController@all');
Route::get('item/create', 'ItemController@create');
Route::get('item/edit/{id}', 'ItemController@edit')->where('id', '[0-9]+');
Route::post('item/save', 'ItemController@save');
Route::get('item/get_item_type', 'ItemController@get_item_fields_ajax');

Route::get('npc/all', 'NpcController@all');
Route::get('npc/create', 'NpcController@create');
Route::get('npc/edit/{id}', 'NpcController@edit')->where('id', '[0-9]+');
Route::post('npc/save', 'NpcController@save');
// Additionals:
Route::post('npc/stats/save', 'NpcController@save_stats');
Route::post('npc/rewards/save', 'NpcController@save_rewards');
Route::post('npc/spawn/save', 'NpcController@save_spawns');
Route::post('npc/loot/save', 'NpcController@save_loot');


// Route::post('/equip', 'GameController@equip_item');