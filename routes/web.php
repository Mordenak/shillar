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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/game', 'GameController@index');
Route::post('/menu', 'GameController@menu');

Route::post('/move', 'GameController@move');

Route::post('/combat', 'GameController@combat');

Route::post('/show_stats', 'GameController@show_stats');

Route::post('/train', 'GameController@train');
Route::post('/shop', 'GameController@shop');
Route::post('/shop/purchase', 'GameController@purchase');
Route::post('/shop/sell', 'GameController@sell');
Route::post('/game/forge', 'GameController@forge');

Route::post('/rest', 'GameController@rest');

Route::post('/equipment', 'GameController@equipment');
Route::post('/settings', 'GameController@settings');

Route::post('/items', 'GameController@items');
Route::post('/item_pickup', 'GameController@item_pickup');

Route::get('/admin', 'AdminController@index');

Route::post('/admin/process', 'AdminController@process');
// Admin bit:
Route::post('/admin/give_item', 'AdminController@give_item');

Route::post('/game/deposit', 'GameController@deposit');
Route::post('/game/withdraw', 'GameController@withdraw');
Route::post('/game/consider', 'GameController@consider');

// Do this stuff better or different?

// TODO: Route these all through /admin and include an Auth Middleware
Route::get('room/all', 'RoomController@all');
Route::get('room/create', 'RoomController@create');
Route::get('room/edit/{id}', 'RoomController@edit')->where('id', '[0-9]+');
Route::post('room/save', 'RoomController@save');
Route::post('room/delete', 'RoomController@delete');
// Autocomplete:

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

Route::get('character/all', 'CharacterController@all');
Route::get('character/edit/{id}', 'CharacterController@edit')->where('id', '[0-9]+');
Route::get('character/create', 'CharacterController@create');
Route::post('character/save', 'CharacterController@save');
// Route::post('character/save', 'ZoneController@save');

Route::get('user/all', 'UserController@all');
Route::get('user/edit/{id}', 'UserController@edit')->where('id', '[0-9]+');
Route::get('user/create', 'UserController@create');
Route::post('user/save', 'UserController@save');

Route::get('shop/all', 'ShopController@all');
Route::get('shop/create', 'ShopController@create');
Route::get('shop/edit/{id}', 'ShopController@edit')->where('id', '[0-9]+');
Route::post('shop/save', 'ShopController@save');
Route::post('shop/delete', 'ShopController@delete');

Route::get('forge/all', 'ForgeRecipeController@all');
Route::get('forge/create', 'ForgeRecipeController@create');
Route::get('forge/edit/{id}', 'ForgeRecipeController@edit')->where('id', '[0-9]+');
Route::post('forge/save', 'ForgeRecipeController@save');
Route::post('forge/delete', 'ForgeRecipeController@delete');

// Autocoimplete lookup routes:
Route::get('/item/lookup', 'ItemController@lookup');
Route::get('/room/lookup', 'RoomController@lookup');
Route::get('/room_property/lookup', 'RoomPropertyController@lookup');