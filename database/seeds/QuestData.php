<?php

use Illuminate\Database\Seeder;

class QuestData extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Starts @ id 5
		DB::table('quests')->insert([
			['name' => 'Clear the Beach', 'description' => null, 'optional' => false, 'wisdom_req' => 0, 'intelligence_req' => 0, 'score_req' => 0, 'progression_req' => null, 'quest_prereq' => null, 'pickup_rooms_id' => 30, 'turnin_rooms_id' => null, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);

		DB::table('quest_rewards')->insert([
			['quests_id' => 1, 'xp_reward' => 0, 'gold_reward' => 0, 'quest_point_reward' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		]);
	}
}
