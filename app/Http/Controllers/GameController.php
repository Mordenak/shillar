<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\CharacterStats;
use App\Room;
use App\SpawnRule;
use App\Npc;
use App\RewardTable;
use App\LootTable;
use App\CharacterStat;
use App\StatCost;
use App\RaceStatAffinity;
use App\Equipment;
use App\Item;
use App\ItemWeapon;
use App\ItemArmor;
use App\UserSetting;

class GameController extends Controller
{
	//
	public function index(Request $request)
		{
		// The request should have a character for us:
		// die(print_r($request->all()));
		// die(print_r($request->character_id));
		// $Character = Character::findOrFail($request->character_id);
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();
			// ->select('character_stats.id as character_stats_id, *');

		if (!$Character)
			{
			return redirect('/home');
			}

		$no_attack = $Character->fatigue > 0 ? false : true;

		$Room = Room::findOrFail($Character->last_rooms_id);

		// Find spawn rules for room:
		$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->first();

		$Npc = null;
		if ($SpawnRule)
			{
			$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
			$prob = rand(0, 1.0);
			if ($prob <= $SpawnRule->chance)
				{
				// then we spawn:
				$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
				// break;
				}
			}
		else
			{
			// no room specific spawns:
			$SpawnRules = SpawnRule::where(['zones_id' => $Room->zones_id])->get();
			if (count($SpawnRules) > 0)
				{
				foreach ($SpawnRules as $SpawnRule)
					{
					// getrandmax()
					$prob = rand() / getrandmax();
					if ($prob <= $SpawnRule->chance)
						{
						// then we spawn:
						$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
						break;
						}
					}
				}
			}

		// die(print_r($Character->playerrace()->name()))s;
		// die(print_r($Room->zone()->get()));

		// $CharacterStats = CharacterStats::where(['characters_id' => $Character->id])
		// 	->join('character_stats', 'characters.id', '=', 'character_stats.character_id');

		// $character = array_merge($Character->pluck(), $CharacterStats->pluck());

		return view('game/main', ['character' => $Character, 'room' => $Room, 'npc' => $Npc, 'no_attack' => $no_attack]);
		}

	public function move(Request $request)
		{
		// Move the character:
		// return $request->room_id;
		// return $request->character_id;
		// return "test";

		$Character = Character::findOrFail($request->character_id);

		// $Character->set(['last_rooms_id' => $request->room_id]);
		$Character->last_rooms_id = $request->room_id;
		$Character->save();

		return $this->index($request);

		// return true;
		/**
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		$Room = Room::findOrFail($Character->last_rooms_id);

		// Find spawn rules for room:
		$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->first();

		$Npc = null;
		if ($SpawnRule)
			{
			$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
			$prob = rand(0, 1.0);
			if ($prob <= $SpawnRule->chance)
				{
				// then we spawn:
				$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
				// break;
				}
			}
		else
			{
			// no room specific spawns:
			$SpawnRules = SpawnRule::where(['zones_id' => $Room->zones_id]);
			if (count($SpawnRules) > 0)
				{
				foreach ($SpawnRules as $SpawnRule)
					{
					$prob = rand(0, 1.0);
					if ($prob <= $SpawnRule->chance)
						{
						// then we spawn:
						$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
						break;
						}
					}
				}
			}

		return view('game/main', ['character' => $Character, 'room' => $Room, 'npc' => $Npc]);
		**/
		}

