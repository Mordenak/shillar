<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicEntries extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('player_classes')->insert([
			['name' => 'Warrior', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rogue', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wizard', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('player_races')->insert([
			['name' => 'Human', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dwarf', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elf', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('equipment_slots')->insert([
			['name' => 'head', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'chest', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'legs', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'weapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_types')->insert([
			['name' => 'Potion', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Weapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Armor', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Other', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('damage_types')->insert([
			['name' => 'Slashing', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Piercing', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Blunt', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Magic', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'True', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('max_values')->insert([
			['max_level' => 100, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
		]);

		DB::table('zones')->insert([
			['name' => 'Starter']
		]);

		DB::table('rooms')->insert([
			['zones_id' => 1, 'title' => 'Welcome', 'description' => 'Supposedly a long description here', 'north_rooms_id' => 2, 'south_rooms_id' => null],
			['zones_id' => 1, 'title' => 'Tutorial', 'description' => 'Proper tutorial stuff', 'south_rooms_id' => 1, 'north_rooms_id' => 3],
			['zones_id' => 1, 'title' => 'First Quest', 'description' => 'This will be the first quest thing', 'north_rooms_id' => null, 'south_rooms_id' => 2]
		]);

		DB::table('npcs')->insert([
			['name' => 'Basic Slime','is_hostile' => true]
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'level' => 1, 'health' => 5]
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => null, 'rooms_id' => 1, 'npcs_id' => 1, 'chance' => 1.0]
		]);

		DB::table('reward_tables')->insert([
			['npcs_id' => 1, 'award_xp' => 10, 'xp_variation' => 0.0, 'award_copper' => 2, 'copper_variation' => 0.0, 'award_silver' => 0, 'silver_variation' => 0.0, 'award_gold' => 0, 'gold_variation' => 0.0]
		]);
	}
}
