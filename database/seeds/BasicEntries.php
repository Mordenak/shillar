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

		DB::table('equipment_slots')->insert([
			['name' => 'weapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'head', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'chest', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'legs', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'hands', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'feet', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'neck', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'ring', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_types')->insert([
			['name' => 'Weapon', 'table_name' => 'item_weapons', 'model_name' => 'App\ItemWeapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Armor', 'table_name' => 'item_armors', 'model_name' => 'App\ItemArmor', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Accessories', 'table_name' => 'item_accessories', 'model_name' => 'App\ItemAccessory', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Consumable', 'table_name' => 'item_consumables', 'model_name' => 'App\ItemConsumable', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Other', 'table_name' => 'item_others', 'model_name' => 'App\ItemOther', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('items')->insert([
			['name' => 'Rusty Sword', 'item_types_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Steel Sword', 'item_types_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rusty Helmet', 'item_types_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rusty Armor', 'item_types_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rusty Legplates', 'item_types_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Slime Drop', 'item_types_id' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Whey Bread', 'item_types_id' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_weapons')->insert([
			['items_id' => 1, 'name' => 'Rusty Sword', 'attack_text' => 'Your rusty sword scratches the enemy', 'damage_low' => 10, 'damage_high' => 25, 'equipment_slot' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 2, 'name' => 'Steel Sword', 'attack_text' => 'Your steel sword slices the enemy', 'damage_low' => 20, 'damage_high' => 50, 'equipment_slot' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_armors')->insert([
			['items_id' => 3, 'name' => 'Rusty Helmet', 'equipment_slot' => 2, 'armor' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 4, 'name' => 'Rusty Armor', 'equipment_slot' => 3, 'armor' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 5, 'name' => 'Rusty Legplates', 'equipment_slot' => 4, 'armor' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_consumables')->insert([
			['items_id' => 6, 'name' => 'Slime Drop', 'effect' => 'healing', 'potency' => 15, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 7, 'name' => 'Whey Bread', 'effect' => 'healing', 'potency' => 45, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		/*
		DB::table('zones')->insert([
			['name' => 'Starter Zone']
		]);

		DB::table('rooms')->insert([
			['zones_id' => 1, 'title' => 'Welcome', 'description' => 'Supposedly a long description here', 'north_rooms_id' => 2, 'east_rooms_id' => null, 'south_rooms_id' => null, 'west_rooms_id' => null],
			['zones_id' => 1, 'title' => 'Tutorial', 'description' => 'Proper tutorial stuff', 'north_rooms_id' => 3, 'east_rooms_id' => null, 'south_rooms_id' => 1, 'west_rooms_id' => 4],
			['zones_id' => 1, 'title' => 'First Quest', 'description' => 'This will be the first quest thing', 'north_rooms_id' => null, 'east_rooms_id' => null, 'south_rooms_id' => 2, 'west_rooms_id' => 5],
			['zones_id' => 1, 'title'=> 'Training Pit', 'description' => 'You can train here:', 'north_rooms_id' => null, 'east_rooms_id' => 2, 'south_rooms_id' => null, 'west_rooms_id' => null],
			['zones_id' => 1, 'title'=> 'Around the Bend', 'description' => 'Travelling through the canyon', 'north_rooms_id' => null, 'east_rooms_id' => 3, 'south_rooms_id' => null, 'west_rooms_id' => 6],
			['zones_id' => 1, 'title'=> 'Bandit camp', 'description' => 'Uh oh bandits', 'north_rooms_id' => null, 'east_rooms_id' => 5, 'south_rooms_id' => null,  'west_rooms_id' => null],
		]);
		*/

		/*
		DB::table('npcs')->insert([
			['name' => 'Basic Slime', 'img_src' => 'wtf_slime.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rubber Slime', 'img_src' => 'wtf_slime.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Turkey', 'img_src' => 'turkey.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bear', 'img_src' => 'bear.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bandit', 'img_src' => 'bandit.jpg', 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bandit Boss', 'img_src' => null, 'is_hostile' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'health' => 80, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 3, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 2, 'health' => 200, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 3, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'health' => 140, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 6, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 4, 'health' => 180, 'armor' => 0, 'damage_low' => 6, 'damage_high' => 15, 'attacks_per_round' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'health' => 170, 'armor' => 0, 'damage_low' => 3, 'damage_high' => 12, 'attacks_per_round' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'health' => 500, 'armor' => 0, 'damage_low' => 4, 'damage_high' => 16, 'attacks_per_round' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
		]);
		*/

		// DB::table('spawn_rules')->insert([
		// 	['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.33, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 2, 'chance' => 0.08, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 3, 'chance' => 0.41, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['zones_id' => null, 'rooms_id' => 3, 'npcs_id' => 4, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['zones_id' => null, 'rooms_id' => 5, 'npcs_id' => 5, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['zones_id' => null, 'rooms_id' => 6, 'npcs_id' => 6, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// ]);

		/*
		DB::table('reward_tables')->insert([
			['npcs_id' => 1, 'award_xp' => 50000, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 2, 'award_xp' => 75000, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 3, 'award_xp' => 100000, 'xp_variation' => 0.3, 'award_gold' => 3, 'gold_variation' => 0.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 4, 'award_xp' => 200000, 'xp_variation' => 0.2, 'award_gold' => 5, 'gold_variation' => 0.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'award_xp' => 400000, 'xp_variation' => 0.25, 'award_gold' => 8, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'award_xp' => 800000, 'xp_variation' => 0.4, 'award_gold' => 20, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 1, 'items_id' => 1, 'chance' => 0.2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'items_id' => 2, 'chance' => 0.08, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'items_id' => 3, 'chance' => 0.08, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'items_id' => 4, 'chance' => 0.08, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'items_id' => 5, 'chance' => 0.02, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 1, 'items_id' => 6, 'chance' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 5, 'items_id' => 7, 'chance' => 0.3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['npcs_id' => 6, 'items_id' => 7, 'chance' => 0.3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		*/

		// DB::table('user_settings')->insert([
		// 	['users_id' => 1, 'short_mode' => true],
		// ]);
	}
}