	public function combat(Request $request)
		{
		// do combat stuff

		// $Character = Character::where(['characters.id' => $request->character_id])
		// 	->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
		// 	->select('character_stats.*', 'characters.*')
		// 	->first();
		$Character = Character::where(['characters.id' => $request->character_id])->first();
		$CharacterStat = CharacterStat::where(['character_stats.characters_id' => $request->character_id])->first();
		// die(print_r($Character));
		// $Npc = Npc::findOrFail($request->npc_id);
		$Npc = Npc::where(['npcs.id' => $request->npc_id])->join('npc_stats', 'npcs.id', '=', 'npc_stats.npcs_id')->first();

		$combat_log = [];
		$loot_log = [];
   		$flat_npc = $Npc->toArray();
   		$Equipment = Equipment::where(['characters_id' => $Character->id])->first();
   		// $total_fatigue = 0;
		while ($flat_npc['health'] > 0)
			{
			if ($CharacterStat->health <= 0)
				{
				break;
				}

			$character_attacks = 1;
			if ($CharacterStat->dexterity > 29)
				{
				$attack_calc = ($character_attacks + ($CharacterStat->dexterity - 10) / 20);
				$character_attacks = (int)$attack_calc;
				}

			// $combat_log[] = "number of attacks: $character_attacks";
			$base_miss = 0.20;
			$base_dodge = 0.05;
			$base_crit = 0.05;
			$crit_multipler_low = 2.0;
			$crit_multipler_high = 4.0;

			$fatigue_use = 1;
			// $fatigue_used = 0;
			while ($character_attacks > 0)
				{
				$character_attacks--;

				// roll for accuracy:
				$acc_check = rand() / getrandmax();
				if ($acc_check <= $base_miss)
					{
					// $combat_log[] = "You missed!";
					$combat_log['pc_miss'] = isset($combat_log['pc_miss']) ? $combat_log['pc_miss']+1 : 1;
					continue;
					}
				
				// $fatigue_use = 1;
				if ($Equipment->weapon)
					{
					$ItemWeapon = ItemWeapon::findOrFail($Equipment->weapon);
					$low_damage = $CharacterStat->constitution + $ItemWeapon->damage_low;
					$high_damage = $CharacterStat->strength + $ItemWeapon->damage_high;
					if ($low_damage > $high_damage)
						{
						$low_damage = $high_damage;
						}
					$damage = rand($low_damage, $high_damage);
					$attack_text = $ItemWeapon->attack_text;
					$fatigue_use = $fatigue_use + $ItemWeapon->fatigue_use;
					}
				else
					{
					$pre_damage = $CharacterStat->strength * 0.4 + $CharacterStat->constitution * 0.2;
					$fists_low = 1;
					$fists_high = 10;
					// go go:
					// $damage = 6;
					$damage = (int)$pre_damage + rand($fists_low, $fists_high);
					$attack_text = "Your fists graze";
					}
				// $total_fatigue = $total_fatigue + $fatigue_use;
				if (($CharacterStat->fatigue - $fatigue_use) < 0)
					{
					$CharacterStat->fatigue = 0;
					}
				else
					{
					$CharacterStat->fatigue = $CharacterStat->fatigue - $fatigue_use;
					}
				$CharacterStat->save();
				$flat_npc['health'] = $flat_npc['health'] - $damage;
				// $combat_log[] = "$attack_text $Npc->name for $damage damage.";
				// $combat_log['pc_attacks'][] = "$attack_text $Npc->name for $damage damage.";
				$combat_log['attacks'][] = $damage;

				if ($flat_npc['health'] <= 0)
					{
					break;
					}
				}

			if ($flat_npc['health'] <= 0)
				{
				break;
				}

			// npc attack
			$damage_resist = $Equipment->calculate_armor();
			// $Npc->attacks_per_round
			// $Npc->damage_types_id
			$npc_attacks = $Npc->attacks_per_round;
			while ($npc_attacks > 0)
				{
				$npc_attacks--;
				$npc_damage = rand($Npc->damage_low, $Npc->damage_high);
				$npc_damage = $npc_damage - $damage_resist;
				if ($npc_damage <= 0)
					{
					// $combat_log[] = "$Npc->name cannot break through your armor!";
					$combat_log['no_damage'] = isset($combat_log['no_damage']) ? $combat_log['no_damage'] + 1 : 0;
					}
				else
					{
					$CharacterStat->health = $CharacterStat->health - $npc_damage;
					// $combat_log[] = "$Npc->name dealt $npc_damage to you!";
					// $combat_log['npc_attacks'][] = "$Npc->name dealt $npc_damage to you!";
					$combat_log['damage_taken'][] = $npc_damage;
					$CharacterStat->save();
					if ($CharacterStat->health <= 0)
						{
						break;
						}	
					}
				}
			}

		// $combat_log[] = "Made it here with: ". $Character->health. "health";
		if ($CharacterStat->health > 0)
			{
			// $combat_log[] = "$Npc->name is dead!!!";
			$combat_log['npc_killed'] = true;
			$RewardTable = RewardTable::where(['reward_tables.npcs_id' => $request->npc_id])->first();

			// $actual_xp = (float)$RewardTable->award_xp * $RewardTable->xp_variation;
			$xp_variation = rand()/getrandmax()*($RewardTable->xp_variation*2)-$RewardTable->xp_variation;

			// $xp_variation = mt_rand() / mt_getrandmax();
			// $combat_log[] = "pre-variation: $xp_variation";
			// $xp_variation = round($xp_variation, 2);
			// $combat_log[] = "variation: $xp_variation";
			$actual_xp = (int)($RewardTable->award_xp * (1.0 + $xp_variation));

			$gold_variation = rand()/getrandmax()*($RewardTable->gold_variation*2)-$RewardTable->gold_variation;

			// $combat_log[] = "pre-variation: $gold_variation";
			// $gold_variation = round($gold_variation, 1);
			// $combat_log[] = "variation: $gold_variation";
			$actual_gold = (int)($RewardTable->award_gold * (1.0 + $gold_variation));

			// die($actual_xp);
			// $actual_xp = $RewardTable->award_xp;
			// die($actual_xp);

			$CharacterStat->xp += $actual_xp;
			$CharacterStat->gold += $actual_gold;
			$CharacterStat->save();
			// $loot_log[] = '';
			$loot_log[] = "You received $actual_xp xp.";
			// $Wallet = Wallet::where(['wallets.characters_id' => $request->character_id])->first();
			// die(print_r($Wallet));
			$loot_log[] = "You received $actual_gold gold.";

			$LootTables = LootTable::where(['npcs_id' => $request->npc_id])->get();

			// This should be an item id?
			// die(print_r($Character->inventory()->first()));
			// die('..:'.$LootTable->items_id);
			if (count($LootTables) > 0)
				{
				foreach ($LootTables as $LootTable)
					{
					$Character->inventory()->first()->addItem($LootTable->items_id);
					$loot_log[] = "You received $LootTable->items_id item?";
					}
				}
			// $LootTable;
			}
		else
			{
			// $combat_log[] = 'You have died!';
			$combat_log['pc_killed'] = true;
			}

		// Combat log will recorded differently if the user setting is on?
		$UserSetting = UserSetting::where(['users_id' => auth()->user()->id])->first();
		$formatted_log = [];
		if ($UserSetting->short_mode)
			{
			$total_attacks = 0;
			if (isset($combat_log['attacks']))
				{
				$total_attacks = count($combat_log['attacks']);
				}

			$total_miss = 0;
			if (isset($combat_log['pc_miss']))
				{
				// die(print_r($combat_log['pc_miss']));
				$total_miss = $combat_log['pc_miss'];
				}
			// shorten:
			// die(print_r(count($combat_log['attacks'])));
			// sum up the attacks:
			$formatted_log[] = "You made $total_attacks attacks and missed $total_miss times.";
			$formatted_log[] = "You did ".array_sum($combat_log['attacks'])." points of damage.";

			if (isset($combat_log['damage_taken']))
				{
				$formatted_log[] = "$Npc->name hit you ".count($combat_log['damage_taken'])." times for ".array_sum($combat_log['damage_taken'])." damage.";
				}

			if (isset($combat_log['npc_killed']))
				{
				$formatted_log[] = "$Npc->name is dead!!!";
				}
			
			
			}
		else
			{
			// die(print_r($formatted_log));
			// everything:
			foreach ($combat_log as $entry)
				{
				$formatted_log[] = $entry;
				}
			}



		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		// return view('game/combat', ['combat_log' => $combat_log, 'loot_log' => $loot_log, 'character' => $Character, 'npc' => $Npc, 'return_room' => $request->room_id]);
		$Room = Room::findOrFail($request->room_id);
		return view('game/main', ['character' => $Character, 'room' => $Room, 'npc' => null, 'combat_log' => $formatted_log, 'loot_log' => $loot_log]);
		}

