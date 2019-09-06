<?php

use Illuminate\Database\Seeder;

class TeleportTargets extends Seeder
	{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
		{
		// DB::statement("SET session_replication_role = 'replica';");
		DB::table('teleport_targets')->insert([
			['spells_id' => 2, 'name' => 'The Fountain', 'rooms_id' => 1, 'level_req' => null, 'wisdom_req' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Beach Entrance', 'rooms_id' => 87, 'level_req' => 1, 'wisdom_req' => 10, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Middle of Beach', 'rooms_id' => 115, 'level_req' => 5, 'wisdom_req' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Far End of Beach', 'rooms_id' => 91, 'level_req' => 10, 'wisdom_req' => 30, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		// DB::statement("SET session_replication_role = 'origin';");
		}
	}
