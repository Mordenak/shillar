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

		// DB::table('item_types')->insert([
		// 	['name' => 'Consumable', 'table_name' => 'item_consumables', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'Weapon', 'table_name' => 'item_weapons', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'Armor', 'table_name' => 'item_armors', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'Accessories', 'table_name' => 'item_accessories', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// 	['name' => 'Other', 'table_name' => 'item_others', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		// ]);

		DB::table('item_weapons')->insert([
			['name' => 'Rusty Sword', 'attack_text' => 'You scratches your enemy', 'damage_low' => 10, 'damage_high' => 25, 'equipment_slot' => 'weapon'],
		]);

		DB::table('items')->insert([
			['name' => 'Rusty Sword', 'item_table' => 'item_weapons', 'item_table_id' => 1],
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
			['name' => 'Basic Slime','is_hostile' => true],
			['name' => 'Turkey', 'is_hostile' => true],
			['name' => 'Bear', 'is_hostile' => true],
			['name' => 'Bandit', 'is_hostile' => true],
			['name' => 'Bandit Boss', 'is_hostile' => true],
		]);

		DB::table('npc_stats')->insert([
			['npcs_id' => 1, 'level' => 1, 'health' => 5, 'damage_types_id' => 3, 'damage_low' => 1, 'damage_high' => 3, 'attacks_per_round' => 1],
			['npcs_id' => 2, 'level' => 3, 'health' => 25, 'damage_types_id' => 3, 'damage_low' => 1, 'damage_high' => 6, 'attacks_per_round' => 1],
			['npcs_id' => 3, 'level' => 5, 'health' => 100, 'damage_types_id' => 3, 'damage_low' => 6, 'damage_high' => 15, 'attacks_per_round' => 1],
			['npcs_id' => 4, 'level' => 5, 'health' => 135, 'damage_types_id' => 3, 'damage_low' => 3, 'damage_high' => 12, 'attacks_per_round' => 2],
			['npcs_id' => 5, 'level' => 5, 'health' => 350, 'damage_types_id' => 3, 'damage_low' => 4, 'damage_high' => 16, 'attacks_per_round' => 3]
		]);

		DB::table('spawn_rules')->insert([
			['zones_id' => null, 'rooms_id' => 1, 'npcs_id' => 1, 'chance' => 1.0],
			['zones_id' => null, 'rooms_id' => 2, 'npcs_id' => 2, 'chance' => 1.0],
			['zones_id' => null, 'rooms_id' => 3, 'npcs_id' => 3, 'chance' => 1.0],
			['zones_id' => null, 'rooms_id' => 5, 'npcs_id' => 4, 'chance' => 1.0],
			['zones_id' => null, 'rooms_id' => 6, 'npcs_id' => 5, 'chance' => 1.0],
		]);

		DB::table('reward_tables')->insert([
			['npcs_id' => 1, 'award_xp' => 88000, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.25],
			['npcs_id' => 2, 'award_xp' => 2300, 'xp_variation' => 0.3, 'award_gold' => 3, 'gold_variation' => 0.25],
			['npcs_id' => 3, 'award_xp' => 6700, 'xp_variation' => 0.2, 'award_gold' => 5, 'gold_variation' => 0.25],
			['npcs_id' => 4, 'award_xp' => 15000, 'xp_variation' => 0.25, 'award_gold' => 8, 'gold_variation' => 0.5],
			['npcs_id' => 5, 'award_xp' => 38000, 'xp_variation' => 0.4, 'award_gold' => 20, 'gold_variation' => 0.5],
		]);

		DB::table('loot_tables')->insert([
			['npcs_id' => 1, 'items_id' => 1, 'chance' => 1.0],
		]);
	}
}
