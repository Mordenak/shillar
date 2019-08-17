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
			['name' => 'Beach', 'description' => 'You are standing on the Beach.', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
		]);

		DB::table('rooms')->insert([
			['zones_id' => 1, 'title' => 'The Fountain', 'description' => 'Special unique description', 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 2, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 3, 'west_rooms_id' => 1, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 2, 'east_rooms_id' => null, 'south_rooms_id' => 4, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 3, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 5, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 4, 'south_rooms_id' => 6, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 5, 'east_rooms_id' => null, 'south_rooms_id' => 7, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 6, 'east_rooms_id' => 8, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 9, 'west_rooms_id' => 7, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => 'Beach Entrance', 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 8, 'east_rooms_id' => null, 'south_rooms_id' => 10, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 11, 'east_rooms_id' => null, 'south_rooms_id' => 2, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 10
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 10, 'west_rooms_id' => 12, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 13, 'east_rooms_id' => 11, 'south_rooms_id' => 9, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 14, 'east_rooms_id' => null, 'south_rooms_id' => 12, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 13, 'west_rooms_id' => 15, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 16, 'east_rooms_id' => 14, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => 'Outskirts Entrance', 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 15, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 16:
			// A few beach entries:
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 9, 'east_rooms_id' => null, 'south_rooms_id' => 18, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 17, 'east_rooms_id' => 19, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 18, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// end 19:
			// Outskirts:
			['zones_id' => 3, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 21, 'east_rooms_id' => null, 'south_rooms_id' => 16, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 20, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			
		]);

		DB::table('npcs')->insert([
			['name' => 'Town Guard', 'attack_text' => 'Town Guard attacks you with his shiney sword.', 'custom_img' => 'townguard.jpg', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Hermit Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'custom_img' => 'HermitCrab.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'custom_img' => 'Crab.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Stone Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'custom_img' => 'StoneCrab.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'health' => 125000, 'armor' => 0.1, 'damage_low' => 60, 'damage_high' => 60, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 2, 'health' => 75, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 20, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'health' => 100, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 28, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 4, 'health' => 125, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 35, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.48, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 2, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 3, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 4, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('reward_tables')->insert([
			['npcs_id' => 1, 'award_xp' => 0, 'xp_variation' => 0, 'award_gold' => 0, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 2, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 4, 'award_xp' => 550, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('items')->insert([
			['name' => 'Crab legs', 'item_types_id' => 4, 'value' => 0, 'weight' => 0.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_consumables')->insert([
			['items_id' => 1, 'name' => 'Crab legs', 'effect' => 'healing', 'potency' => 13, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 2, 'items_id' => 1, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'items_id' => 1, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
