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

		DB::table('player_races')->insert([
			['name' => 'Human', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dwarf', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elf', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('stat_costs')->insert([
			['player_races_id' => 1, 'strength_cost' => 1.15, 'dexterity_cost' => 1.10, 'constitution_cost' => 0.95, 'wisdom_cost' => 0.95, 'intelligence_cost' => 0.925, 'charisma_cost' => 0.925],
			['player_races_id' => 2, 'strength_cost' => 0.90, 'dexterity_cost' => 1.225, 'constitution_cost' => 0.85, 'wisdom_cost' => 0.975, 'intelligence_cost' => 1.15, 'charisma_cost' => 1.075],
			['player_races_id' => 3, 'strength_cost' => 1.1, 'dexterity_cost' => 0.9, 'constitution_cost' => 1.125, 'wisdom_cost' => 0.95, 'intelligence_cost' => 0.90, 'charisma_cost' => 1.025]
		]);

		// DB::table('stat_costs')->insert([
		// 	['strength_coefficient' => 1.45, 'dexterity_coefficient' => 1.67, 'constitution_coefficient' => 1.51, 'wisdom_coefficient' => 1.38, 'intelligence_coefficient' => 1.65, 'charisma_coefficient' => 1.53]
		// ]);

		// DB::table('equipment_slots')->insert([
		// 	['name' => 'head', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'chest', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'legs', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'weapon', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// ]);

		DB::table('item_types')->insert([
			['name' => 'Consumable', 'table_name' => 'item_consumables', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Weapon', 'table_name' => 'item_weapons', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Armor', 'table_name' => 'item_armors', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Accessories', 'table_name' => 'item_accessories', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Other', 'table_name' => 'item_others', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('items')->insert([
			['name' => 'Rusty Sword', 'item_types_id' => 2],
			['name' => 'Steel Sword', 'item_types_id' => 2],
			['name' => 'Rusty Helmet', 'item_types_id' => 3],
			['name' => 'Rusty Armor', 'item_types_id' => 3],
			['name' => 'Rusty Legplates', 'item_types_id' => 3],
			['name' => 'Slime Drop', 'item_types_id' => 1],
			['name' => 'Whey Bread', 'item_types_id' => 1],
		]);

		DB::table('item_weapons')->insert([
			['items_id' => 1, 'name' => 'Rusty Sword', 'attack_text' => 'Your rusty sword scratches the enemy', 'damage_low' => 10, 'damage_high' => 25, 'equipment_slot' => 'weapon'],
			['items_id' => 2, 'name' => 'Steel Sword', 'attack_text' => 'Your steel sword slices the enemy', 'damage_low' => 20, 'damage_high' => 50, 'equipment_slot' => 'weapon'],
		]);

		DB::table('item_armors')->insert([
			['items_id' => 3, 'name' => 'Rusty Helmet', 'equipment_slot' => 'head', 'armor' => 2],
			['items_id' => 4, 'name' => 'Rusty Armor', 'equipment_slot' => 'chest', 'armor' => 2],
			['items_id' => 5, 'name' => 'Rusty Legplates', 'equipment_slot' => 'legs', 'armor' => 2],
		]);

		DB::table('item_consumables')->insert([
			['items_id' => 6, 'name' => 'Slime Drop', 'effect' => 'healing', 'potency' => 15],
			['items_id' => 7, 'name' => 'Whey Bread', 'effect' => 'healing', 'potency' => 45],
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

		DB::table('npcs')->insert([
			['name' => 'Basic Slime', 'img_src' => 'wtf_slime.jpg', 'is_hostile' => true],
			['name' => 'Rubber Slime', 'img_src' => 'wtf_slime.jpg', 'is_hostile' => true],
			['name' => 'Turkey', 'img_src' => 'turkey.jpg', 'is_hostile' => true],
			['name' => 'Bear', 'img_src' => 'bear.jpg', 'is_hostile' => true],
			['name' => 'Bandit', 'img_src' => null, 'is_hostile' => true],
			['name' => 'Bandit Boss', 'img_src' => null, 'is_hostile' => true],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'health' => 80, 'damage_low' => 1, 'damage_high' => 3, 'attacks_per_round' => 1],
			['npcs_id' => 2, 'health' => 200, 'damage_low' => 1, 'damage_high' => 3, 'attacks_per_round' => 1],
			['npcs_id' => 3, 'health' => 140, 'damage_low' => 1, 'damage_high' => 6, 'attacks_per_round' => 1],
			['npcs_id' => 4, 'health' => 180, 'damage_low' => 6, 'damage_high' => 15, 'attacks_per_round' => 1],
			['npcs_id' => 5, 'health' => 170, 'damage_low' => 3, 'damage_high' => 12, 'attacks_per_round' => 2],
			['npcs_id' => 6, 'health' => 500, 'damage_low' => 4, 'damage_high' => 16, 'attacks_per_round' => 3]
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 1, 'chance' => 0.33],
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 2, 'chance' => 0.08],
			['zones_id' => 1, 'rooms_id' => null, 'npcs_id' => 3, 'chance' => 0.41],
			['zones_id' => null, 'rooms_id' => 3, 'npcs_id' => 4, 'chance' => 0.5],
			['zones_id' => null, 'rooms_id' => 5, 'npcs_id' => 5, 'chance' => 0.5],
			['zones_id' => null, 'rooms_id' => 6, 'npcs_id' => 6, 'chance' => 0.5],
		]);

		DB::table('reward_tables')->insert([
			['npcs_id' => 1, 'award_xp' => 50000, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.25],
			['npcs_id' => 2, 'award_xp' => 75000, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.25],
			['npcs_id' => 3, 'award_xp' => 100000, 'xp_variation' => 0.3, 'award_gold' => 3, 'gold_variation' => 0.25],
			['npcs_id' => 4, 'award_xp' => 200000, 'xp_variation' => 0.2, 'award_gold' => 5, 'gold_variation' => 0.25],
			['npcs_id' => 5, 'award_xp' => 400000, 'xp_variation' => 0.25, 'award_gold' => 8, 'gold_variation' => 0.5],
			['npcs_id' => 6, 'award_xp' => 800000, 'xp_variation' => 0.4, 'award_gold' => 20, 'gold_variation' => 0.5],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 1, 'items_id' => 1, 'chance' => 0.2],
			['npcs_id' => 5, 'items_id' => 2, 'chance' => 0.08],
			['npcs_id' => 5, 'items_id' => 3, 'chance' => 0.08],
			['npcs_id' => 5, 'items_id' => 4, 'chance' => 0.08],
			['npcs_id' => 6, 'items_id' => 5, 'chance' => 0.02],
			['npcs_id' => 1, 'items_id' => 6, 'chance' => 0.5],
			['npcs_id' => 5, 'items_id' => 7, 'chance' => 0.3],
			['npcs_id' => 6, 'items_id' => 7, 'chance' => 0.3],
		]);

		// DB::table('user_settings')->insert([
		// 	['users_id' => 1, 'short_mode' => true],
		// ]);
	}
}
