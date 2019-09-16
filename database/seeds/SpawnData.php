<?php

use Illuminate\Database\Seeder;

class SpawnData extends Seeder
	{
		/**
		* Run the database seeds.
		*
		* @return void
		*/
		public function run()
		{

		DB::table('creature_groups')->insert([
			['name' => 'Shillatown', 'description' => 'Shillatown Guards', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Beach', 'description' => 'Beach creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Outskirts', 'description' => 'Outskirts creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Sewers', 'description' => 'Sewers creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Vast Valley', 'description' => 'Vast Valley creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Druid Valley', 'description' => 'Druid Valley creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Cemetary', 'description' => 'Cemetary creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crypt', 'description' => 'Crypt creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Lake Gala', 'description' => 'Lake Gala creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dark Forest', 'description' => 'Dark Forest creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mountains', 'description' => 'Mountains creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ogre Cave', 'description' => 'Ogre Cave creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Deep Dark Forest', 'description' => 'Deep Dark Forest creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'The Pit', 'description' => 'Pit creatures', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('creature_to_creature_groups')->insert([
			['creatures_id' => 1, 'creature_groups_id' => 1, 'weight' => 100, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 2, 'creature_groups_id' => 2, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 3, 'creature_groups_id' => 2, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 4, 'creature_groups_id' => 2, 'weight' => 40, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 6, 'creature_groups_id' => 3, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 7, 'creature_groups_id' => 3, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 8, 'creature_groups_id' => 3, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 9, 'creature_groups_id' => 3, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 10, 'creature_groups_id' => 4, 'weight' => 55, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 11, 'creature_groups_id' => 4, 'weight' => 45, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 12, 'creature_groups_id' => 5, 'weight' => 55, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 13, 'creature_groups_id' => 5, 'weight' => 45, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 14, 'creature_groups_id' => 6, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 15, 'creature_groups_id' => 6, 'weight' => 35, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 16, 'creature_groups_id' => 6, 'weight' => 35, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 18, 'creature_groups_id' => 7, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 19, 'creature_groups_id' => 7, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 20, 'creature_groups_id' => 7, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 21, 'creature_groups_id' => 7, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 22, 'creature_groups_id' => 7, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 28, 'creature_groups_id' => 9, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 29, 'creature_groups_id' => 9, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 30, 'creature_groups_id' => 9, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 31, 'creature_groups_id' => 9, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 33, 'creature_groups_id' => 10, 'weight' => 40, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 34, 'creature_groups_id' => 10, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 35, 'creature_groups_id' => 10, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 37, 'creature_groups_id' => 11, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 38, 'creature_groups_id' => 11, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 39, 'creature_groups_id' => 11, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 40, 'creature_groups_id' => 11, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 42, 'creature_groups_id' => 12, 'weight' => 40, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 43, 'creature_groups_id' => 12, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 44, 'creature_groups_id' => 12, 'weight' => 30, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 45, 'creature_groups_id' => 13, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 46, 'creature_groups_id' => 13, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 47, 'creature_groups_id' => 13, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 48, 'creature_groups_id' => 13, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 49, 'creature_groups_id' => 13, 'weight' => 20, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 50, 'creature_groups_id' => 14, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 51, 'creature_groups_id' => 14, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 52, 'creature_groups_id' => 14, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 53, 'creature_groups_id' => 14, 'weight' => 25, 'priority' => null, 'score_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],

			]);

		DB::table('spawn_rules')->insert([
			['creatures_id' => null, 'creature_groups_id' => 1, 'zones_id' => 1, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 2, 'zones_id' => 2, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 3, 'zones_id' => 3, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 4, 'zones_id' => 4, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 5, 'zones_id' => 5, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 6, 'zones_id' => 6, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 7, 'zones_id' => 7, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 9, 'zones_id' => 9, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 10, 'zones_id' => 12, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 11, 'zones_id' => 10, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => null, 'creature_groups_id' => 12, 'zones_id' => 11, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => null, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Specifics:
			['creatures_id' => 5, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 104, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 17, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 239, 'chance' => 0.75, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => 2000, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 23, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 298, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 24, 'creature_groups_id' => null, 'zones_id' => 8, 'zone_level' => 0, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 25, 'creature_groups_id' => null, 'zones_id' => 8, 'zone_level' => 1, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 26, 'creature_groups_id' => null, 'zones_id' => 8, 'zone_level' => 2, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 27, 'creature_groups_id' => null, 'zones_id' => 8, 'zone_level' => 3, 'zone_areas_id' => null, 'rooms_id' => null, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 32, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 337, 'chance' => 0.75, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => 2000, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 32, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 341, 'chance' => 0.75, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => 2000, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 32, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 357, 'chance' => 0.75, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => 2000, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 32, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 361, 'chance' => 0.75, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => 2000, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 36, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 362, 'chance' => 1.0, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 379, 'chance' => 0.25, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 41, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 380, 'chance' => 0.25, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],

			['creatures_id' => 54, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 552, 'chance' => 0.25, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['creatures_id' => 54, 'creature_groups_id' => null, 'zones_id' => null, 'zone_level' => null, 'zone_areas_id' => null, 'rooms_id' => 562, 'chance' => 0.25, 'spawn_hour' => null, 'random_hour' => false, 'score_req' => null, 'spawns_once' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);
		}
	}
