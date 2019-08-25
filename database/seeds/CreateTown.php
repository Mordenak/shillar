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
			['name' => 'Town', 'description' => 'You are standing on a street in Town.', 'intelligence_req' => 0, 'darkness_level' => 0, 'img_src' => null, 'bg_color' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Beach', 'description' => 'You are standing on the Beach.', 'intelligence_req' => 0, 'darkness_level' => 0, 'img_src' => 'beach.gif', 'bg_color' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Outskirts', 'description' => 'You are standing in the Outskirts.', 'intelligence_req' => 40, 'darkness_level' => 0, 'img_src' => null, 'bg_color' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Sewers', 'description' => 'You are standing in the dismal sewers.', 'intelligence_req' => 60, 'darkness_level' => 1, 'img_src' => null, 'bg_color' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('rooms')->insert([
			['zones_id' => 1, 'title' => 'The Fountain', 'description' => 'Special unique description', 'img_src' => 'fountain.gif', 'spawns_enabled' => false, 'north_rooms_id' => 28, 'east_rooms_id' => 2, 'south_rooms_id' => 29, 'west_rooms_id' => 32, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 10, 'east_rooms_id' => 22, 'south_rooms_id' => 3, 'west_rooms_id' => 1, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 2, 'east_rooms_id' => null, 'south_rooms_id' => 4, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 3, 'east_rooms_id' => 41, 'south_rooms_id' => null, 'west_rooms_id' => 5, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 4, 'south_rooms_id' => 6, 'west_rooms_id' => 56, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 5, 'east_rooms_id' => 51, 'south_rooms_id' => 7, 'west_rooms_id' => 27, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 6, 'east_rooms_id' => 8, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 9, 'west_rooms_id' => 7, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => 'Beach Entrance', 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 8, 'east_rooms_id' => null, 'south_rooms_id' => 17, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 11, 'east_rooms_id' => 30, 'south_rooms_id' => 2, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 10
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 82, 'south_rooms_id' => 10, 'west_rooms_id' => 12, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 13, 'east_rooms_id' => 11, 'south_rooms_id' => null, 'west_rooms_id' => 68, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 14, 'east_rooms_id' => null, 'south_rooms_id' => 12, 'west_rooms_id' => 31, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 13, 'west_rooms_id' => 15, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 16, 'east_rooms_id' => 14, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => 'Outskirts Entrance', 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 20, 'east_rooms_id' => null, 'south_rooms_id' => 15, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 16:
			// A few beach entries:
			['zones_id' => 2, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 9, 'east_rooms_id' => null, 'south_rooms_id' => 18, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 17, 'east_rooms_id' => 19, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 18, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// end 19:
			// Outskirts:
			['zones_id' => 3, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 21, 'east_rooms_id' => null, 'south_rooms_id' => 16, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 20, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// More town @ 22:
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 23, 'south_rooms_id' => null, 'west_rooms_id' => 2, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 24, 'south_rooms_id' => null, 'west_rooms_id' => 22, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 50, 'east_rooms_id' => 47, 'south_rooms_id' => 25, 'west_rooms_id' => 23, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 24, 'east_rooms_id' => null, 'south_rooms_id' => 43, 'west_rooms_id' => 26, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Training Room', 'description' => 'You are standing in the training room.', 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 25, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Wall score 27:
			['zones_id' => 1, 'title' => 'Wall of Flame', 'description' => 'Before you is the Wall of Flame.', 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 6, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Inventory?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 1, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Quest Log', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 1, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Mayor', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 10, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 30
			['zones_id' => 1, 'title' => 'Food Shop?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 13, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Build more town:
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 79, 'east_rooms_id' => 1, 'south_rooms_id' => 66, 'west_rooms_id' => 33, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 39, 'east_rooms_id' => 32, 'south_rooms_id' => null, 'west_rooms_id' => 34, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 33, 'south_rooms_id' => 40, 'west_rooms_id' => 35, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 80, 'east_rooms_id' => 34, 'south_rooms_id' => null, 'west_rooms_id' => 36, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 35, 'south_rooms_id' => null, 'west_rooms_id' => 37, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 36, 'south_rooms_id' => 38, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 37, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Stack Shop', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 33, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Mana Users Guild?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 34, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// END 40
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 42, 'south_rooms_id' => null, 'west_rooms_id' => 4, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 43, 'south_rooms_id' => 52, 'west_rooms_id' => 41, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 25, 'east_rooms_id' => 44, 'south_rooms_id' => null, 'west_rooms_id' => 42, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 46, 'east_rooms_id' => null, 'south_rooms_id' => 45, 'west_rooms_id' => 43, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Rentals', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 44, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Villager Informant?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 44, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 48, 'south_rooms_id' => null, 'west_rooms_id' => 24, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Sewers Entrance', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 49, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 47, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Jail?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 48, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Kills Wall', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 24, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 50
			['zones_id' => 1, 'title' => 'Bank', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 6, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 42, 'east_rooms_id' => 55, 'south_rooms_id' => 54, 'west_rooms_id' => 53, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Fire Temple?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 52, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Gems?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 52, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Thieves Guild?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 52, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 55
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 66, 'east_rooms_id' => 5, 'south_rooms_id' => null, 'west_rooms_id' => 57, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 56, 'south_rooms_id' => null, 'west_rooms_id' => 58, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 57, 'south_rooms_id' => 64, 'west_rooms_id' => 59, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 63, 'east_rooms_id' => 58, 'south_rooms_id' => null, 'west_rooms_id' => 60, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 61, 'east_rooms_id' => 59, 'south_rooms_id' => 62, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 60
			['zones_id' => 1, 'title' => 'Validator?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 60, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Trader Bob', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 60, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Air Temple', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 59, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 58, 'east_rooms_id' => null, 'south_rooms_id' => 65, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'The Trinket Exchange', 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 64, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 65
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 32, 'east_rooms_id' => null, 'south_rooms_id' => 56, 'west_rooms_id' => 67, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Graveyard?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 66, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 12, 'south_rooms_id' => 79, 'west_rooms_id' => 69, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 68, 'south_rooms_id' => null, 'west_rooms_id' => 70, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 75, 'east_rooms_id' => 69, 'south_rooms_id' => null, 'west_rooms_id' => 71, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 70
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 70, 'south_rooms_id' => 80, 'west_rooms_id' => 72, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 73, 'east_rooms_id' => 71, 'south_rooms_id' => 74, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Spells Wall?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 72, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Courier Corp?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 72, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 77, 'east_rooms_id' => 78, 'south_rooms_id' => 70, 'west_rooms_id' => 76, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 75
			['zones_id' => 1, 'title' => 'Scrolls?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 75, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Spells?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 75, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Water Temple', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 75, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 68, 'east_rooms_id' => null, 'south_rooms_id' => 32, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 69, 'east_rooms_id' => 81, 'south_rooms_id' => 35, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 80
			['zones_id' => 1, 'title' => 'Hotel?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 80, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 83, 'south_rooms_id' => null, 'west_rooms_id' => 11, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 89, 'east_rooms_id' => 84, 'south_rooms_id' => 88, 'west_rooms_id' => 82, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => null, 'east_rooms_id' => 85, 'south_rooms_id' => null, 'west_rooms_id' => 83, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 86, 'east_rooms_id' => null, 'south_rooms_id' => 87, 'west_rooms_id' => 84, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 85
			['zones_id' => 1, 'title' => 'Trader Jack', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 85, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Fighter Guild?', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 85, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Earth Temple', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => 83, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => null, 'description' => null, 'img_src' => null, 'spawns_enabled' => true, 'north_rooms_id' => 91, 'east_rooms_id' => 92, 'south_rooms_id' => 83, 'west_rooms_id' => 90, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Forge', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => 89, 'south_rooms_id' => null, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			// End 90
			['zones_id' => 1, 'title' => 'Weapons Shop', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 89, 'west_rooms_id' => null, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
			['zones_id' => 1, 'title' => 'Armor Shop', 'description' => null, 'img_src' => null, 'spawns_enabled' => false, 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => 89, 'up_rooms_id' => null, 'down_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at	' => date("Y-m-d H:i:s")],
		]);

		// Apply room properties?
		DB::table('rooms')->updateOrInsert(['id' => 1], ['room_properties_id' => 1]);
		DB::table('rooms')->updateOrInsert(['id' => 26], ['room_properties_id' => 2]);
		DB::table('rooms')->updateOrInsert(['id' => 27], ['room_properties_id' => 3]);
		DB::table('rooms')->updateOrInsert(['id' => 51], ['room_properties_id' => 4]);
		DB::table('rooms')->updateOrInsert(['id' => 90], ['room_properties_id' => 5]);
		DB::table('rooms')->updateOrInsert(['id' => 63], ['room_properties_id' => 6]);
		DB::table('rooms')->updateOrInsert(['id' => 88], ['room_properties_id' => 7]);
		DB::table('rooms')->updateOrInsert(['id' => 53], ['room_properties_id' => 8]);
		DB::table('rooms')->updateOrInsert(['id' => 78], ['room_properties_id' => 9]);

		DB::table('shops')->insert([
			['rooms_id' => 91, 'name' => 'Weapon Shop', 'description' => 'The weapon shop', 'buys_weapons' => true, 'buys_armors' => false, 'buys_accessories' => false, 'buys_foods' => false, 'buys_jewels' => false, 'buys_dusts' => false, 'buys_others' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 92, 'name' => 'Armor Shop', 'description' => 'The armor shop', 'buys_weapons' => false, 'buys_armors' => true, 'buys_accessories' => false, 'buys_foods' => false, 'buys_jewels' => false, 'buys_dusts' => false, 'buys_others' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 65, 'name' => 'The Trinket Exchange', 'description' => 'The trinket shop', 'buys_weapons' => false, 'buys_armors' => false, 'buys_accessories' => true, 'buys_foods' => false, 'buys_jewels' => false, 'buys_dusts' => false, 'buys_others' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 31, 'name' => 'Food Shop', 'description' => 'The food shop', 'buys_weapons' => false, 'buys_armors' => false, 'buys_accessories' => false, 'buys_foods' => true, 'buys_jewels' => false, 'buys_dusts' => false, 'buys_others' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('traders')->insert([
			['rooms_id' => 86, 'name' => 'Trader Jack', 'description' => 'Trader Jack', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['rooms_id' => 62, 'name' => 'Trader Bob', 'description' => 'Trader Bob', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
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
			// Town weapons first:
			['name' => 'Knife', 'item_types_id' => 1, 'value' => 2500, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Staff', 'item_types_id' => 1, 'value' => 16500, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gleaming Short Sword', 'item_types_id' => 1, 'value' => 18050, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Obsidian Wand', 'item_types_id' => 1, 'value' => 17200, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mace', 'item_types_id' => 1, 'value' => 17400, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 5
			['name' => 'Throwing Daggers', 'item_types_id' => 1, 'value' => 18650, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Battle Axe', 'item_types_id' => 1, 'value' => 57800, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End weapons:
			// Town armors:
			['name' => 'Leather Shield', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Helm', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Neckband', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 10
			['name' => 'Leather Shirt', 'item_types_id' => 2, 'value' => 4500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Gloves', 'item_types_id' => 2, 'value' => 2000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Pants', 'item_types_id' => 2, 'value' => 4000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Boots', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wooden Shield', 'item_types_id' => 2, 'value' => 24000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 15
			['name' => 'Chain Mail Coif', 'item_types_id' => 2, 'value' => 24000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Neckband', 'item_types_id' => 2, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Shirt', 'item_types_id' => 2, 'value' => 72000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Gauntlets', 'item_types_id' => 2, 'value' => 16000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Leggings', 'item_types_id' => 2, 'value' => 32000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 20
			['name' => 'Chain Mail Boots', 'item_types_id' => 2, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End armors:
			['name' => 'Blue Amulet', 'item_types_id' => 3, 'value' => 10000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Black Amulet', 'item_types_id' => 3, 'value' => 37500000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Amulet of Apprentice', 'item_types_id' => 3, 'value' => 37500000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Glowing Ring', 'item_types_id' => 3, 'value' => 5000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ring of Bone', 'item_types_id' => 3, 'value' => 5000000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Lightening Ring', 'item_types_id' => 3, 'value' => 5000000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Forged, not bought:
			['name' => 'Green Bracelet', 'item_types_id' => 3, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab legs', 'item_types_id' => 4, 'value' => 100, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Fix values?
			['name' => 'Goats Milk', 'item_types_id' => 4, 'value' => 10000, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 30
			['name' => 'Zombie Punch', 'item_types_id' => 4, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],

		]);


		DB::table('shop_items')->insert([
			// Weapon shop:
			['shops_id' => 1, 'items_id' => 1, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 2, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 3, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 4, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 5, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 6, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 1, 'items_id' => 7, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End Weapon
			['shops_id' => 2, 'items_id' => 8, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 9, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 10, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 10
			['shops_id' => 2, 'items_id' => 11, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 12, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 13, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 14, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 15, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 16, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 17, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 18, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 19, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 2, 'items_id' => 20, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 20
			['shops_id' => 2, 'items_id' => 21, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Accessories
			['shops_id' => 3, 'items_id' => 22, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 3, 'items_id' => 23, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 3, 'items_id' => 24, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 3, 'items_id' => 25, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 3, 'items_id' => 26, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 3, 'items_id' => 27, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// remove later:
			['shops_id' => 3, 'items_id' => 28, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['shops_id' => 4, 'items_id' => 29, 'price' => null, 'markup' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_weapons')->insert([
			['items_id' => 1, 'weapon_types_id' => 3, 'equipment_slot' => 1, 'attack_text' => 'Your dagger does damage...', 'damage_low' => 5, 'damage_high' => 15, 'required_stat' => null, 'required_amount' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 2, 'weapon_types_id' => 6, 'equipment_slot' => 1, 'attack_text' => 'You bash your opponent...', 'damage_low' => 20, 'damage_high' => 30, 'required_stat' => 'constitution', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 3, 'weapon_types_id' => 1, 'equipment_slot' => 1, 'attack_text' => 'Your sword fades in and out of view as it peels the flesh off your opponent...', 'damage_low' => 25, 'damage_high' => 40, 'required_stat' => 'strength', 'required_amount' => 45, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 4, 'weapon_types_id' => 7, 'equipment_slot' => 1, 'attack_text' => 'Smell pebbles fly from the end of the wand...', 'damage_low' => 30, 'damage_high' => 50, 'required_stat' => 'intelligence', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 5, 'weapon_types_id' => 5, 'equipment_slot' => 1, 'attack_text' => 'You heave a huge weapon...', 'damage_low' => 20, 'damage_high' => 35, 'required_stat' => 'constitution', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 6, 'weapon_types_id' => 4, 'equipment_slot' => 1, 'attack_text' => 'You launch your daggers through the air...', 'damage_low' => 25, 'damage_high' => 35, 'required_stat' => 'dexterity', 'required_amount' => 60, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 7, 'weapon_types_id' => 2, 'equipment_slot' => 1, 'attack_text' => 'Your mighty battle axe cleaves the foe...', 'damage_low' => 30, 'damage_high' => 50, 'required_stat' => 'strength', 'required_amount' => 60, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_armors')->insert([
			['items_id' => 8, 'equipment_slot' => 2, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 9, 'equipment_slot' => 3, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 10, 'equipment_slot' => 4, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 11, 'equipment_slot' => 5, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 12, 'equipment_slot' => 6, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 13, 'equipment_slot' => 7, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 14, 'equipment_slot' => 8, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 15, 'equipment_slot' => 2, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 16, 'equipment_slot' => 3, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 17, 'equipment_slot' => 4, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 18, 'equipment_slot' => 5, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 19, 'equipment_slot' => 6, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 20, 'equipment_slot' => 7, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 21, 'equipment_slot' => 8, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_accessories')->insert([
			['items_id' => 22, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => 10, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 23, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => 50, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 24, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => null, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => 50, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 
			['items_id' => 25, 'equipment_slot' => 10, 'light_level' => null, 'strength_bonus' => 5, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 26, 'equipment_slot' => 10, 'light_level' => null, 'strength_bonus' => null, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => 25, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 27, 'equipment_slot' => 10, 'light_level' => 1, 'strength_bonus' => null, 'dexterity_bonus' => 20, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 
			['items_id' => 28, 'equipment_slot' => 11, 'light_level' => null, 'strength_bonus' => 20, 'dexterity_bonus' => 20, 'constitution_bonus' => null, 'wisdom_bonus' => 20, 'intelligence_bonus' => null, 'charisma_bonus' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_foods')->insert([
			['items_id' => 29, 'potency' => 9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 30, 'potency' => 36, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 31, 'potency' => 54, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 2, 'items_id' => 29, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'items_id' => 29, 'chance' => 0.675, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
