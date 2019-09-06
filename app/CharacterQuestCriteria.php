<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class CharacterQuestCriteria extends Model
	{
	protected $fillable = ['quest_criterias_id', 'character_id', 'character_quests_id', 'progress', 'complete'];

	public function quest()
		{
		return $this->belongsTo('App\CharacterQuest', 'character_quests_id')->first();
		}

	public function criteria()
		{
		return $this->belongsTo('App\QuestCriteria', 'quest_criterias_id')->first();
		}

	// Why does this not want to work??
	// public function task()
	// 	{
	// 	return $this->hasOneThrough('App\QuestTask', 'App\QuestCriteria', 'quest_tasks_id')->first();
	// 	}

	public function complete()
		{
		$this->complete = true;
		$this->save();

		$this->quest()->check_completes();

		if ($this->criteria()->task()->completion_message)
			{
			Session::put('quest_text', $this->criteria()->task()->completion_message);
			}

		return true;
		}
	}