	public function train(Request $request)
		{
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

		$costs = [
			'strength' => $this->training_cost($Character->strength, $StatCost->strength_cost),
			'dexterity' => $this->training_cost($Character->dexterity, $StatCost->dexterity_cost),
			'constitution' => $this->training_cost($Character->constitution, $StatCost->constitution_cost),
			'wisdom' => $this->training_cost($Character->wisdom, $StatCost->wisdom_cost),
			'intelligence' => $this->training_cost($Character->intelligence, $StatCost->intelligence_cost),
			'charisma' => $this->training_cost($Character->charisma, $StatCost->charisma_cost)
			];

		return view('game/train', ['character' => $Character, 'costs' => $costs]);
		}

	public function training_cost($current_stat, $cost_adjustment)
		{
		$cost = 5.0 * $cost_adjustment;
		$result  = $current_stat * ($current_stat * $cost) - $current_stat;
		return (int)$result;
		}

	public function train_stat(Request $request)
		{
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();



		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

		$costs = [
			'strength' => $this->training_cost($Character->strength, $StatCost->strength_cost),
			'dexterity' => $this->training_cost($Character->dexterity, $StatCost->dexterity_cost),
			'constitution' => $this->training_cost($Character->constitution, $StatCost->constitution_cost),
			'wisdom' => $this->training_cost($Character->wisdom, $StatCost->wisdom_cost),
			'intelligence' => $this->training_cost($Character->intelligence, $StatCost->intelligence_cost),
			'charisma' => $this->training_cost($Character->charisma, $StatCost->charisma_cost)
			];

		// die(print_r($request->submit));
		$stat = $request->submit;

		if ($Character->xp < $costs[$stat])
			{
			//  return an error
			// return false;
			}
		else
			{
			// we can train
			$CharacterStat = CharacterStat::where(['character_stats.characters_id' => $request->character_id])->first();
			$new_stats = $CharacterStat->toArray();

			// unset($new_stats['updated_at']);
			// die(print_r($new_stats));
			// $new_stat = $Character->
			$new_stats[$stat]++;
			$new_stats['xp'] = $new_stats['xp'] - $costs[$stat];

			// factor new health/mana/fatigue:
			// life = str, dex, con
			// mana = wis, int, cha
			// fat = dex, con, wis
			$new_stats['max_health'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'];
			$new_stats['max_mana'] = $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];
			$new_stats['max_fatigue'] = $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'];

			$new_stats['score'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];

			$CharacterStat->fill($new_stats);
			$CharacterStat->save();
			}

		// Refresh values?
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		$costs = [
			'strength' => $this->training_cost($Character->strength, $StatCost->strength_cost),
			'dexterity' => $this->training_cost($Character->dexterity, $StatCost->dexterity_cost),
			'constitution' => $this->training_cost($Character->constitution, $StatCost->constitution_cost),
			'wisdom' => $this->training_cost($Character->wisdom, $StatCost->wisdom_cost),
			'intelligence' => $this->training_cost($Character->intelligence, $StatCost->intelligence_cost),
			'charisma' => $this->training_cost($Character->charisma, $StatCost->charisma_cost)
			];

		return view('game/train', ['character' => $Character, 'costs' => $costs]);
		}

