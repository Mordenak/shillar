<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Character;
use App\Room;
use App\SpawnRule;
use App\Npc;
use App\RewardTable;
use App\LootTable;
use App\StatCost;
use App\RaceStatAffinity;
use App\Equipment;
use App\Item;
use App\ItemWeapon;
use App\ItemArmor;
use App\UserSetting;
use App\ItemFood;
use App\ItemAccessory;
use App\CombatLog;
use App\KillCount;
use App\InventoryItem;
use App\Shop;
use App\ShopItem;

class GameController extends Controller
{
	//
	public function index(Request $request)
		{
		// TODO: This should be unreachable?
		if (!auth()->user())
			{
			return redirect('/home');
			}

		$Character = Character::findOrFail($request->character_id);

		// die(print_r(Equipment::all()->toArray()));
			// ->select('character_stats.id as character_stats_id, *');

		if (!$Character)
			{
			return redirect('/home');
			}

		$no_attack = $Character->fatigue > 0 ? false : true;
		$CombatLog = CombatLog::where(['characters_id' => $Character->id])->first();
		if ($CombatLog)
			{
			$no_attack = false;
			}

		$Room = Room::findOrFail($Character->last_rooms_id);

		$Npc = null;
		// Block spawn in certain events:
		// $request->session()->get('npc.'.$Room->id);
		if ($request->session()->has('npc.'.$Room->id))
			{
			// die(print_r($request->session()->get('npc.'.$Room->id)));
			$Npc = Npc::where(['id' => $request->session()->get('npc.'.$Room->id)])->first();
			$request->session()->pull('npc.'.$Room->id);
			// die(print_r($Npc->id));
			}

		if (isset($request->no_spawn))
			{
			// ignore
			}
		else
			{
			// Find spawn rules for room:
			$SpawnRule = SpawnRule::where(['rooms_id' => $Room->id])->inRandomOrder()->first();

			if ($SpawnRule && $Room->spawns_enabled)
				{
				$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
				$prob = rand() / getrandmax();
				if ($prob <= $SpawnRule->chance)
					{
					// then we spawn:
					$Npc = Npc::where(['id'=> $SpawnRule->npcs_id])->first();
					$request->session()->put('npc.'.$Room->id, $Npc->id);
					// break;
					}
				}
			else
				{
				if ($Room->spawns_enabled)
					{
					// no room specific spawns:
					$SpawnRules = SpawnRule::where(['zones_id' => $Room->zones_id])->inRandomOrder()->get();
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
								$request->session()->put('npc.'.$Room->id, $Npc->id);
								break;
								}
							}
						}
					}
				}
			}

		// Does the room have loot?
		$ground_items = [];
		$loot_items = $request->session()->get('loot.'.$Room->id);
		if (isset($loot_items))
			{
			$item_ids = [];
			foreach ($loot_items as $loot_item)
				{
				$item_ids[] = $loot_item;
				}
			// die(print_r($item_ids));
			$ground_items = Item::whereIn('id', $item_ids)->get();
			}

		$request_params = ['character' => $Character, 'room' => $Room, 'npc' => $Npc, 'no_attack' => $no_attack, 'ground_items' => $ground_items];

		// Small checks:
		if ($Room->can_train())
			{
			$request_params['multi'] = $request->train_multi ? $request->train_multi : 1;
			$request_params['costs'] = $this->calculate_training_cost($request);
			// $request_params['costs'] = $request->costs;
			}

		if ($Room->has_property('WALL_SCORE'))
			{
			$Results = Character::select()->orderBy('score', 'desc')->get();
			// display name them as well:
			// die(print_r($Results));
			$request_params['score_list'] = $Results;
			}

		if ($request->death)
			{
			$request_params['death'] = true;
			}

		if ($request->no_carry)
			{
			$request_params['no_carry'] = true;
			}

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}

		$request_params['room_custom'] = null;
		if ($Room->can_train())
			{
			$view = \View::make('game/train', $request_params);
			$request_params['room_custom'] = $view->render();
			}

		if ($Room->has_shop())
			{
			$request_params['shop'] = $Room->shop();

			$view = \View::make('game/shop', $request_params);
			$request_params['room_custom'] = $view->render();
			}

		// $character = array_merge($Character->pluck(), $Characters->pluck());;
		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
		}

	public function menu(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$request_params = ['character' => $Character];
		// return $this->index($request);
		if ($request->ajax())
			{
			// $this->index($request)
			$view = \View::make('partials/menu', $request_params);
			$sections = $view->renderSections();
			return $sections['menu'];
			}

		return view("partials/menu", $request_params);
		// return view('game/main', $request_params);
		}

	public function move(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// Just double check that the room is reachable?
		$LastRoom = Room::findOrFail($Character->last_rooms_id);

		if (!$LastRoom->is_reachable($request->room_id))
			{
			// Don't move:
			return $this->index($request);
			}

		$Character->last_rooms_id = $request->room_id;
		$Character->save();

		return $this->index($request);
		}

	public function combat(Request $request)
		{
		// error_log('Start combat');
		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		if ($Character->health <= 0)
			{
			return $this->death($request);
			}

		$flat_npc = null;
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'npcs_id' => $request->npc_id, 'rooms_id' => $request->room_id])->first();
		if ($CombatLog)
			{
			$Npc = Npc::findOrFail($request->npc_id);
			$flat_npc = $Npc->toArray();
			$flat_npc['health'] = $CombatLog->remaining_health;
			}
		else
			{
			$Npc = Npc::findOrFail($request->npc_id);
			$flat_npc = $Npc->toArray();
			}

		$combat_log = [];
		$reward_log = [];
		// $flat_npc = $Npc->toArray();
		// $Equipment = Equipment::where(['characters_id' => $Character->id])->first();
		// Calculate attacks:
		$attack_count = (int)($Character->dexterity / 20) + 2;
		$total_damage = 0;
		$low_damage = $Character->constitution;
		$high_damage = $Character->strength;
		// $current_fatigue = $Character->fatigue;
		$flat_character = $Character->toArray();
		$fatigue_use = 1;
		$attack_text = 'You grope with your fists.';
		$combat_record = [];

		$base_accuracy = 0.80;
		// $base_dodge = 0.05;
		// $base_crit = 0.05;
		// $crit_multipler_low = 2.0;
		// $crit_multipler_high = 4.0;
		if ($Character->equipment()->weapon)
			{
			$low_damage = $low_damage + $Character->equipment()->weapon()->low_damage;
			$high_damage = $high_damage + $Character->equipment()->weapon()->high_damage;
			$attack_text = $Character->equipment()->weapon()->attack_text;
			// check weapon requirements:
			$fatigue_use = 2;
			}

		// $combat_notes['attack_text'] = $attack_text;

		while ($flat_npc['health'] > 0)
			{
			$start_time = time();
			if ($flat_character['health'] <= 0 || $flat_npc['health'] <= 0)
				{
				break;
				}				

			$round_damage = 0;
			$round_damages = [];
			$miss_count = 0;
			// npc
			$npc_damages = [];
			$npc_round_damage = 0;
			$npc_absorbs = 0;
			$no_fatigue = false;
			// We attack first:
			foreach (range(1, $attack_count) as $i)
				{
				if ($flat_npc['health'] <= 0)
					{
					break;
					}

				if ($flat_character['fatigue'] < $fatigue_use)
					{
					$no_fatigue = true;
					break;
					}

				$flat_character['fatigue'] = $flat_character['fatigue'] - $fatigue_use;

				$acc_check = rand() / getrandmax();
				if ($acc_check <= $base_accuracy)
					{
					$calc_damage = rand($low_damage, $high_damage);
					$actual_damage = (int)($calc_damage * (1.0 - $flat_npc['armor']));

					$flat_npc['health'] = $flat_npc['health'] - $actual_damage;
					$round_damage += $actual_damage;
					$round_damages[] = $actual_damage;
					}
				else
					{
					$miss_count++;
					}
				}

			if ($flat_npc['health'] > 0)
				{
				// Then npc:
				foreach (range(1, $flat_npc['attacks_per_round']) as $i)
					{
					$calc_damage = rand($flat_npc['damage_low'], $flat_npc['damage_high']);
					$npc_damage = $calc_damage - $Character->equipment()->calculate_armor();
					if ($npc_damage <= 0)
						{
						// No damage:
						$npc_absorbs++;
						}
					else
						{
						$flat_character['health'] = $flat_character['health'] - $npc_damage;
						$npc_damages[] = $npc_damage;
						$npc_round_damage += $npc_damage;

						if ($flat_character['health'] <= 0)
							{
							break;
							}	
						}
					}
				}

			// Record the round:
			$arr = [
				'attack_text' => $attack_text,
				'attack_count' => count($round_damages) + $miss_count,
				'miss_count' => $miss_count,
				'attacks' => $round_damages,
				'round_damage' => $round_damage,
				'npc_text' => $flat_npc['attack_text'],
				'npc_att_count' => $flat_npc['attacks_per_round'],
				'npc_round' => $npc_round_damage,
				'npc_attacks' => $npc_damages,
				'no_fatigue' => $no_fatigue,
				];

			// player died:
			if ($flat_character['health'] <= 0)
				{
				$arr['pc_died'] = true;
				}

			$combat_record[] = $arr;

			$finish = time() - $start_time;
			error_log("This round took $finish seconds.");

			// We ran out of fatigue:
			if ($flat_character['fatigue'] < $fatigue_use)
				{
				break;
				}

			// If the npc died:
			if ($flat_npc['health'] <= 0)
				{
				break;
				}

			if ($request->submit != 'all_out')
				{
				break;
				}
			}

		// Save the character record based on the $flat_character:
		$Character->fill($flat_character);
		$Character->save();
		$Character->fresh();

		$reward_log = [];

		// Out of the loop, who died?
		if ($flat_npc['health'] > 0 && $flat_character['health'] > 0)
			{
			// $request->session()->put('combat.'.$Character->id, $flat_npc);
			if ($CombatLog)
				{
				$CombatLog->remaining_health = $flat_npc['health'];
				}
			else
				{
				$CombatLog = new CombatLog;
				$CombatLog->fill([
					'characters_id' => $Character->id,
					'npcs_id' => $Npc->id,
					'rooms_id' => $request->room_id,
					'remaining_health' => $flat_npc['health'],
					'expires_on' => time() + 1800
					]);
				}
			$CombatLog->save();
			}
		elseif ($flat_npc['health'] <= 0)
			{
			// Clean up session?
			$request->session()->pull('npc.'.$Room->id);
			// npc died
			// $combat_log[] = "$Npc->name is dead!!!";
			// $combat_log['npc_killed'] = true;
			$reward_log[] = "You beat the poor creature down to a bloody pulp.  With a last breath it dies.";
			// clean session:
			// $request->session()->pull('combat.'.$Character->id);
			if ($CombatLog)
				{
				$CombatLog->delete();
				$CombatLog = null;
				}

			// Record the kill:
			$KillCount = KillCount::where(['characters_id' => $Character->id, 'npcs_id' => $Npc->id])->first();
			if ($KillCount)
				{
				$KillCount->count = $KillCount->count + 1;
				}
			else
				{
				$KillCount = new KillCount;
				$KillCount->fill([
					'characters_id' => $Character->id,
					'npcs_id' => $Npc->id,
					'count' => 1
					]);
				}

			$KillCount->save();

			$xp_variation = rand()/getrandmax()*($Npc->xp_variation*2)-$Npc->xp_variation;
			$actual_xp = (int)($Npc->award_xp * (1.0 + $xp_variation));

			$gold_variation = rand()/getrandmax()*($Npc->gold_variation*2)-$Npc->gold_variation;

			$actual_gold = (int)($Npc->award_gold * (1.0 + $gold_variation));
			if ($actual_gold == 0)
				{
				$actual_gold = 1;
				}

			$Character->xp += $actual_xp;
			$Character->gold += $actual_gold;
			$Character->save();
			$reward_log[] = "You received $actual_xp xp.";

			$reward_log[] = "You received $actual_gold gold.";
			$reward_log[] = '';

			$LootTables = LootTable::where(['npcs_id' => $request->npc_id])->get();

			if (count($LootTables) > 0)
				{
				foreach ($LootTables as $LootTable)
					{
					$prob = rand()/getrandmax();
					if ($prob <= $LootTable->chance)
						{
						// TODO: So we actually want to add this to the session instead:
						if ($request->session()->has('loot.'.$request->room_id))
							{
							$current_items = $request->session()->get('loot.'.$request->room_id);
							if (!in_array($LootTable->items_id, $current_items))
								{
								$request->session()->push('loot.'.$request->room_id, $LootTable->items_id);
								}
							}
						else
							{
							$request->session()->put('loot.'.$request->room_id, [$LootTable->items_id]);
							}
						}
					}
				}

			}
		elseif ($flat_character['health'] <= 0)
			{
			// we died:
			// return $this->death($request);
			}
		else
			{
			// ??
			}

		// Does the room have loot?
		$ground_items = [];
		$loot_items = $request->session()->get('loot.'.$Room->id);
		if (isset($loot_items))
			{
			$item_ids = [];
			foreach ($loot_items as $loot_item)
				{
				$item_ids[] = $loot_item;
				}
			$ground_items = Item::whereIn('id', $item_ids)->get();
			}

		$no_attack = $Character->fatigue > 0 ? false : true;
		if ($CombatLog)
			{
			$no_attack = false;
			}

		$request_params = ['character' => $Character, 'room' => $Room, 'npc' => null, 'combat_log' => $combat_record, 'reward_log' => $reward_log, 'ground_items' => $ground_items, 'no_attack' => $no_attack];

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}

		if ($flat_character['health'] <= 0)
			{
			$Character->death();
			$Character->fresh();
			$Room = Room::findOrFail($Character->last_rooms_id);
			if ($request->ajax())
				{
				$view = \View::make('game/main', $request_params);
				$sections = $view->renderSections();
				return $sections;
				}
			}

		if ($CombatLog)
			{
			// debug:
			$request_params['combat'] = $CombatLog->fresh();
			$request_params['timer'] = true;
			$request_params['npc'] = $Npc;
			}

		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
		}

	public function show_stats(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		return view('/character/stats', ['character' => $Character]);
		}

	public function death(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// drop all stats:
		$Character->death();
		$Character->last_rooms_id = 1;
		$Character->save();
		$request->death = true;
		return $this->index($request);
		}

	public function item_pickup(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$current_list = $request->session()->get('loot.'.$request->room_id);

		// $request->no_spawn = true;
		$received = $Character->inventory()->addItem($request->item_id);
		if (!$received)
			{
			$request->no_carry = true;
			}
		else
			{
			if (($key = array_search($request->item_id, $current_list)) !== false)
				{
				unset($current_list[$key]);
				}

			$request->session()->put('loot.'.$request->room_id, $current_list);
			}

		return $this->index($request);
		}

	public function train(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		$selected_multi = 1;
		if ($request->train_multi)
			{
			$selected_multi = $request->train_multi;
			}
		$costs = $this->calculate_training_cost($request);
		$request->costs = $costs;

		$stat = $request->submit;

		// die(print_r($request->all()));
		if ($stat === null)
			{
			return $this->index($request);
			// return view('game/train', ['character' => $Character, 'costs' => $costs, 'multi' => $selected_multi]);
			}
		
		if ($Character->xp < $costs[$stat])
			{
			//  return an error
			// return false;
			}
		else
			{
			// we can train
			// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();
			$new_stats = $Character->toArray();

			// unset($new_stats['updated_at']);
			// die(print_r($new_stats));
			// $new_stat = $Character->
			// $new_stats[$stat]++;
			$new_stats[$stat] = $new_stats[$stat] + $request->train_multi;
			$new_stats['xp'] = $new_stats['xp'] - $costs[$stat];

			// factor new health/mana/fatigue:
			// life = str, dex, con
			// mana = wis, int, cha
			// fat = dex, con, wis
			$new_stats['max_health'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'];
			$new_stats['max_mana'] = $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];
			$new_stats['max_fatigue'] = $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'];

			$new_stats['score'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];

			$Character->fill($new_stats);
			$Character->save();
			}

		// Refresh values?
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		$costs = $this->calculate_training_cost($request);
		$request->costs = $costs;


		return $this->index($request);
		// return view('game/train', ['character' => $Character, 'costs' => $costs, 'multi' => $selected_multi]);
		}

	public function training_cost($current_stat, $cost_adjustment)
		{
		// My old calc:
		// $cost = 5.0 * $cost_adjustment;
		$cost = $cost_adjustment;
		$result  = $current_stat * ($current_stat * $cost) - $current_stat;
		return (int)$result;
		}

	public function calculate_training_cost(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])->first();

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

		// $request->train_multi;
		$base_stats = [
			'strength' => $Character->strength,
			'dexterity' => $Character->dexterity,
			'constitution' => $Character->constitution,
			'wisdom' => $Character->wisdom,
			'intelligence' => $Character->intelligence,
			'charisma' => $Character->charisma,
			];

		$costs = [
			'strength' => 0,
			'dexterity' => 0,
			'constitution' => 0,
			'wisdom' => 0,
			'intelligence' => 0,
			'charisma' => 0,
			];

		if ($request->train_multi)
			{
			$train_multi = $request->train_multi;
			}
		else
			{
			$train_multi = 1;
			}

		while ($train_multi > 0)
			{
			// get the training costs:
			$costs['strength'] = $costs['strength'] + $this->training_cost($base_stats['strength'], $StatCost->strength_cost);
			$costs['dexterity'] = $costs['dexterity'] + $this->training_cost($base_stats['dexterity'], $StatCost->dexterity_cost);
			$costs['constitution'] = $costs['constitution'] + $this->training_cost($base_stats['constitution'], $StatCost->constitution_cost);
			$costs['wisdom'] = $costs['wisdom'] + $this->training_cost($base_stats['wisdom'], $StatCost->wisdom_cost);
			$costs['intelligence'] = $costs['intelligence'] + $this->training_cost($base_stats['intelligence'], $StatCost->intelligence_cost);
			$costs['charisma'] = $costs['charisma'] + $this->training_cost($base_stats['charisma'], $StatCost->charisma_cost);
			// cleanup:
			$train_multi--;
			$base_stats['strength']++;
			$base_stats['dexterity']++;
			$base_stats['constitution']++;
			$base_stats['wisdom']++;
			$base_stats['intelligence']++;
			$base_stats['charisma']++;
			}

		return $costs;
		}

	public function train_stat(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// $StatCost = StatCost::first();
		$StatCost = StatCost::where(['player_races_id' => $Character->player_races_id])->first();

		/*
		$costs = [
			'strength' => $this->training_cost($Character->strength, $StatCost->strength_cost),
			'dexterity' => $this->training_cost($Character->dexterity, $StatCost->dexterity_cost),
			'constitution' => $this->training_cost($Character->constitution, $StatCost->constitution_cost),
			'wisdom' => $this->training_cost($Character->wisdom, $StatCost->wisdom_cost),
			'intelligence' => $this->training_cost($Character->intelligence, $StatCost->intelligence_cost),
			'charisma' => $this->training_cost($Character->charisma, $StatCost->charisma_cost)
			];
			*/
		$costs = $this->calculate_training_cost($request);

		// die(print_r($request->submit));
		$stat = $request->submit;

		if ($stat != 'on')
			{	
			if ($Character->xp < $costs[$stat])
				{
				//  return an error
				// return false;
				}
			else
				{
				// we can train
				// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();
				$new_stats = $Character->toArray();

				// unset($new_stats['updated_at']);
				// die(print_r($new_stats));
				// $new_stat = $Character->
				// $new_stats[$stat]++;
				$new_stats[$stat] = $new_stats[$stat] + $request->train_multi;
				$new_stats['xp'] = $new_stats['xp'] - $costs[$stat];

				// factor new health/mana/fatigue:
				// life = str, dex, con
				// mana = wis, int, cha
				// fat = dex, con, wis
				$new_stats['max_health'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'];
				$new_stats['max_mana'] = $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];
				$new_stats['max_fatigue'] = $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'];

				// $new_stats['score'] = $new_stats['strength'] + $new_stats['dexterity'] + $new_stats['constitution'] + $new_stats['wisdom'] + $new_stats['intelligence'] + $new_stats['charisma'];

				$Character->fill($new_stats);
				$Character->save();
				$Character->refreshScore();
				}
			}

		// Refresh values?
		$Character = Character::findOrFail($request->character_id);
		// $Character = Character::where(['characters.id' => $request->character_id])
		// 	->join('character_stats', 'character_stats.characters_id', '=', 'characters.id')
		// 	->select('character_stats.*', 'characters.*')
		// 	->first();

		$costs = $this->calculate_training_cost($request);

		/*
		$costs = [
			'strength' => $this->training_cost($Character->strength, $StatCost->strength_cost),
			'dexterity' => $this->training_cost($Character->dexterity, $StatCost->dexterity_cost),
			'constitution' => $this->training_cost($Character->constitution, $StatCost->constitution_cost),
			'wisdom' => $this->training_cost($Character->wisdom, $StatCost->wisdom_cost),
			'intelligence' => $this->training_cost($Character->intelligence, $StatCost->intelligence_cost),
			'charisma' => $this->training_cost($Character->charisma, $StatCost->charisma_cost)
			];
			*/

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
			// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();
			$Character = Character::findOrFail($request->character_id);

			$healing_amount = ($Character->constitution * 0.4 + $Character->strength * 0.2);
			$Character->health = $Character->health + (int)$healing_amount;
			if ($Character->health > $Character->max_health)
				{
				$Character->health = $Character->max_health;
				}

			$fatigue_amount = ($Character->constitution * 0.4 + $Character->strength * 0.2 + $Character->dexterity * 0.2);
			$Character->fatigue = $Character->fatigue + (int)$fatigue_amount;
			if ($Character->fatigue > $Character->max_fatigue)
				{
				$Character->fatigue = $Character->max_fatigue;
				}

			$mana_amount = ($Character->intelligence * 0.2 + $Character->wisdom * 0.2);
			$Character->mana = $Character->mana + (int)$mana_amount;
			if ($Character->mana > $Character->max_mana)
				{
				$Character->mana = $Character->max_mana;
				}

			$Character->save();
			}

		$Character = Character::findOrFail($request->character_id);

		return view('game/rest', ['character' => $Character, 'healing' => $healing]);
		}

	public function equipment(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		// Find current equipment:
		$Equipment = Equipment::where(['characters_id' => $request->character_id])->first();

		if ($request->action == 'equip')
			{
			// die('stuff');
			if ($request->weapon > 0)
				{
				$Equipment->weapon = $request->weapon;
				}
			else
				{
				$Equipment->weapon = null;
				}

			if ($request->shield > 0)
				{
				$Equipment->shield = $request->shield;
				}
			else
				{
				$Equipment->shield = null;
				}

			if ($request->head > 0)
				{
				$Equipment->head = $request->head;
				}
			else
				{
				$Equipment->head = null;
				}

			if ($request->neck > 0)
				{
				$Equipment->neck = $request->neck;
				}
			else
				{
				$Equipment->neck = null;
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

			if ($request->hands > 0)
				{
				$Equipment->hands = $request->hands;
				}
			else
				{
				$Equipment->hands = null;
				}

			if ($request->feet > 0)
				{
				$Equipment->feet = $request->feet;
				}
			else
				{
				$Equipment->feet = null;
				}

			if ($request->amulet > 0)
				{
				$Equipment->amulet = $request->amulet;
				}
			else
				{
				$Equipment->amulet = null;
				}

			if ($request->left_ring > 0)
				{
				$Equipment->left_ring = $request->left_ring;
				}
			else
				{
				$Equipment->left_ring = null;
				}

			if ($request->right_ring > 0)
				{
				$Equipment->right_ring = $request->right_ring;
				}
			else
				{
				$Equipment->right_ring = null;
				}

			if ($request->bracelet > 0)
				{
				$Equipment->bracelet = $request->bracelet;
				}
			else
				{
				$Equipment->bracelet = null;
				}

			$Equipment->save();
			}

		// Find all available item equipment:
		// $Inventory = Inventory::where(['characters_id' => $request->character_id])->first();
		// $Character->inventory()->addItem($LootTable->items_id);
		$CharacterItems = $Character->inventory()->character_items();

		$weapons = [];
		$shields = [];
		$head_armors = [];
		$neck_armors = [];
		$chest_armors = [];
		$leg_armors = [];
		$hand_armors = [];
		$feet_armors = [];
		$amulet_items = [];
		$left_rings = [];
		$right_rings = [];
		$bracelet_items = [];

		// die(print_r($allitems));

		foreach ($CharacterItems as $CharacterItem)
			{
			// die($inv_item);s
			$Item = Item::findOrFail($CharacterItem->items_id);
			
			// die($Item);
			if ($Item->item_types_id == 1)
				{
				// $ItemWeapon = ItemWeapon::where(['items_id' => $Item->id])->first();
				// die(print_r($CharacterItem->item()));

				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;
				// die(print_r($Equipment->weapon.' == '.$CharacterItem->id.'::'));
				if ($Equipment->weapon == $CharacterItem->id)
					{
					$dis_val['selected'] = true;
					}
				$weapons[] = $dis_val;
				}

			if ($Item->item_types_id == 2)
				{
				// $ItemArmor = ItemArmor::where(['items_id' => $Item->id])->first();
				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;

				if ($Item->actual_item()->equipment_slot == 2)
					{
					if ($Equipment->shield == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$shields[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 3)
					{
					if ($Equipment->head == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$head_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 4)
					{
					if ($Equipment->neck == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$neck_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 5)
					{
					if ($Equipment->chest == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$chest_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 6)
					{
					if ($Equipment->hands == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$hand_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 7)
					{
					if ($Equipment->legs == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$leg_armors[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 8)
					{
					if ($Equipment->feet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$feet_armors[] = $dis_val;
					}
				}

			if ($Item->item_types_id == 3)
				{
				// $ItemAccessory = ItemAccessory::where(['items_id' => $Item->id])->first();
				$dis_val = $CharacterItem->item()->toArray();
				$dis_val['id'] = $CharacterItem->id;
				$dis_val['selected'] = false;

				if ($Item->actual_item()->equipment_slot == 9)
					{
					if ($Equipment->amulet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$amulet_items[] = $dis_val;
					}

				if ($Item->actual_item()->equipment_slot == 10)
					{
					if ($Equipment->right_ring != $CharacterItem->id)
						{
						if ($Equipment->left_ring == $CharacterItem->id)
							{
							$dis_val['selected'] = true;
							}
						$left_rings[] = $dis_val;
						}

					if ($Equipment->left_ring != $CharacterItem->id)
						{
						if ($Equipment->right_ring == $CharacterItem->id)
							{
							$dis_val['selected'] = true;
							}
						$right_rings[] = $dis_val;
						}
					}

				if ($Item->actual_item()->equipment_slot == 11)
					{
					if ($Equipment->bracelet == $CharacterItem->id)
						{
						$dis_val['selected'] = true;
						}
					$bracelet_items[] = $dis_val;
					}
				}
			}

		// die(print_r($weapons));

		return view('character/equipment', ['character' => $Character, 'weapons' => $weapons, 'shields' => $shields, 'heads' => $head_armors, 'necks' => $neck_armors, 'chests' => $chest_armors, 'legs' => $leg_armors, 'hands' => $hand_armors, 'feets' => $feet_armors, 'amulets' => $amulet_items, 'left_rings' => $left_rings, 'right_rings' => $right_rings, 'bracelets' => $bracelet_items]);
		}

	public function items(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// Find current equipment:
		// $InventoryItems = InventoryItem::where(['characters_id' => $request->character_id])->first();

		if ($request->action == 'consume')
			{
			$Item = Item::findOrFail($request->item);
			if ($Item->item_types_id != 4)
				{
				// error?
				return true;
				}
			$ItemFood = ItemFood::where(['items_id' => $Item->id])->first();
			$Character->heal($ItemFood->potency);
			$Character->inventory()->removeItem($request->item);
			// $request->item;
			// $res = $Character->inventory()->where('items_id' => $request->item);
			}

		$allitems = $Character->inventory()->character_items();

		$items = [];

		// die(print_r($allitems));

		foreach ($allitems as $inv_item)
			{
			// die($inv_item);s
			$Item = Item::findOrFail($inv_item->items_id);

			if ($Item->item_types_id == 4)
				{
				$arr = $Item->toArray();
				$arr['quantity'] = $inv_item->quantity;
				$arr['selected'] = false;
				if (isset($request->item) && $Item->id == $request->item)
					{
					$arr['selected'] = true;
					}
				// $items[] = $Item;
				$items[] = $arr;
				}
			}

		$Character = Character::findOrFail($request->character_id);

		return view('character/items', ['character' => $Character, 'items' => $items]);
		}

	public function purchase(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		// Then we find the item:
		// $PurchaseItem = $Shop->shop_items()->where(['id' => $request->item_purchase])->first();
		$PurchaseItem = ShopItem::where(['id' => $request->item_purchase, 'shops_id' => $Shop->id])->first();

		// $PurchaseItem->item();

		// die(print_r($PurchaseItem->first()));

		// $request_params = ['character' => $Character, 'room' => $Room, 'shop' => $Shop];
		// $price = $PurchaseItem->item()->value * $PurchaseItem->markup;
		$price = $PurchaseItem->get_cost($Character->charisma);

		if ($Character->gold < $price)
			{
			// $request->insufficient_funds = true;
			// die('price');
			Session::flash('purchase', 'You cannot afford that!');
			return $this->index($request);
			// $request_params['insufficient_funds'] = true;
			// return view('game/main', $request_params);
			}

		$received = $Character->inventory()->addItem($PurchaseItem->item()->id);
		if ($received)
			{
			$Character->gold = $Character->gold - $price;
			$Character->save();
			Session::flash('purchase', "You purchased a ".$PurchaseItem->item()->name);
			}
		else
			{
			$request->no_carry = true;
			}

		return $this->index($request);
		}

	public function sell(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);
		// $Room = Room::findOrFail($request->room_id);
		// Probably auth some stuff about the store:
		$Shop = Shop::findOrFail($request->shop_id);

		$SellItem = InventoryItem::findOrFail($request->item_sell);

		// if not, throw error?

		$earnings = round($SellItem->item()->value * 0.01, 0);
		
		
		$sold = $Character->inventory()->removeItem($SellItem->item()->id);
		if ($sold)
			{
			$Character->gold += $earnings;
			$Character->save();
			Session::flash('sell', 'You sold a '.$SellItem->item()->name.' for '.$earnings.' gold.');
			}
		else
			{
			// can't sell for some reason??
			}

		return $this->index($request);
		}
}
