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

// Route::get('/', 'HomeController@welcome');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/game', 'GameController@index');
Route::post('/menu', 'GameController@menu');
Route::post('/footer', 'GameController@footer');

Route::post('/move', 'GameController@move');

Route::post('/combat', 'GameController@combat');

Route::post('/show_stats', 'GameController@show_stats');

Route::post('/train', 'GameController@train');
Route::post('/spells/train', 'GameController@train_spell');
Route::post('/spells', 'GameController@spells');
Route::post('/spells/cast', 'GameController@cast_spell');
Route::post('/shop', 'GameController@shop');
Route::post('/shop/purchase', 'GameController@purchase');
Route::post('/shop/sell', 'GameController@sell');
Route::post('/game/forge', 'GameController@forge');

Route::post('/rest', 'GameController@rest');

Route::post('/equipment', 'GameController@equipment');
Route::post('/settings', 'GameController@settings');

Route::post('/food', 'GameController@food');
Route::post('/item_pickup', 'GameController@item_pickup');
Route::post('/item_drop', 'GameController@item_drop');
Route::post('/treasure_loot', 'GameController@treasure_loot');

Route::get('/admin', 'AdminController@index');
Route::post('/tester_options', 'AdminController@tester_options');

Route::post('/admin/process', 'AdminController@process');
// Admin bit:
Route::post('/admin/give_item', 'AdminController@give_item');
Route::get('/admin/creature_dump', 'CreatureController@seed_dump');

Route::post('/game/deposit', 'GameController@deposit');
Route::post('/game/withdraw', 'GameController@withdraw');
Route::post('/game/consider', 'GameController@consider');
Route::post('/game/teleport', 'GameController@teleport');
Route::post('/game/choose_alignment', 'GameController@choose_alignment');

Route::post('/character/update_settings', 'CharacterController@update_settings');
Route::post('/room_action/attempt', 'GameController@process_action');

Route::post('/trade', 'GameController@trade');
Route::post('/trade/receive', 'GameController@receive');
Route::post('/trade/send', 'GameController@send');
// Do this stuff better or different?

Route::post('/chat/message', 'GameController@chat_message');

Route::get('/admin/zone-editor', 'AdminController@zone_editor');
Route::post('/admin/zone_select', 'AdminController@zone_select');
Route::post('/admin/zone_builder', 'AdminController@zone_builder');

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
Route::post('zone/delete', 'ZoneController@delete');

Route::get('zone_area/all', 'ZoneAreaController@all');
Route::get('zone_area/create', 'ZoneAreaController@create');
Route::get('zone_area/edit/{id}', 'ZoneAreaController@edit')->where('id', '[0-9]+');
Route::post('zone_area/save', 'ZoneAreaController@save');
Route::post('zone_area/delete', 'ZoneAreaController@delete');

Route::get('item/all', 'ItemController@all');
Route::get('item/create', 'ItemController@create');
Route::get('item/edit/{id}', 'ItemController@edit')->where('id', '[0-9]+');
Route::post('item/save', 'ItemController@save');
Route::get('item/get_item_type', 'ItemController@get_item_fields_ajax');

Route::get('creature/all', 'CreatureController@all');
Route::get('creature/create', 'CreatureController@create');
Route::get('creature/edit/{id}', 'CreatureController@edit')->where('id', '[0-9]+');
Route::post('creature/save', 'CreatureController@save');
Route::post('creature/delete', 'CreatureController@delete');

Route::get('creature_group/all', 'CreatureGroupController@all');
Route::get('creature_group/create', 'CreatureGroupController@create');
Route::get('creature_group/edit/{id}', 'CreatureGroupController@edit')->where('id', '[0-9]+');
Route::post('creature_group/save', 'CreatureGroupController@save');
Route::post('creature_group/delete', 'CreatureGroupController@delete');

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

Route::get('room_action/all', 'RoomActionController@all');
Route::get('room_action/create', 'RoomActionController@create');
Route::get('room_action/edit/{id}', 'RoomActionController@edit')->where('id', '[0-9]+');
Route::post('room_action/save', 'RoomActionController@save');
Route::post('room_action/delete', 'RoomActionController@delete');

Route::get('quest/all', 'QuestController@all');
Route::get('quest/create', 'QuestController@create');
Route::get('quest/edit/{id}', 'QuestController@edit')->where('id', '[0-9]+');
Route::post('quest/save', 'QuestController@save');
Route::post('quest/delete', 'QuestController@delete');

Route::get('spell/all', 'SpellController@all');
Route::get('spell/create', 'SpellController@create');
Route::get('spell/edit/{id}', 'SpellController@edit')->where('id', '[0-9]+');
Route::post('spell/save', 'SpellController@save');
Route::post('spell/delete', 'SpellController@delete');

Route::get('teleport/all', 'TeleportTargetController@all');
Route::get('teleport/create', 'TeleportTargetController@create');
Route::get('teleport/edit/{id}', 'TeleportTargetController@edit')->where('id', '[0-9]+');
Route::post('teleport/save', 'TeleportTargetController@save');
Route::post('teleport/delete', 'TeleportTargetController@delete');

Route::get('race/all', 'RaceController@all');
Route::get('race/edit/{id}', 'RaceController@edit')->where('id', '[0-9]+');
Route::get('race/create', 'RaceController@create');
Route::post('race/save', 'RaceController@save');

// Autocoimplete lookup routes:
Route::get('/item/lookup', 'ItemController@lookup');
Route::get('/room/lookup', 'RoomController@lookup');
Route::get('/creature/lookup', 'CreatureController@lookup');
Route::get('/zone/lookup', 'ZoneController@lookup');
Route::get('/zone_area/lookup', 'ZoneAreaController@lookup');
Route::get('/room_property/lookup', 'RoomPropertyController@lookup');
Route::get('/character/lookup', 'CharacterController@lookup');
Route::get('/zone_property/placeholder', 'ZoneController@placeholder');