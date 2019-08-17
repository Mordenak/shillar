<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStats extends Model
{
	protected $fillable = ['characters_id', 'xp', 'gold', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma'];

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
