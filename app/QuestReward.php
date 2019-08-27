<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestReward extends Model
{
	protected $fillable = ['quests_id', 'item_reward', 'xp_reward', 'gold_reward', 'quest_point_reward', 'item_choices'];
}
