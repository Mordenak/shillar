<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
			['spells_id' => 1, 'name' => 'Outskirts by Lake Gala', 'rooms_id' => 139, 'level_req' => 5, 'wisdom_req' => 50, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Vast Valley Entrance', 'rooms_id' => 180, 'level_req' => 10, 'wisdom_req' => 60, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Druid Valley Crossroads', 'rooms_id' => 216, 'level_req' => 20, 'wisdom_req' => 80, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Cemetary Crossroads', 'rooms_id' => 246, 'level_req' => 25, 'wisdom_req' => 80, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'East Cemetary Crossroads', 'rooms_id' => 285, 'level_req' => 25, 'wisdom_req' => 90, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Cemetary Crypt', 'rooms_id' => 279, 'level_req' => 30, 'wisdom_req' => 100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Castle Entrance', 'rooms_id' => 321, 'level_req' => 30, 'wisdom_req' => 100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Castle 2nd Floor', 'rooms_id' => 322, 'level_req' => 30, 'wisdom_req' => 110, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Castle 3rd Floor', 'rooms_id' => 331, 'level_req' => 30, 'wisdom_req' => 120, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Castle Top Floor', 'rooms_id' => 332, 'level_req' => 30, 'wisdom_req' => 130, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Mountain Entrance', 'rooms_id' => 362, 'level_req' => 30, 'wisdom_req' => 160, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Ogre Cave', 'rooms_id' => 387, 'level_req' => 35, 'wisdom_req' => 170, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Mountain Top', 'rooms_id' => 377, 'level_req' => 35, 'wisdom_req' => 180, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Dark Forest Food Shop', 'rooms_id' => 416, 'level_req' => 25, 'wisdom_req' => 190, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Deep Dark Forest', 'rooms_id' => 431, 'level_req' => 30, 'wisdom_req' => 220, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Dungeon Entrance', 'rooms_id' => 790, 'level_req' => 10, 'wisdom_req' => 290, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Druid Keep Entrance', 'rooms_id' => 860, 'level_req' => 25, 'wisdom_req' => 330, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Druid Keep Top Level', 'rooms_id' => 888, 'level_req' => 35, 'wisdom_req' => 350, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Sky Castle 2nd Floor', 'rooms_id' => 920, 'level_req' => 45, 'wisdom_req' => 370, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Sky Castle 3rd Floor', 'rooms_id' => 941, 'level_req' => 50, 'wisdom_req' => 390, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['spells_id' => 1, 'name' => 'Plains', 'rooms_id' => 976, 'level_req' => 25, 'wisdom_req' => 410, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		// DB::statement("SET session_replication_role = 'origin';");
		}
	}
