<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
	protected $fillable = ['name', 'description', 'completion_message', 'optional', 'wisdom_req', 'intelligence_req', 'score_req', 'quest_prereq', 'pickup_rooms_id', 'turnin_rooms_id'];

	public function tasks()
		{
		return $this->hasMany('App\QuestTask', 'quests_id')->get();
		}

	public function criterias()
		{
		return $this->hasManyThrough('App\QuestCriteria', 'App\QuestTasks', 'quests_id')->get();
		}

	public function reward()
		{
		return $this->hasOne('App\QuestReward', 'quests_id')->first();
		}

	public function eligible($Character)
		{
		// Determine if the character is eligible for the current quest?
		if ($Character->wisdom < $this->wisdom_req)
			{
			return false;
			}

		if ($Character->intelligence < $this->intelligence_req)
			{
			return false;
			}

		if ($Character->score_req < $this->score_req)
			{
			return false;
			}

		return true;
		}
}
