<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\WallScoreRank;

class Character extends Model
{
    protected $fillable = ['users_id', 'name', 'player_races_id', 'last_rooms_id', 'xp', 'gold', 'bank', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma', 'score'];

	public function playerrace()
		{
		return $this->belongsTo('App\PlayerRace', 'player_races_id')->first();
		}

	// public function stats()
	// 	{
	// 	return $this->hasOne('App\CharacterStat', 'characters_id')->first();
	// 	}

	public function inventory()
		{
		return $this->hasOne('App\Inventory', 'characters_id')->first();
		}

	public function equipment()
		{
		return $this->hasOne('App\Equipment', 'characters_id')->first();
		}

	public function rank()
		{
		// Get rank:
		$WallScoreRank = WallScoreRank::where('score_req', '<=', $this->score)->orderBy('score_req', 'desc')->first();

		if ($WallScoreRank)
			{
			return $WallScoreRank->name;
			}
		return true;
		}

	public function display_name()
		{
		// Get rank:
		$WallScoreRank = WallScoreRank::where('score_req', '<=', $this->score)->orderBy('score_req', 'desc')->first();

		if ($WallScoreRank)
			{
			return '<span style="color:#'.$WallScoreRank->color.';">'.$this->name.'</span>';
			}
		return true;
		}

	public function refreshScore()
		{
		$this->score = $this->strength + $this->dexterity + $this->constitution + $this->wisdom + $this->intelligence + $this->charisma;
		$this->save();

		return true;
		}

	public function calcQuickStats()
		{
		$this->max_health = $this->strength + $this->constitution + $this->dexterity;
		$this->max_mana = $this->wisdom + $this->intelligence + $this->charisma;
		$this->max_fatigue = $this->dexterity + $this->constitution + $this->wisdom;
		$this->save();

		return true;
		}

	public function heal($amount)
		{
		$this->health = $this->health + (int)$amount;
		if ($this->health > $this->max_health)
			{
			$this->health = $this->max_health;
			}
		$this->fatigue = $this->fatigue + $amount;
		if ($this->fatigue > $this->max_fatigue)
			{
			$this->fatigue = $this->max_fatigue;
			}
		$this->save();
		return true;
		}

	public function death()
		{
		if ($this->strength != 0)
			{
			$this->strength = $this->strength - 1;
			}

		if ($this->dexterity != 0)
			{
			$this->dexterity = $this->dexterity - 1;
			}

		if ($this->constitution != 0)
			{
			$this->constitution = $this->constitution - 1;
			}

		if ($this->wisdom != 0)
			{
			$this->wisdom = $this->wisdom - 1;
			}

		if ($this->intelligence != 0)
			{
			$this->intelligence = $this->intelligence - 1;
			}

		if ($this->charisma != 0)
			{
			$this->charisma = $this->charisma - 1;
			}

		$this->xp = 0;
		$this->gold = 0;
		$this->death_count = $this->death_count + 1;

		$this->save();
		$this->calcQuickStats();
		$this->health = $this->max_health;
		$this->mana = $this->max_mana;
		$this->fatigue = $this->max_fatigue;
		$this->save();
		$this->refreshScore();
		return true;
		}
}
