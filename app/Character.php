<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
	protected $fillable = ['users_id', 'name', 'races_id', 'genders_id', 'alignments_id', 'last_rooms_id', 'xp', 'gold', 'bank', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma', 'quest_points', 'score'];

	public function user()
		{
		return $this->belongsto('App\User', 'users_id')->first();
		}

	public function race()
		{
		return $this->belongsTo('App\Race', 'races_id')->first();
		}

	public function gender()
		{
		return $this->belongsTo('App\Gender', 'genders_id')->first();
		}
		
	public function room()
		{
		return $this->belongsTo('App\Room', 'last_rooms_id')->first();
		}

	public function inventory()
		{
		return $this->hasOne('App\Inventory', 'characters_id')->first();
		}

	public function equipment()
		{
		return $this->hasOne('App\Equipment', 'characters_id')->first();
		}

	public function equipment_list()
		{
		return $this->equipment()->get_all();
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

	public function quests()
		{
		return $this->hasMany('App\CharacterQuest', 'characters_id')->get();
		}

	public function buffs()
		{
		return $this->hasMany('App\CharacterSpellBuff', 'characters_id')->get();
		}

	public function active_buffs()
		{
		return $this->hasMany('App\CharacterSpellBuff', 'characters_id')->where('expires_on', '>', time())->get();
		}

	public function has_buffs()
		{
		return $this->hasMany('App\CharacterSpellBuff', 'characters_id')->where('expires_on', '>', time())->count() > 0 ? true : false;
		}

	public function kill_stats()
		{
		return $this->hasMany('App\KillCount', 'characters_id');
		}

	public function spells()
		{
		return $this->hasMany('App\CharacterSpell', 'characters_id')->orderBy('spells_id','asc');
		}

	public function combat_spells()
		{
		$spells = [];
		foreach ($this->spells()->get() as $spell)
			{
			if ($spell->spell()->is_combat)
				{
				$spells[] = $spell;
				}
			}
		return $spells;
		}

	public function has_spell($id)
		{
		return $this->spells()->where(['spells_id' => $id])->first();
		}

	public function get_modifier(string $modifier_name)
		{
		$RacialModifier = RacialModifier::where(['name' => $modifier_name])->first();
		if (!$RacialModifier)
			{
			return false;
			}
		if ($this->race()->modifiers()->get())
			{
			return $this->race()->modifiers()->where(['racial_modifiers_id' => $RacialModifier->id])->first();
			}
		return false;
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

	public function eligible_teleports()
		{
		$CharacterSpell = $this->has_spell(1);
		// TODO: code this differently to support multiple teleports, or code something else entirely:
		if ($CharacterSpell)
			{
			$TeleportTargets = TeleportTarget::where('spells_id', '=', 1)
				->where('level_req', '<=', $CharacterSpell->level)
				->where('wisdom_req', '<=', $this->wisdom())
				->get();
			return $TeleportTargets;
			}
		return null;
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

	public function kill_count($creature_id)
		{
		return $this->kill_stats()->where(['creatures_id' => $creature_id])->first();
		}

	public function kill_rank()
		{
		$top_kill = $this->kill_stats()->orderBy('count', 'desc')->first();
		$KillRank = KillRank::where('min_count', '<=', $top_kill->count)->orderBy('min_count', 'desc')->first();
		return $top_kill->creature()->name." $KillRank->name";
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
			'light_level' => 0, // TODO: Racial modifier here:
			'strength' => $this->strength,
			'dexterity' => $this->dexterity,
			'constitution' => $this->constitution,
			'wisdom' => $this->wisdom,
			'intelligence' => $this->intelligence,
			'charisma' => $this->charisma,
			'armor' => 3, // armor base is 3
			'avoidance' => 0.0
			];

		// $racial_modifier = $this->race()->modifiers()->where(['racial_modifiers_id' => 2])->first();
		$racial_modifier = $this->get_modifier('HAS_NIGHTVISION');
		if ($racial_modifier)
			{
			$stats['light_level'] = 1;
			}

		// $armor_stats = $this->equipment()->calculate_stats();
		$armor_stats = $this->equipment()->retrieve_stats();
		foreach ($armor_stats as $stat => $value)
			{
			$stats[$stat] = $stats[$stat] + $value;
			}

		$armor_modifier = $this->get_modifier('ARMOR_ADJUSTMENT');
		if ($armor_modifier)
			{
			$stats['armor'] = floor($stats['armor'] * $armor_modifier->value);
			}

		// Check buffs!


		return $stats;
		}

	// TODO: Performance check??
	// helpers
	public function light_level()
		{
		return $this->stats()['light_level'];
		}

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

	public function armor()
		{
		return $this->stats()['armor'];
		}

	public function get_stat($stat)
		{
		return call_user_func_array([$this, $stat], []);
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
		return true;
		}

	public function heal($amount)
		{
		$this->health = $this->health + (int)$amount;
		if ($this->health > $this->max_health)
			{
			$this->health = $this->max_health;
			}
		$this->mana = $this->mana + $amount;
		if ($this->mana > $this->max_mana)
			{
			$this->mana = $this->max_mana;
			}
		$this->fatigue = $this->fatigue + $amount;
		if ($this->fatigue > $this->max_fatigue)
			{
			$this->fatigue = $this->max_fatigue;
			}
		$this->save();
		return true;
		}

	// TODO: Unused atm
	public function deal_damage($damage)
		{
		$this->health = $this->health - $damage;
		if ($this->health <= 0)
			{
			$this->death();
			}
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
		$this->equipment()->remove_all();
		$this->inventory()->remove_all();


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

	// TODO: Maybe change this function name???
	public function can_access($zone)
		{
		if (!$zone->has_restriction())
			{
			return true;
			}
		// Given a zone, can the character access it?
		$reqs = $zone->get_stat_restriction()->decode();
		// die(print_r($reqs));
		$current_stat = call_user_func_array([$this, key($reqs)], []);

		// We know the modifier we want is ID 3:
		$modifier = 1.0;
		$racial_modifier = $this->race()->modifiers()->where(['racial_modifiers_id' => 3])->first();
		if ($racial_modifier)
			{
			$modifier = $racial_modifier->value;
			}

		// Racial check:
		if ($current_stat >= floor(reset($reqs) * $modifier))
			{
			return true;
			}
		return false;
		}

	public function teleport($rooms_id)
		{
		$Room = Room::findOrFail($rooms_id);

		if (!$this->can_access($Room->zone()))
			{
			// error
			return false;
			}

		// Else, go ahead!
		$this->last_rooms_id = $Room->id;
		$this->save();
		return true;
		}

	public function receive_heat_damage($damage)
		{
		// Ok, first find out if we take modified heat damage due to racial:
		$racial_modifier = $this->race()->modifiers()->where(['racial_modifiers_id' => 7])->first();
		if ($racial_modifier)
			{
			// TODO: floor or round?
			$damage = floor($damage * $racial_modifier->value);
			}

		// Then if you have any protection from equipment:
		if (isset($this->stats()['heat_protection']))
			{
			$damage = $damage * (1.0 - $this->stats()['heat_protection']);
			}

		if ($damage > 0)
			{
			$this->health = $this->health - $damage;
			$this->save();
			}
		
		return $damage;
		}

	public function receive_cold_damage($damage)
		{
		// Ok, first find out if we take modified heat damage due to racial:
		$racial_modifier = $this->race()->modifiers()->where(['racial_modifiers_id' => 8])->first();
		if ($racial_modifier)
			{
			// TODO: floor or round?
			$damage = floor($damage * $racial_modifier->value);
			}

		// Then if you have any protection from equipment:
		if (isset($this->stats()['cold_protection']))
			{
			$damage = $damage * (1.0 - $this->stats()['cold_protection']);
			}

		if ($damage > 0)
			{
			$this->health = $this->health - $damage;
			$this->save();
			}
		
		return $damage;
		}
	}
