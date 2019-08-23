<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombatController extends Controller
{
	/*
	public function old_combat(Request $request)
		{
		// TODO: Refactor, performance is awful at higher levels
		$Character = Character::where(['characters.id' => $request->character_id])->first();
		// $Character = Character::where(['character_stats.characters_id' => $request->character_id])->first();

		// Safety:
		if ($Character->health <= 0)	
			{
			// return $this->death($request);
			}
		
		$flat_npc = null;

		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'npcs_id' => $request->npc_id, 'rooms_id' => $request->room_id])->first();

		if ($CombatLog)	
			{
			// die('something');
			$Npc = Npc::findOrFail($request->npc_id);
			// $Npc = Npc::where(['npcs.id' => $request->npc_id])->join('npc_stats', 'npcs.id', '=', 'npc_stats.npcs_id')->first();
			// $flat_npc = $request->session()->get('combat.'.$Character->id);
			$flat_npc = $Npc->toArray();
			$flat_npc['health'] = $CombatLog->remaining_health;
			// die(print_r($flat_npc);
			}
		else
			{
			// die('no combat log?');
			$Npc = Npc::findOrFail($request->npc_id);
			// $Npc = Npc::where(['npcs.id' => $request->npc_id])->join('npc_stats', 'npcs.id', '=', 'npc_stats.npcs_id')->first();
			$flat_npc = $Npc->toArray();
			// $request->session()->put('combat.'.$Character->id, $Npc->toArray());
			}
		

		$combat_log = [];
		$reward_log = [];
		// $flat_npc = $Npc->toArray();
		$Equipment = Equipment::where(['characters_id' => $Character->id])->first();
		// $total_fatigue = 0;
		$combat_log['begin'] = "You attacked $Npc->name";
		while ($flat_npc['health'] > 0)
			{
			if ($Character->health <= 0)
				{
				break;
				}

			$character_attacks = 1;
			if ($Character->dexterity > 10)
				{
				$character_attacks = 2;
				$attack_calc = ($character_attacks + ($Character->dexterity - 10) / 20);
				$character_attacks = (int)$attack_calc;
				}

			// $combat_log[] = "number of attacks: $character_attacks";
			$base_accuracy = 0.80;
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
				if ($acc_check >= $base_accuracy)
					{
					// $combat_log[] = "You missed!";
					$combat_log['attacks'][] = 0;
					$combat_log['pc_miss'] = isset($combat_log['pc_miss']) ? $combat_log['pc_miss']+1 : 1;
					continue;
					}
				
				$attack_text = 'Your fists graze the enemy';
				$low_damage = 1 + $Character->constitution;
				$high_damage = 10 + $Character->strength;
				if ($low_damage > $high_damage)
					{
					$low_damage = $high_damage;
					}
				// $fatigue_use = 1;
				if ($Character->equipment()->weapon)
					{
					$weapon_id = $Character->inventory()->inventory_items()->where(['id' => $Character->equipment()->weapon])->first();
					$ItemWeapon = ItemWeapon::where(['items_id' => $weapon_id->items_id])->first();
					$attack_text = $ItemWeapon->attack_text;
					// $fatigue_use = $fatigue_use + $ItemWeapon->fatigue_use;
					$fatigue_use = 2;
					$low_damage = $Character->constitution + $ItemWeapon->damage_low;
					$high_damage = $Character->strength + $ItemWeapon->damage_high;
					if ($low_damage > $high_damage)
						{
						$low_damage = $high_damage;
						}
					}
				$combat_log['attack_text'] = $attack_text;
				$damage = rand($low_damage, $high_damage);
				
				// $total_fatigue = $total_fatigue + $fatigue_use;
				if (($Character->fatigue - $fatigue_use) < 0)
					{
					$Character->fatigue = 0;
					}
				else
					{
					$Character->fatigue = $Character->fatigue - $fatigue_use;
					}
				$Character->save();
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
					$Character->health = $Character->health - $npc_damage;
					// $combat_log[] = "$Npc->name dealt $npc_damage to you!";
					// $combat_log['npc_attacks'][] = "$Npc->name dealt $npc_damage to you!";
					$combat_log['damage_taken'][] = $npc_damage;
					$Character->save();
					if ($Character->health <= 0)
						{
						break;
						}	
					}
				}

			// if single round:
			if ($request->submit != 'all_out')
				{
				break;
				}
			}

		$no_attack = $Character->fatigue > 0 ? false : true;

		// $combat_log[] = "Made it here with: ". $Character->health. "health";
		if ($flat_npc['health'] > 0 && $Character->health > 0)
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
			// $combat_log[] = "$Npc->name is dead!!!";
			$combat_log['npc_killed'] = true;
			// clean session:
			// $request->session()->pull('combat.'.$Character->id);
			if ($CombatLog)
				{
				$CombatLog->delete();
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


			// $RewardTable = RewardTable::where(['reward_tables.npcs_id' => $request->npc_id])->first();

			// $actual_xp = (float)$RewardTable->award_xp * $RewardTable->xp_variation;
			$xp_variation = rand()/getrandmax()*($Npc->xp_variation*2)-$Npc->xp_variation;

			// $xp_variation = mt_rand() / mt_getrandmax();
			// $combat_log[] = "pre-variation: $xp_variation";
			// $xp_variation = round($xp_variation, 2);
			// $combat_log[] = "variation: $xp_variation";
			$actual_xp = (int)($Npc->award_xp * (1.0 + $xp_variation));

			$gold_variation = rand()/getrandmax()*($Npc->gold_variation*2)-$Npc->gold_variation;

			// $combat_log[] = "pre-variation: $gold_variation";
			// $gold_variation = round($gold_variation, 1);
			// $combat_log[] = "variation: $gold_variation";
			$actual_gold = (int)($Npc->award_gold * (1.0 + $gold_variation));
			// Never less than 1:
			if ($actual_gold == 0)
				{
				$actual_gold = 1;
				}

			// die($actual_xp);
			// $actual_xp = $RewardTable->award_xp;
			// die($actual_xp);

			$Character->xp += $actual_xp;
			$Character->gold += $actual_gold;
			$Character->save();
			// $reward_log[] = '';
			$reward_log[] = "You received $actual_xp xp.";
			// $Wallet = Wallet::where(['wallets.characters_id' => $request->character_id])->first();
			// die(print_r($Wallet));
			$reward_log[] = "You received $actual_gold gold.";
			$reward_log[] = '';

			$LootTables = LootTable::where(['npcs_id' => $request->npc_id])->get();

			// This should be an item id?
			// die(print_r($Character->inventory()));
			// die('..:'.$LootTable->items_id);
			// die(print_r('::'.$LootTables->count()));
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
							// die(print_r($request->session()->get('loot_'.$request->room_id)));
							// ignore 2 entries:
							}
						else
							{
							$request->session()->put('loot.'.$request->room_id, [$LootTable->items_id]);
							}
						// die(print_r($LootTable->items()->first()));
						// $Character->inventory()->addItem($LootTable->items_id);
						}
					}
				}
			// $LootTable;
			}
		else
			{

			}
		// elseif ($Character->health <= 0)
		// 	{
		// 	// $combat_log[] = 'You have died!';
		if ($Character->health <= 0)
			{
			$combat_log['pc_killed'] = true;
			}
		// 	return $this->death($request, );
		// 	}
		// else
			// {
			// nothing?
			// }

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
			$damage = isset($combat_log['attacks']) ? array_sum($combat_log['attacks']) : 0;
			$formatted_log[] = $combat_log['begin'];
			// $formatted_log[] = isset($combat_log['attack_text']) ? $combat_log['attack_text'] : '';
			if ($Character->equipment()->weapon)
				{
				$ItemWeapon = ItemWeapon::where(['items_id' => $Character->equipment()->weapon()->first()->items_id])->first();
				$formatted_log[] = $ItemWeapon->attack_text;
				}
			else
				{
				$formatted_log[] = "Your fists grope the enemy";
				}
			$formatted_log[] = "You made $total_attacks attacks and missed $total_miss times.";
			if ($damage > 0)
				{
				$formatted_log[] = "You did $damage points of damage.";
				}

			if (isset($combat_log['damage_taken']))
				{
				$formatted_log[] = "$Npc->attack_text";
				$formatted_log[] = "$Npc->name hit you ".count($combat_log['damage_taken'])." times for ".array_sum($combat_log['damage_taken'])." damage.";
				}
			else
				{
				if (isset($combat_log['no_damage']) && $combat_log['no_damage'])
					{
					$formatted_log[] = "$Npc->attack_text";
					$formatted_log[] = "$Npc->name couldn't get through your armor!";
					}
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

		$Character = Character::findOrFail($request->character_id);
		$Room = Room::findOrFail($request->room_id);
		// return $this->index($request);

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

		$request_params = ['character' => $Character, 'room' => $Room, 'npc' => null, 'combat_log' => $formatted_log, 'reward_log' => $reward_log, 'ground_items' => $ground_items, 'no_attack' => $no_attack];

		if ($Character->health <= 0)
			{
			$request->combat_log = $request_params['combat_log'];
			return $this->death($request);
			}

		// Refresh the model variable:
		$CombatLog = CombatLog::where(['characters_id' => $Character->id, 'npcs_id' => $request->npc_id, 'rooms_id' => $request->room_id])->first();
		// if  ($request->session()->has('combat.'.$Character->id))
		if ($CombatLog)
			{
			// debug:
			$request_params['combat'] = $CombatLog;
			$request_params['timer'] = true;
			$request_params['npc'] = $Npc;
			}

		if (isset(auth()->user()->admin_level) && auth()->user()->admin_level > 0)
			{
			$request_params['is_admin'] = true;
			}

		if ($request->ajax())
			{
			$view = \View::make('game/main', $request_params);
			$sections = $view->renderSections();
			return $sections;
			}

		return view('game/main', $request_params);
		}
	*/
}
