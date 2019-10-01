<?php

use Illuminate\Database\Seeder;

class TestCharacters extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
		{
		DB::table('characters')->insert([
			['users_id' => 1, 'name' => 'Tester', 'races_id' => 31, 'last_rooms_id' => 1, 'alignments_id' => 5, 'guilds_id' => null, 'guild_rank' => null, 'xp' => 1000000000, 'gold' => 1000000000, 'bank' => 1000000000, 'health' => 20000, 'max_health' => 20000, 'mana' => 5000, 'max_mana' => 5000, 'fatigue' => 15500, 'max_fatigue' => 15500, 'strength' => 6000, 'dexterity' => 8000, 'constitution' => 6000, 'wisdom' => 1500, 'intelligence' => 1500, 'charisma' => 2000, 'quest_points' => 0, 'score' => 25000, 'death_count' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['users_id' => 1, 'name' => 'Araz', 'races_id' => 27, 'last_rooms_id' => 1, 'alignments_id' => null, 'guilds_id' => null, 'guild_rank' => null, 'xp' => 217805, 'gold' => 191, 'bank' => 3076, 'health' => 259, 'max_health' => 259, 'mana' => 149, 'max_mana' => 149, 'fatigue' => 205, 'max_fatigue' => 205, 'strength' => 74, 'dexterity' => 90, 'constitution' => 85, 'wisdom' => 30, 'intelligence' => 44, 'charisma' => 75, 'quest_points' => 0, 'score' => 398, 'death_count' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
			]);

		DB::table('inventories')->insert([
			['characters_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
			]);

		DB::table('character_settings')->insert([
			['characters_id' => 1, 'brief_mode' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 2, 'brief_mode' => true, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
			]);

		DB::table('inventory_items')->insert([
			['inventory_id' => 1, 'items_id' => 217, 'quantity' => 250, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 54, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 111, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 112, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 113, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 114, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 115, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 116, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 117, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 135, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 147, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 147, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 1, 'items_id' => 157, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 2, 'items_id' => 7, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 2, 'items_id' => 139, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 2, 'items_id' => 139, 'quantity' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['inventory_id' => 2, 'items_id' => 165, 'quantity' => 157, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('equipment')->insert([
			['characters_id' => 1, 'weapon' => 2, 'shield' => 3, 'head' => 4, 'neck' => 5, 'chest' => 6, 'legs' => 8, 'hands' => 7, 'feet' => 9, 'amulet' => 10, 'left_ring' => 11, 'right_ring' => 12, 'bracelet' => 13, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 2, 'weapon' => 14, 'shield' => null, 'head' => null, 'neck' => null, 'chest' => null, 'legs' => null, 'hands' => null, 'feet' => null, 'amulet' => null, 'left_ring' => 15, 'right_ring' => 16, 'bracelet' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('character_spells')->insert([
			['characters_id' => 1, 'spells_id' => 1, 'level' => 50, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 1, 'spells_id' => 2, 'level' => 50, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 2, 'spells_id' => 1, 'level' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['characters_id' => 2, 'spells_id' => 2, 'level' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		}
}