	public function rest(Request $request)
		{
		// die(print_r($request->all()));
		$healing = false;
		if ($request->action == 'heal')
			{
			// die(print_r($request->all()));
			$healing = true;
			$CharacterStat = CharacterStat::where(['character_stats.characters_id' => $request->character_id])->first();

			$healing_amount = ($CharacterStat->constitution * 0.3 + $CharacterStat->strength * 0.1);
			$CharacterStat->health = $CharacterStat->health + (int)$healing_amount;
			if ($CharacterStat->health > $CharacterStat->max_health)
				{
				$CharacterStat->health = $CharacterStat->max_health;
				}

			$fatigue_amount = ($CharacterStat->constitution * 0.2 + $CharacterStat->strength * 0.1 + $CharacterStat->dexterity * 0.1);
			$CharacterStat->fatigue = $CharacterStat->fatigue + (int)$fatigue_amount;
			if ($CharacterStat->fatigue > $CharacterStat->max_fatigue)
				{
				$CharacterStat->fatigue = $CharacterStat->max_fatigue;
				}

			$mana_amount = ($CharacterStat->intelligence * 0.2 + $CharacterStat->wisdom * 0.2);
			$CharacterStat->mana = $CharacterStat->mana + (int)$mana_amount;
			if ($CharacterStat->mana > $CharacterStat->max_mana)
				{
				$CharacterStat->mana = $CharacterStat->max_mana;
				}

			$CharacterStat->save();
			}

		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		return view('game/rest', ['character' => $Character, 'healing' => $healing]);
		}

