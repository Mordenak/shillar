<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestCriteria extends Model
{
	protected $fillable = ['quest_tasks_id', 'npc_target', 'zone_target', 'room_target', 'room_action_target', 'item_target', 'alignment_target', 'npc_amount'];

	public function task()
		{
		return $this->belongsTo('App\QuestTask', 'quest_tasks_id')->first();
		}

}
