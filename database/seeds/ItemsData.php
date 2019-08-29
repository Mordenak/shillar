<?php

use Illuminate\Database\Seeder;

class ItemsData extends Seeder
	{
		/**
		* Run the database seeds.
		*
		* @return void
		*/
		public function run()
		{
		DB::table('items')->insert([
			// Town weapons first:
			['name' => 'Knife', 'item_types_id' => 1, 'value' => 2500, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Staff', 'item_types_id' => 1, 'value' => 16500, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gleaming Short Sword', 'item_types_id' => 1, 'value' => 18050, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Obsidian Wand', 'item_types_id' => 1, 'value' => 17200, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Mace', 'item_types_id' => 1, 'value' => 17400, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 5
			['name' => 'Throwing Daggers', 'item_types_id' => 1, 'value' => 18650, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Battle Axe', 'item_types_id' => 1, 'value' => 57800, 'weight' => 1, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End weapons:
			// Town armors:
			['name' => 'Leather Shield', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Helm', 'item_types_id' => 2, 'value' => 3000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Neckband', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 10
			['name' => 'Leather Shirt', 'item_types_id' => 2, 'value' => 4500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Gloves', 'item_types_id' => 2, 'value' => 2000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Pants', 'item_types_id' => 2, 'value' => 4000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Leather Boots', 'item_types_id' => 2, 'value' => 2500, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wooden Shield', 'item_types_id' => 2, 'value' => 24000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 15
			['name' => 'Chain Mail Coif', 'item_types_id' => 2, 'value' => 24000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Neckband', 'item_types_id' => 2, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Shirt', 'item_types_id' => 2, 'value' => 72000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Gauntlets', 'item_types_id' => 2, 'value' => 16000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Chain Mail Leggings', 'item_types_id' => 2, 'value' => 32000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 20
			['name' => 'Chain Mail Boots', 'item_types_id' => 2, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End armors:
			['name' => 'Blue Amulet', 'item_types_id' => 3, 'value' => 10000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Black Amulet', 'item_types_id' => 3, 'value' => 37500000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Amulet of Apprentice', 'item_types_id' => 3, 'value' => 37500000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Glowing Ring', 'item_types_id' => 3, 'value' => 5000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ring of Bone', 'item_types_id' => 3, 'value' => 5000000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Lightening Ring', 'item_types_id' => 3, 'value' => 5000000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Forged, not bought:
			['name' => 'Green Bracelet', 'item_types_id' => 3, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => false, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab legs', 'item_types_id' => 4, 'value' => 100, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// Fix values?
			['name' => 'Goats Milk', 'item_types_id' => 4, 'value' => 10000, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// End 30
			['name' => 'Zombie Punch', 'item_types_id' => 4, 'value' => 20000, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Spicey Bat Wings', 'item_types_id' => 4, 'value' => 0, 'weight' => 0.25, 'is_stackable' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_weapons')->insert([
			['items_id' => 1, 'weapon_types_id' => 3, 'equipment_slot' => 1, 'attack_text' => 'Your dagger does damage...', 'damage_low' => 5, 'damage_high' => 15, 'fatigue_use' => 1.0, 'required_stat' => null, 'required_amount' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 2, 'weapon_types_id' => 6, 'equipment_slot' => 1, 'attack_text' => 'You bash your opponent...', 'damage_low' => 20, 'damage_high' => 30, 'fatigue_use' => 1.0, 'required_stat' => 'constitution', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 3, 'weapon_types_id' => 1, 'equipment_slot' => 1, 'attack_text' => 'Your sword fades in and out of view as it peels the flesh off your opponent...', 'damage_low' => 25, 'damage_high' => 40, 'fatigue_use' => 1.0, 'required_stat' => 'strength', 'required_amount' => 45, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 4, 'weapon_types_id' => 7, 'equipment_slot' => 1, 'attack_text' => 'Smell pebbles fly from the end of the wand...', 'damage_low' => 30, 'damage_high' => 50, 'fatigue_use' => 1.0, 'required_stat' => 'intelligence', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 5, 'weapon_types_id' => 5, 'equipment_slot' => 1, 'attack_text' => 'You heave a huge weapon...', 'damage_low' => 20, 'damage_high' => 35, 'fatigue_use' => 1.0, 'required_stat' => 'constitution', 'required_amount' => 40, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 6, 'weapon_types_id' => 4, 'equipment_slot' => 1, 'attack_text' => 'You launch your daggers through the air...', 'damage_low' => 25, 'damage_high' => 35, 'fatigue_use' => 1.0, 'required_stat' => 'dexterity', 'required_amount' => 60, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 7, 'weapon_types_id' => 2, 'equipment_slot' => 1, 'attack_text' => 'Your mighty battle axe cleaves the foe...', 'damage_low' => 30, 'damage_high' => 50, 'fatigue_use' => 1.0, 'required_stat' => 'strength', 'required_amount' => 60, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_armors')->insert([
			['items_id' => 8, 'equipment_slot' => 2, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 9, 'equipment_slot' => 3, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 10, 'equipment_slot' => 4, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 11, 'equipment_slot' => 5, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 12, 'equipment_slot' => 6, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 13, 'equipment_slot' => 7, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 14, 'equipment_slot' => 8, 'armor' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 15, 'equipment_slot' => 2, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 16, 'equipment_slot' => 3, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 17, 'equipment_slot' => 4, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 18, 'equipment_slot' => 5, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 19, 'equipment_slot' => 6, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 20, 'equipment_slot' => 7, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 21, 'equipment_slot' => 8, 'armor' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_accessories')->insert([
			['items_id' => 22, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => 10, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 23, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => 50, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 24, 'equipment_slot' => 9, 'light_level' => null, 'strength_bonus' => null, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => 50, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 
			['items_id' => 25, 'equipment_slot' => 10, 'light_level' => null, 'strength_bonus' => 5, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 26, 'equipment_slot' => 10, 'light_level' => null, 'strength_bonus' => null, 'dexterity_bonus' => null, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => 25, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 27, 'equipment_slot' => 10, 'light_level' => 1, 'strength_bonus' => null, 'dexterity_bonus' => 20, 'constitution_bonus' => null, 'wisdom_bonus' => null, 'intelligence_bonus' => null, 'charisma_bonus' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			// 
			['items_id' => 28, 'equipment_slot' => 11, 'light_level' => null, 'strength_bonus' => 20, 'dexterity_bonus' => 20, 'constitution_bonus' => null, 'wisdom_bonus' => 20, 'intelligence_bonus' => null, 'charisma_bonus' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('item_foods')->insert([
			['items_id' => 29, 'potency' => 9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 30, 'potency' => 36, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 31, 'potency' => 54, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['items_id' => 32, 'potency' => 18, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		}
	}