	public function equipment(Request $request)
		{
		$Character = Character::where(['characters.id' => $request->character_id])
			->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
			->select('character_stats.*', 'characters.*')
			->first();

		// Find current equipment:
		$Equipment = Equipment::where(['characters_id' => $request->character_id])->first();

		if ($request->action == 'equip')
			{
			// die('stuff');
			if ($request->weapon > 0)
				{
				// die(print_r('Got weapon id: '.$request->weapon). ':');
				$Equipment->weapon = $request->weapon;
				// $Equipment->weapon = 1;
				}
			else
				{
				$Equipment->weapon = null;
				}

			if ($request->head > 0)
				{
				$Equipment->head = $request->head;
				}
			else
				{
				$Equipment->head = null;
				}

			if ($request->chest > 0)
				{
				$Equipment->chest = $request->chest;
				}
			else
				{
				$Equipment->chest = null;
				}

			if ($request->legs > 0)
				{
				$Equipment->legs = $request->legs;
				}
			else
				{
				$Equipment->legs = null;
				}

			$Equipment->save();
			}

		// Find all available item equipment:
		// $Inventory = Inventory::where(['characters_id' => $request->character_id])->first();
		// $Character->inventory()->first()->addItem($LootTable->items_id);
		$allitems = $Character->inventory()->first()->items()->get();

		$weapons = [];
		$head_armors = [];
		$chest_armors = [];
		$leg_armors = [];

		// die(print_r($allitems));

		foreach ($allitems as $inv_item)
			{
			// die($inv_item);s
			$Item = Item::findOrFail($inv_item->items_id);
			
			// die($Item);
			if ($Item->item_table == 'item_weapons')
				{
				$ItemWeapon = ItemWeapon::findOrFail($Item->item_table_id);
				$dis_val = $ItemWeapon->toArray();
				$dis_val['selected'] = false;
				if ($Equipment->weapon == $ItemWeapon->id)
					{
					$dis_val['selected'] = true;
					}
				$weapons[] = $dis_val;
				}

			if ($Item->item_table == 'item_armors')
				{
				$ItemArmor = ItemArmor::findOrFail($Item->item_table_id);
				$dis_val = $ItemArmor->toArray();
				$dis_val['selected'] = false;

				if ($ItemArmor->equipment_slot == 'head')
					{
					if ($Equipment->head == $ItemArmor->id)
						{
						$dis_val['selected'] = true;
						}
					$head_armors[] = $dis_val;
					}

				if ($ItemArmor->equipment_slot == 'chest')
					{
					if ($Equipment->chest == $ItemArmor->id)
						{
						$dis_val['selected'] = true;
						}
					$chest_armors[] = $dis_val;
					}

				if ($ItemArmor->equipment_slot == 'legs')
					{
					if ($Equipment->legs == $ItemArmor->id)
						{
						$dis_val['selected'] = true;
						}
					$leg_armors[] = $dis_val;
					}
				}
			}

		// die(print_r($weapons));

		return view('character/equipment', ['character' => $Character, 'weapons' => $weapons, 'heads' => $head_armors, 'chests' => $chest_armors, 'legs' => $leg_armors]);
		}
}
