<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestCriteria extends Model
{
	protected $fillable = ['quest_tasks_id', 'creature_target', 'zone_target', 'room_target', 'room_action_target', 'item_target', 'alignment_target', 'creature_amount'];

	public function task()
		{
		return $this->belongsTo('App\QuestTask', 'quest_tasks_id')->first();
		}

}
