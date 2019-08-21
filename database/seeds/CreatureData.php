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
			['name' => 'Bat', 'attack_text' => 'Bat dives at you trying to bite your neck.', 'img_src' => 'bat.jpg', 'is_hostile' => true, 'health' => 150, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 40, 'attacks_per_round' => 1, 'award_xp' => 600, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Goblin', 'attack_text' => 'Goblin scrapes at you with its long sharp claws.', 'img_src' => 'goblin.gif', 'is_hostile' => true, 'health' => 175, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 55, 'attacks_per_round' => 1, 'award_xp' => 700, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gypsy', 'attack_text' => 'Gypsy claws at your face.', 'img_src' => 'gypsy.gif', 'is_hostile' => true, 'health' => 200, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 70, 'attacks_per_round' => 1, 'award_xp' => 846, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Convict', 'attack_text' => 'Convict attacks you with a sharpened tooth brush.', 'img_src' => 'convict.gif', 'is_hostile' => true, 'health' => 300, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 90, 'attacks_per_round' => 1, 'award_xp' => 1343, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 5, 'chance' => 0.28, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 6, 'chance' => 0.26, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 7, 'chance' => 0.24, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['zones_id' => 3, 'rooms_id' => null, 'npcs_id' => 8, 'chance' => 0.22, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('items')->insert([
			['name' => 'Whey bread', 'item_types_id' => 4, 'value' => 0, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_consumables')->insert([
			['items_id' => 13, 'name' => 'Whey bread', 'effect' => 'healing', 'potency' => 35, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 7, 'items_id' => 2, 'chance' => 0.575, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
