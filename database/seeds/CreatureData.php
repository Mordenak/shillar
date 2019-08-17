<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatureData extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Starts @ id 5
		DB::table('npcs')->insert([
			['name' => 'Bat', 'attack_text' => 'Bat dives at you trying to bite your neck.', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Goblin', 'attack_text' => 'Goblin scrapes at you with its long sharp claws.', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gypsy', 'attack_text' => 'Gypsy claws at your face.', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Convict', 'attack_text' => 'Convict attacks you with a sharpened tooth brush.', 'is_hostile' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 5, 'health' => 150, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 40, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'health' => 175, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 55, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 7, 'health' => 200, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 70, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 8, 'health' => 300, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 90, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('reward_tables')->insert([
			['npcs_id' => 5, 'award_xp' => 600, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'award_xp' => 700, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 7, 'award_xp' => 846, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 8, 'award_xp' => 1343, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
