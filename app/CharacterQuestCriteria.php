<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterQuestCriteria extends Model
{
	protected $fillable = ['quest_criterias_id', 'character_id', 'character_quests_id', 'progress', 'complete'];

	public function quest()
		{
		return $this->belongsTo('App\CharacterQuest', 'character_quests_id')->first();
		}

	public function complete()
		{
		$this->complete = true;
		$this->save();

		$this->quest()->check_completes();
		return true;
		}
}
