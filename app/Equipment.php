<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Equipment extends Model
{
	protected $fillable = ['characters_id', 'head', 'chest', 'legs', 'weapon', 'hands', 'feet', 'neck', 'left_ring', 'right_ring', 'amulet', 'bracelet'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function weapon()
		{
		// Weapon = InventoryItem record, items_id.
		return $this->hasOne('App\InventoryItem', 'id', 'weapon')->first()->item()->actual_item();
		}

	public function remove_all()
		{
		$this->weapon = null;
		$this->shield = null;
		$this->head = null;
		$this->neck = null;
		$this->chest = null;
		$this->legs = null;
		$this->hands = null;
		$this->feet = null;
		$this->amulet = null;
		$this->left_ring = null;
		$this->right_ring = null;
		$this->bracelet = null;

		$this->save();

		$this->refresh_equip();

		return true;
		}

	public function get_all()
		{
		if (!Cache::get($this->characters_id . '_equipment'))
			{
			$this->refresh_equip();
			}
		return Cache::get($this->characters_id . '_equipment');
		}

	public function refresh_equip()
		{
		$arr = [
			$this->weapon,
			$this->shield,
			$this->head,
			$this->neck,
			$this->chest,
			$this->legs,
			$this->hands,
			$this->feet,
			$this->amulet,
			$this->left_ring,
			$this->right_ring,
			$this->bracelet
			];
		Cache::put($this->characters_id . '_equipment', $arr);
		
		return $arr;
		}

	public function retrieve_stats()
		{
		if (!Cache::get($this->characters_id . '_stats'))
			{
			$this->calculate_stats();
			}
		return Cache::get($this->characters_id . '_stats');
		}

	// TODO: Performance pass!
	public function calculate_stats()
		{
		$bonus_stats = [
			'light_level' => 0,
			'strength' => 0,
			'dexterity' => 0,
			'constitution' => 0,
			'wisdom' => 0,
			'intelligence' => 0,
			'charisma' => 0,
			'armor' => 0
			];

		$slots = ['shield', 'head', 'neck', 'chest', 'hands', 'legs', 'feet', 'amulet', 'left_ring', 'right_ring', 'bracelet'];

		foreach ($slots as $slot)
			{
			if ($this[$slot])
				{
				// die(print_r($this[$slot]));
				$InventoryItem = InventoryItem::findOrFail($this[$slot]);
				// die(print_r($InventoryItem->item()->get_bonus_stats()));
				$bonus = $InventoryItem->item()->get_bonus_stats();
				if ($bonus)
					{
					// die(print_r($bonus));
					foreach ($bonus as $stat => $value)
						{
						$bonus_stats[$stat] = $bonus_stats[$stat] + $value;
						}
					}

				// Then check the InventoryItem:
				if ($InventoryItem->has_property('STAT_BONUS'))
					{
					$extra_bonus = $InventoryItem->get_property('STAT_BONUS')->decode();

					foreach ($extra_bonus as $stat => $value)
						{
						$bonus_stats[$stat] = $bonus_stats[$stat] + $value;
						}
					}
				}
			}

		// TODO: This creates a recursive loop.  Figure out a better way to keep these values in sync.
		// Re-calc max weight?
		// $this->character()->first()->get_max_weight();

		// die(print_r($bonus_stats));
		Cache::put($this->characters_id . '_stats', $bonus_stats);

		return $bonus_stats;
		}
}
