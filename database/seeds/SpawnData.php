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
		DB::table('spawn_rules')->insert([
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.48, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 2, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 3, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 2, 'rooms_id' => null, 'npcs_id' => 4, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 5, 'chance' => 0.28, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 6, 'chance' => 0.26, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 7, 'chance' => 0.24, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 8, 'chance' => 0.22, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		}
	}
