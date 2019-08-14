<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceData extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('player_races')->insert([
			['name' => 'Arachnid', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Avian', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Centaur', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Draconian', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dwarf', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elf', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gnome', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Halfling', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Human', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Kobold', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Lizardman', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ogre', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Orc', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Pixie', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Satyr', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wolf', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wraith', 'gender' => 'Male', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Arachnid', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Avian', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Centaur', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Draconian', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dwarf', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elf', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gnome', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Halfling', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Human', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Kobold', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Lizardman', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Ogre', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Orc', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Pixie', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Satyr', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wolf', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Wraith', 'gender' => 'Female', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('stat_costs')->insert([
			['player_races_id' => 1, 'strength_cost' => 4.5, 'dexterity_cost' => 4.675, 'constitution_cost' => 6.25, 'wisdom_cost' => 4.75, 'intelligence_cost' => 4.75, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 2, 'strength_cost' => 4.95, 'dexterity_cost' => 5.225, 'constitution_cost' => 5, 'wisdom_cost' => 5.25, 'intelligence_cost' => 4.75, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 3, 'strength_cost' => 3.825, 'dexterity_cost' => 4.95, 'constitution_cost' => 4.5, 'wisdom_cost' => 5.75, 'intelligence_cost' => 5.75, 'charisma_cost' => 5.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 4, 'strength_cost' => 3.6, 'dexterity_cost' => 5.5, 'constitution_cost' => 4.5, 'wisdom_cost' => 6, 'intelligence_cost' => 4.5, 'charisma_cost' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 5, 'strength_cost' => 3.825, 'dexterity_cost' => 4.675, 'constitution_cost' => 4.25, 'wisdom_cost' => 6.25, 'intelligence_cost' => 6.25, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 6, 'strength_cost' => 5.175, 'dexterity_cost' => 5.225, 'constitution_cost' => 5.75, 'wisdom_cost' => 4.5, 'intelligence_cost' => 4.5, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 7, 'strength_cost' => 5.625, 'dexterity_cost' => 4.4, 'constitution_cost' => 6.25, 'wisdom_cost' => 4.25, 'intelligence_cost' => 4.25, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 8, 'strength_cost' => 4.95, 'dexterity_cost' => 4.675, 'constitution_cost' => 5, 'wisdom_cost' => 6, 'intelligence_cost' => 5, 'charisma_cost' => 4.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 9, 'strength_cost' => 4.5, 'dexterity_cost' => 5.5, 'constitution_cost' => 5, 'wisdom_cost' => 5, 'intelligence_cost' => 5, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 10, 'strength_cost' => 4.5, 'dexterity_cost' => 4.4, 'constitution_cost' => 4.5, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 11, 'strength_cost' => 4.05, 'dexterity_cost' => 4.95, 'constitution_cost' => 5, 'wisdom_cost' => 5.25, 'intelligence_cost' => 5.25, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 12, 'strength_cost' => 3.375, 'dexterity_cost' => 5.775, 'constitution_cost' => 4, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 13, 'strength_cost' => 4.275, 'dexterity_cost' => 5.225, 'constitution_cost' => 4.75, 'wisdom_cost' => 5.25, 'intelligence_cost' => 5.25, 'charisma_cost' => 5.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 14, 'strength_cost' => 5.85, 'dexterity_cost' => 4.95, 'constitution_cost' => 5.5, 'wisdom_cost' => 4.75, 'intelligence_cost' => 4.75, 'charisma_cost' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 15, 'strength_cost' => 3.825, 'dexterity_cost' => 4.675, 'constitution_cost' => 4.75, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 5.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 16, 'strength_cost' => 4.05, 'dexterity_cost' => 4.675, 'constitution_cost' => 6, 'wisdom_cost' => 4.5, 'intelligence_cost' => 6, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 17, 'strength_cost' => 6.3, 'dexterity_cost' => 4.4, 'constitution_cost' => 5, 'wisdom_cost' => 4.25, 'intelligence_cost' => 4.25, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 18, 'strength_cost' => 5.5, 'dexterity_cost' => 3.825, 'constitution_cost' => 6.25, 'wisdom_cost' => 4.75, 'intelligence_cost' => 4.75, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 19, 'strength_cost' => 6.05, 'dexterity_cost' => 4.275, 'constitution_cost' => 5, 'wisdom_cost' => 5.25, 'intelligence_cost' => 4.75, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 20, 'strength_cost' => 4.675, 'dexterity_cost' => 4.05, 'constitution_cost' => 4.5, 'wisdom_cost' => 5.75, 'intelligence_cost' => 5.75, 'charisma_cost' => 5.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 21, 'strength_cost' => 4.4, 'dexterity_cost' => 4.5, 'constitution_cost' => 4.5, 'wisdom_cost' => 6, 'intelligence_cost' => 4.5, 'charisma_cost' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 22, 'strength_cost' => 4.675, 'dexterity_cost' => 3.825, 'constitution_cost' => 4.25, 'wisdom_cost' => 6.25, 'intelligence_cost' => 6.25, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 23, 'strength_cost' => 6.325, 'dexterity_cost' => 4.275, 'constitution_cost' => 5.75, 'wisdom_cost' => 4.5, 'intelligence_cost' => 4.5, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 24, 'strength_cost' => 6.875, 'dexterity_cost' => 3.6, 'constitution_cost' => 6.25, 'wisdom_cost' => 4.25, 'intelligence_cost' => 4.25, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 25, 'strength_cost' => 6.05, 'dexterity_cost' => 3.825, 'constitution_cost' => 5, 'wisdom_cost' => 6, 'intelligence_cost' => 5, 'charisma_cost' => 4.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 26, 'strength_cost' => 5.5, 'dexterity_cost' => 4.5, 'constitution_cost' => 5, 'wisdom_cost' => 5, 'intelligence_cost' => 5, 'charisma_cost' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 27, 'strength_cost' => 5.5, 'dexterity_cost' => 3.6, 'constitution_cost' => 4.5, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 28, 'strength_cost' => 4.95, 'dexterity_cost' => 4.05, 'constitution_cost' => 5, 'wisdom_cost' => 5.25, 'intelligence_cost' => 5.25, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 29, 'strength_cost' => 4.125, 'dexterity_cost' => 4.725, 'constitution_cost' => 4, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 30, 'strength_cost' => 5.225, 'dexterity_cost' => 4.275, 'constitution_cost' => 4.75, 'wisdom_cost' => 5.25, 'intelligence_cost' => 5.25, 'charisma_cost' => 5.25, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 31, 'strength_cost' => 7.15, 'dexterity_cost' => 4.05, 'constitution_cost' => 5.5, 'wisdom_cost' => 4.75, 'intelligence_cost' => 4.75, 'charisma_cost' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 32, 'strength_cost' => 4.675, 'dexterity_cost' => 3.825, 'constitution_cost' => 4.75, 'wisdom_cost' => 5.5, 'intelligence_cost' => 5.5, 'charisma_cost' => 5.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 33, 'strength_cost' => 4.95, 'dexterity_cost' => 3.825, 'constitution_cost' => 6, 'wisdom_cost' => 4.5, 'intelligence_cost' => 6, 'charisma_cost' => 4.75, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 34, 'strength_cost' => 7.7, 'dexterity_cost' => 3.6, 'constitution_cost' => 5, 'wisdom_cost' => 4.25, 'intelligence_cost' => 4.25, 'charisma_cost' => 5.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('starting_stats')->insert([
			['player_races_id' => 1, 'strength' => 21, 'dexterity' => 23, 'constitution' => 16, 'wisdom' => 22, 'intelligence' => 22, 'charisma' => 16, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 2, 'strength' => 18, 'dexterity' => 20, 'constitution' => 20, 'wisdom' => 25, 'intelligence' => 17, 'charisma' => 16, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 3, 'strength' => 18, 'dexterity' => 20, 'constitution' => 20, 'wisdom' => 22, 'intelligence' => 20, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 4, 'strength' => 25, 'dexterity' => 20, 'constitution' => 20, 'wisdom' => 18, 'intelligence' => 18, 'charisma' => 19, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 5, 'strength' => 25, 'dexterity' => 16, 'constitution' => 25, 'wisdom' => 17, 'intelligence' => 18, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 6, 'strength' => 15, 'dexterity' => 23, 'constitution' => 18, 'wisdom' => 21, 'intelligence' => 19, 'charisma' => 24, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 7, 'strength' => 15, 'dexterity' => 16, 'constitution' => 20, 'wisdom' => 20, 'intelligence' => 25, 'charisma' => 24, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 8, 'strength' => 20, 'dexterity' => 24, 'constitution' => 23, 'wisdom' => 16, 'intelligence' => 15, 'charisma' => 22, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 9, 'strength' => 20, 'dexterity' => 20, 'constitution' => 20, 'wisdom' => 20, 'intelligence' => 20, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 10, 'strength' => 22, 'dexterity' => 21, 'constitution' => 22, 'wisdom' => 18, 'intelligence' => 18, 'charisma' => 19, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 11, 'strength' => 23, 'dexterity' => 17, 'constitution' => 20, 'wisdom' => 20, 'intelligence' => 20, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 12, 'strength' => 25, 'dexterity' => 14, 'constitution' => 28, 'wisdom' => 17, 'intelligence' => 20, 'charisma' => 16, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 13, 'strength' => 20, 'dexterity' => 18, 'constitution' => 22, 'wisdom' => 20, 'intelligence' => 20, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 14, 'strength' => 14, 'dexterity' => 24, 'constitution' => 13, 'wisdom' => 24, 'intelligence' => 23, 'charisma' => 20, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 15, 'strength' => 22, 'dexterity' => 21, 'constitution' => 19, 'wisdom' => 18, 'intelligence' => 19, 'charisma' => 21, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 16, 'strength' => 23, 'dexterity' => 20, 'constitution' => 20, 'wisdom' => 17, 'intelligence' => 17, 'charisma' => 23, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['player_races_id' => 17, 'strength' => 22, 'dexterity' => 19, 'constitution' => 19, 'wisdom' => 22, 'intelligence' => 20, 'charisma' => 18, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
		]);
	}
}
