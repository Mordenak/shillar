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
			['name' => 'Town Guard', 'attack_text' => 'Town Guard attacks you with his shiney sword.', 'img_src' => 'townguard.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 125000, 'armor' => 0.1, 'damage_low' => 60, 'damage_high' => 60, 'attacks_per_round' => 1, 'award_xp' => 0, 'xp_variation' => 0, 'award_gold' => 0, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Hermit Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'HermitCrab.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 75, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 20, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'Crab.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 100, 'armor' => 0, 'damage_low' => 1, 'damage_high' => 28, 'attacks_per_round' => 1, 'award_xp' => 355, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Stone Crab', 'attack_text' => 'The small crab flexes his claws at you, then pinches you!', 'img_src' => 'StoneCrab.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 125, 'armor' => 0.01, 'damage_low' => 1, 'damage_high' => 35, 'attacks_per_round' => 1, 'award_xp' => 550, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Bat', 'attack_text' => 'Bat dives at you trying to bite your neck.', 'img_src' => 'bat.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 2, 'alignment_strength' => 0.1, 'health' => 150, 'armor' => 0, 'damage_low' => 10, 'damage_high' => 40, 'attacks_per_round' => 1, 'award_xp' => 600, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Goblin', 'attack_text' => 'Goblin scrapes at you with its long sharp claws.', 'img_src' => 'goblin.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 3, 'alignment_strength' => 0.1, 'health' => 175, 'armor' => 0.02, 'damage_low' => 25, 'damage_high' => 55, 'attacks_per_round' => 1, 'award_xp' => 700, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Gypsy', 'attack_text' => 'Gypsy claws at your face.', 'img_src' => 'gypsy.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 200, 'armor' => 0.01, 'damage_low' => 40, 'damage_high' => 70, 'attacks_per_round' => 1, 'award_xp' => 846, 'xp_variation' => 0.2, 'award_gold' => 1, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Convict', 'attack_text' => 'Convict attacks you with a sharpened tooth brush.', 'img_src' => 'convict.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 300, 'armor' => 0.02, 'damage_low' => 40, 'damage_high' => 90, 'attacks_per_round' => 1, 'award_xp' => 1343, 'xp_variation' => 0.2, 'award_gold' => 2, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Sewer Rat', 'attack_text' => 'Rat claws at your flesh tearing at your limbs.', 'img_src' => 'rat.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 600, 'armor' => 0.01, 'damage_low' => 40, 'damage_high' => 100, 'attacks_per_round' => 1, 'award_xp' => 2415, 'xp_variation' => 0.2, 'award_gold' => 3, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Warrior', 'attack_text' => 'Warrior rakes your body.', 'img_src' => 'warrior.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 700, 'armor' => 0.03, 'damage_low' => 100, 'damage_high' => 200, 'attacks_per_round' => 1, 'award_xp' => 2964, 'xp_variation' => 0.2, 'award_gold' => 4, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Drunken Monk', 'attack_text' => 'Monk staggers at you and flails his arms.', 'img_src' => 'monk.gif', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 1000, 'armor' => 0.02, 'damage_low' => 100, 'damage_high' => 145, 'attacks_per_round' => 1, 'award_xp' => 4380, 'xp_variation' => 0.2, 'award_gold' => 6, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Old Wizard', 'attack_text' => 'Fire engulfs your entire being.', 'img_src' => 'wizard.jpeg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 1, 'alignment_strength' => 0.1, 'health' => 1250, 'armor' => 0.02, 'damage_low' => 120, 'damage_high' => 175, 'attacks_per_round' => 1, 'award_xp' => 5275, 'xp_variation' => 0.2, 'award_gold' => 7, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Druid', 'attack_text' => 'Druid attacks you with a war hammer..', 'img_src' => 'druid.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 2500, 'armor' => 0.05, 'damage_low' => 200, 'damage_high' => 305, 'attacks_per_round' => 1, 'award_xp' => 9000, 'xp_variation' => 0.2, 'award_gold' => 10, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Avarial', 'attack_text' => 'An Avarial attacks you with a sword..', 'img_src' => 'avarial.jpeg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 2, 'alignment_strength' => 0.1, 'health' => 3000, 'armor' => 0.05, 'damage_low' => 80, 'damage_high' => 120, 'attacks_per_round' => 3, 'award_xp' => 12200, 'xp_variation' => 0.2, 'award_gold' => 11, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Kreen', 'attack_text' => 'A kreen attacks you with sharp claws and teeth.', 'img_src' => 'kreen.jpeg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 3500, 'armor' => 0.0, 'damage_low' => 70, 'damage_high' => 102, 'attacks_per_round' => 4, 'award_xp' => 15650, 'xp_variation' => 0.2, 'award_gold' => 12, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Unicorn', 'attack_text' => 'You see a unicorn.', 'img_src' => 'unicorn.jpb', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 3, 'alignment_strength' => 0.1, 'health' => 350000, 'armor' => 0.3, 'damage_low' => 325, 'damage_high' => 375, 'attacks_per_round' => 4, 'award_xp' => 1600000, 'xp_variation' => 0.2, 'award_gold' => 1350, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Zombie', 'attack_text' => 'A zombie atacks you.', 'img_src' => 'zombie.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 2075, 'armor' => 0.04, 'damage_low' => 150, 'damage_high' => 195, 'attacks_per_round' => 1, 'award_xp' => 6800, 'xp_variation' => 0.2, 'award_gold' => 8, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Skeleton Warrior', 'attack_text' => 'A Skeleton Warrior attacks you..', 'img_src' => 'mystickel.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 2200, 'armor' => 0.04, 'damage_low' => 175, 'damage_high' => 225, 'attacks_per_round' => 1, 'award_xp' => 7925, 'xp_variation' => 0.2, 'award_gold' => 9, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Blob', 'attack_text' => 'You are swallowed alive.', 'img_src' => 'blob.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 2050, 'armor' => 0.08, 'damage_low' => 180, 'damage_high' => 240, 'attacks_per_round' => 1, 'award_xp' => 7700, 'xp_variation' => 0.2, 'award_gold' => 9, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Nightstalker', 'attack_text' => 'You feel a sharp pain in your skull..', 'img_src' => 'nightst.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 2100, 'armor' => 0.08, 'damage_low' => 175, 'damage_high' => 265, 'attacks_per_round' => 1, 'award_xp' => 8350, 'xp_variation' => 0.2, 'award_gold' => 9, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Old Witch', 'attack_text' => 'An old witch casts a spell on you.', 'img_src' => 'witch.jpb', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 1, 'alignment_strength' => 0.1, 'health' => 2250, 'armor' => 0.04, 'damage_low' => 150, 'damage_high' => 215, 'attacks_per_round' => 1, 'award_xp' => 7925, 'xp_variation' => 0.2, 'award_gold' => 10, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Dead Knight', 'attack_text' => 'A Skeleton Knight attacks you.', 'img_src' => 'skeletonkn.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 50000, 'armor' => 0.2, 'damage_low' => 300, 'damage_high' => 380, 'attacks_per_round' => 2, 'award_xp' => 225000, 'xp_variation' => 0.2, 'award_gold' => 210, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Rookie Guard', 'attack_text' => 'Rookie Guard stumbles towards you', 'img_src' => 'Rookieguards.jpeg', 'is_hostile' => false, 'is_blocking' => true, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 5500, 'armor' => 0.05, 'damage_low' => 400, 'damage_high' => 525, 'attacks_per_round' => 1, 'award_xp' => 24750, 'xp_variation' => 0.2, 'award_gold' => 20, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Castle Guard', 'attack_text' => 'Guard charges on the attack', 'img_src' => 'Castleguard.jpeg', 'is_hostile' => false, 'is_blocking' => true, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 7333, 'armor' => 0.05, 'damage_low' => 175, 'damage_high' => 285, 'attacks_per_round' => 2, 'award_xp' => 8350, 'xp_variation' => 0.2, 'award_gold' => 25, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Elite Guard', 'attack_text' => 'Elite Guard jumps you before you can defend yourself.', 'img_src' => 'Eliteguard.jpeg', 'is_hostile' => false, 'is_blocking' => true, 'alignments_id' => null, 'alignment_strength' => null, 'health' => 14000, 'armor' => 0.1, 'damage_low' => 500, 'damage_high' => 625, 'attacks_per_round' => 1, 'award_xp' => 63750, 'xp_variation' => 0.2, 'award_gold' => 50, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			['name' => 'Drakmor Dragon', 'attack_text' => 'Dragons breath engulfs you with flames', 'img_src' => 'Drakmordragon.jpg', 'is_hostile' => false, 'is_blocking' => false, 'alignments_id' => 2, 'alignment_strength' => 0.1, 'health' => 18000, 'armor' => 0.15, 'damage_low' => 600, 'damage_high' => 715, 'attacks_per_round' => 1, 'award_xp' => 85000, 'xp_variation' => 0.2, 'award_gold' => 65, 'gold_variation' => 0.5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],

		]);
		}
	}
