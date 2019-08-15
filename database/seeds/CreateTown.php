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
			['zones_id' => 2, 'title' => null, 'description' => null, 'spawns_enabled' => true, 'north_rooms_id' => 8, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npcs')->insert([
			['name' => 'Town Guard', 'attack_text' => 'Town Guard attacks you with his shiney sword.', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'health' => 125000, 'armor' => 0.1, 'damage_low' => 1, 'damage_high' => 60, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.33, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
