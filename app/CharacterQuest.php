<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterQuest extends Model
{
	protected $fillable = ['character_id', 'quests_id', 'complete', 'rewarded'];

	public function criterias()
		{
		return $this->hasMany('App\CharacterQuestCriteria', 'character_quests_id')->get();
		}

	public function quest()
		{
		return $this->belongsTo('App\Quest', 'quests_id')->first();
		}

	public function check_completes()
		{
		foreach ($this->criterias() as $criteria)
			{
			if (!$criteria->complete)
				{
				return false;
				}
			}

		$this->complete = true;
		$this->save();
		return true;
		}
}
