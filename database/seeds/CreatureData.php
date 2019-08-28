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
			['name' => 'Town Guard', 'attack_text' => 'Town Guard attacks you with his shiney sword.', 'img_src' => 'townguard.jpg', 'is_hostile' => false, 'is_blocking' => false, 'health' => 125000, 'armor' => 0.1, 'damage_low' => 60, 'damage_high' => 60, 'attacks_per_round' => 1, 'award_xp' => 0, 'xp_variation' => 0, 'award_gold' => 0, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Hermit Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'HermitCrab.jpg', 'is_hostile' => true, 'is_blocking' => false, 'health' => 75, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 20, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'Crab.jpg', 'is_hostile' => true, 'is_blocking' => false, 'health' => 100, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 28, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Stone Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'StoneCrab.jpg', 'is_hostile' => true, 'is_blocking' => false, 'health' => 125, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 35, 'attacks_per_round' => 1, 'award_xp' => 550, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bat', 'attack_text' => 'Bat dives at you trying to bite your neck.', 'img_src' => 'bat.jpg', 'is_hostile' => true, 'is_blocking' => false, 'health' => 150, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 40, 'attacks_per_round' => 1, 'award_xp' => 600, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Goblin', 'attack_text' => 'Goblin scrapes at you with its long sharp claws.', 'img_src' => 'goblin.gif', 'is_hostile' => true, 'is_blocking' => false, 'health' => 175, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 55, 'attacks_per_round' => 1, 'award_xp' => 700, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gypsy', 'attack_text' => 'Gypsy claws at your face.', 'img_src' => 'gypsy.gif', 'is_hostile' => true, 'is_blocking' => false, 'health' => 200, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 70, 'attacks_per_round' => 1, 'award_xp' => 846, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Convict', 'attack_text' => 'Convict attacks you with a sharpened tooth brush.', 'img_src' => 'convict.gif', 'is_hostile' => true, 'is_blocking' => false, 'health' => 300, 'armor' => 0.02, 'damage_low' => 1, 'damage_high' => 90, 'attacks_per_round' => 1, 'award_xp' => 1343, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
		}
	}
