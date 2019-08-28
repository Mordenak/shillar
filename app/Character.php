<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
	protected $fillable = ['users_id', 'name', 'player_races_id', 'alignments_id', 'last_rooms_id', 'xp', 'gold', 'bank', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma', 'quest_points', 'score'];

	public function user()
		{
		return $this->belongsto('App\User', 'users_id')->first();
		}

	public function playerrace()
		{
		return $this->belongsTo('App\PlayerRace', 'player_races_id')->first();
		}

	public function inventory()
		{
		return $this->hasOne('App\Inventory', 'characters_id')->first();
		}

	public function equipment()
		{
		return $this->hasOne('App\Equipment', 'characters_id')->first();
		}

	public function trader_items()
		{
		return $this->hasMany('App\TraderItem', 'characters_id')->get();
		}

	public function alignment()
		{
		return $this->belongsTo('App\Alignment', 'alignments_id')->first();
		}

	public function settings()
		{
		return $this->hasOne('App\CharacterSetting', 'characters_id')->first();
		}

	public function kill_stats()
		{
		return $this->hasOne('App\KillCount', 'characters_id');
		}

	public function spells()
		{
		return $this->hasMany('App\CharacterSpell', 'character_id')->orderBy('spells_id','asc')->get();
		}

	public function spell_ids()
		{
		$arr = [];
		foreach ($this->spells() as $spell)
			{
			$arr[] = $spell->id;
			}
		return $arr;
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

	public function display_rank()
		{
		$WallScoreRank = WallScoreRank::where('score_req', '<=', $this->score)->orderBy('score_req', 'desc')->first();

		if ($WallScoreRank)
			{
			return '<span style="color:#'.$WallScoreRank->color.';">'.$WallScoreRank->name.'</span>';
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

	// Almost everything in the game will be checking against THESE stats:
	// Raw stats mostly just for training/wall score.
	public function stats()
		{
		$stats = [
			'strength' => $this->strength,
			'dexterity' => $this->dexterity,
			'constitution' => $this->constitution,
			'wisdom' => $this->wisdom,
			'intelligence' => $this->intelligence,
			'charisma' => $this->charisma,
			];

		$armor_stats = $this->equipment()->calculate_stats();
		foreach ($armor_stats as $stat => $value)
			{
			$stats[$stat] = $stats[$stat] + $value;
			}

		return $stats;
		}

	// TODO: Performance check??
	// helpers 
	public function strength()
		{
		return $this->stats()['strength'];
		}

	public function dexterity()
		{
		return $this->stats()['dexterity'];
		}

	public function constitution()
		{
		return $this->stats()['constitution'];
		}

	public function wisdom()
		{
		return $this->stats()['wisdom'];
		}

	public function intelligence()
		{
		return $this->stats()['intelligence'];
		}

	public function charisma()
		{
		return $this->stats()['charisma'];
		}

	public function refresh_score()
		{
		$this->score = $this->strength + $this->dexterity + $this->constitution + $this->wisdom + $this->intelligence + $this->charisma + $this->quest_points;
		$this->save();

		return true;
		}

	public function calc_quick_stats()
		{
		$stats = $this->stats();
		$this->max_health = $stats['strength'] + $stats['constitution'] + $stats['dexterity'];
		$this->max_mana = $stats['wisdom'] + $stats['intelligence'] + $stats['charisma'];
		$this->max_fatigue = $stats['dexterity'] + $stats['constitution'] + $stats['wisdom'];
		$this->save();

		$this->inventory()->max_weight = $stats['strength'];
		$this->inventory()->save();

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
		$this->last_rooms_id = 1;

		// unequip everything:


		$this->save();
		$this->calc_quick_stats();
		$this->health = $this->max_health;
		$this->mana = $this->max_mana;
		$this->fatigue = $this->max_fatigue;
		$this->save();
		$this->refresh_score();
		return true;
		}

	public function get_trader_items()
		{
		// TODO: Refactor this to account for which trader is at:
		$arr = [];
		if ($this->trader_items()->count() > 0)
			{
			foreach ($this->trader_items() as $trader_item)
				{
				// TODO: Refactor the price calculation
				$price = round(($trader_item->item()->value * 0.66) / $this->charisma, 0);
				$arr[] = ['id' => $trader_item->id, 'label' => $trader_item->item()->name." ($price) from ".$trader_item->from_character()->name, 'type' => $trader_item->item()->item_types_id];
				}
			}
		return $arr;
		}
}
