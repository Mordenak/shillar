<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestTask extends Model
{
	protected $fillable = ['quests_id', 'uid', 'name', 'description', 'seq'];

	public function criteria()
		{
		return $this->hasOne('App\QuestCriteria', 'quest_tasks_id')->first();
		}
}
