<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTown extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('zones')->insert([
			['name' => 'Town', 'description' => 'You are standing on a street in Town.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Beach', 'description' => 'You are standing on the Beach.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Outskirts', 'description' => 'You are standing in the Outskirts.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('rooms')->insert([
			['zones_id' => 1, 'title' => 'The Fountain', 'description' => 'Special unique description', 'spawns_enabled' => false, 'north_rooms_id' => 28, 'east_rooms_id' => 2, 'south_rooms_id' => 29, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 10, 'east_rooms_id' => 22, 'south_rooms_id' => 3, 'west_rooms_id' => 1, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 2, 'east_rooms_id' => null, 'south_rooms_id' => 4, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 3, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 5, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 4, 'south_rooms_id' => 6, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 5, 'east_rooms_id' => null, 'south_rooms_id' => 7, 'west_rooms_id' => 27, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 6, 'east_rooms_id' => 8, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 9, 'west_rooms_id' => 7, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => 'Beach Entrance', 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 8, 'east_rooms_id' => null, 'south_rooms_id' => 17, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 11, 'east_rooms_id' => 30, 'south_rooms_id' => 2, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 10
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 10, 'west_rooms_id' => 12, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 13, 'east_rooms_id' => 11, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 14, 'east_rooms_id' => null, 'south_rooms_id' => 12, 'west_rooms_id' => 31, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 13, 'west_rooms_id' => 15, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 16, 'east_rooms_id' => 14, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => 'Outskirts Entrance', 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 20, 'east_rooms_id' => null, 'south_rooms_id' => 15, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 16:
			// A few beach entries:
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 9, 'east_rooms_id' => null, 'south_rooms_id' => 18, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 17, 'east_rooms_id' => 19, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 18, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// end 19:
			// Outskirts:
			['zones_id' => 3, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 21, 'east_rooms_id' => null, 'south_rooms_id' => 16, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 20, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// More town @ 22:
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 23, 'south_rooms_id' => null, 'west_rooms_id' => 2, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 24, 'south_rooms_id' => null, 'west_rooms_id' => 22, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 25, 'west_rooms_id' => 23, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 24, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 26, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Training Room', 'description' => 'You are standing in the training room.', 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 25, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Wall score 27:
			['zones_id' => 1, 'title' => 'Wall of Flame', 'description' => 'Before you is the Wall of Flame.', 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 6, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Inventory?', 'description' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 1, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Quest Log', 'description' => null, 'spawns_enabled' => false, 'north_rooms_id' => 1, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Mayor', 'description' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 10, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 30
			['zones_id' => 1, 'title' => 'Food Shop?', 'description' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 13, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('room_property_rooms')->insert([
			['rooms_id' => 1, 'room_properties_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 26, 'room_properties_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 27, 'room_properties_id' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);


		DB::table('shops')->insert([
			['rooms_id' => 31, 'name' => 'Food Shop', 'description' => 'The food shop', 'buys_weapons' => true, 'buys_armors' => true, 'buys_accessories' => true, 'buys_consumables' => true, 'buys_others' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npcs')->insert([
			['name' => 'Town Guard', 'attack_text' => 'Town Guard attacks you with his shiney sword.', 'img_src' => 'townguard.jpg', 'is_hostile' => false, 'health' => 125000, 'armor' => 0.1, 'damage_low' => 60, 'damage_high' => 60, 'attacks_per_round' => 1, 'award_xp' => 0, 'xp_variation' => 0, 'award_gold' => 0, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Hermit Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'HermitCrab.jpg', 'is_hostile' => true, 'health' => 75, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 20, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'Crab.jpg', 'is_hostile' => true, 'health' => 100, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 28, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Stone Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'StoneCrab.jpg', 'is_hostile' => true, 'health' => 125, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 35, 'attacks_per_round' => 1, 'award_xp' => 550, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.48, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 2, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 3, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 4, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('items')->insert([
			['name' => 'Knife', 'item_types_id' => 1, 'value' => 2500, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Shield', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Helm', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Neckband', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Shirt', 'item_types_id' => 2, 'value' => 4500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Gloves', 'item_types_id' => 2, 'value' => 2000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Pants', 'item_types_id' => 2, 'value' => 4000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Boots', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Blue Amulet', 'item_types_id' => 3, 'value' => 10000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Glowing Ring', 'item_types_id' => 3, 'value' => 5000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// end 10
			['name' => 'Green Bracelet', 'item_types_id' => 3, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab legs', 'item_types_id' => 4, 'value' => 0, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);


		DB::table('shop_items')->insert([
			['shops_id' => 1, 'items_id' => 1, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 2, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 3, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 4, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 5, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 6, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 7, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 8, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 9, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 10, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 11, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 12, 'price' => 1, 'markup' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_weapons')->insert([
			['items_id' => 1, 'name' => 'Knife', 'equipment_slot' => 1, 'attack_text' => 'Your knife does damage', 'damage_low' => 5, 'damage_high' => 15, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_armors')->insert([
			['items_id' => 2, 'name' => 'Leather Shield', 'equipment_slot' => 2, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 3, 'name' => 'Leather Helm', 'equipment_slot' => 3, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 4, 'name' => 'Leather Neckband', 'equipment_slot' => 4, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 5, 'name' => 'Leather Shirt', 'equipment_slot' => 5, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 6, 'name' => 'Leather Gloves', 'equipment_slot' => 6, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 7, 'name' => 'Leather Pants', 'equipment_slot' => 7, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 8, 'name' => 'Leather Boots', 'equipment_slot' => 8, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_accessories')->insert([
			['items_id' => 9, 'name' => 'Blue Amulet', 'equipment_slot' => 9, 'strength_bonus' => 10, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 10, 'name' => 'Glowing Ring', 'equipment_slot' => 10, 'strength_bonus' => 5, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 11, 'name' => 'Green Bracelet', 'equipment_slot' => 11, 'strength_bonus' => 20, 'dexterity_bonus' => 20, 'constitution_bonus' => null, 'wisdom_bonus' => 20, 'intelligence_bonus' => null, 'charisma_bonus' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_consumables')->insert([
			['items_id' => 12, 'name' => 'Crab legs', 'effect' => 'healing', 'potency' => 13, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 2, 'items_id' => 12, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'items_id' => 12, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
