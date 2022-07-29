<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\World;

class Randomizer extends Model
	{
	use HasFactory;

	protected $fillable = ['uid', 'rooms_id', 'zones_id', 'zone_areas_id', 'creatures_id', 'creature_groups_id', 'rotation_hours', 'spawn_chance', 'block_other_spawns'];

	public function room()
		{
		return $this->belongsto('App\Room', 'rooms_id')->first();
		}

	public function zone()
		{
		return $this->belongsto('App\Zone', 'zones_id')->first();
		}

	public function zone_area()
		{
		return $this->belongsto('App\ZoneArea', 'zone_areas_id')->first();
		}

	public function creature()
		{
		return $this->belongsto('App\Creature', 'creatures_id')->first();
		}

	public function creature_group()
		{
		return $this->belongsto('App\CreatureGroup', 'creature_groups_id')->first();
		}

	public function active_randomizer()
		{
		return $this->hasOne('App\ActiveRandomizer', 'randomizers_id')->first();
		}

	public function create_active()
		{
		$ActiveRandomizer = new ActiveRandomizer;
		// Room is a specific room to place the active on:
		// Zone means choose a random room within the zone:
		// Zone Area means choose a random room within the zone area:
		// Creature is the specific creature to spawn:
		// Creature group is the group of creatures to add to the spawn rules

		$values = [
			'randomizers_id' => $this->id,
			'spawn_chance' => $this->spawn_chance,
			'block_other_spawns' => $this->block_other_spawns
			];

		if ($this->room())
			{
			$values['rooms_id'] = $this->room();
			}
		elseif ($this->zone())
			{
			$values['rooms_id'] = $this->zone()->get_random_room()->id;
			}
		elseif ($this->zone_area())
			{
			$values['rooms_id'] = $this->zone_area()->get_random_room()->id;
			}

		if ($this->creature())
			{
			$values['creatures_id'] = $this->creatures_id;
			}

		if ($this->creature_group())
			{
			$values['creature_groups_id'] = $this->creature_groups_id;
			}

		$values['expires_on'] = World::getDateWithOffset($this->rotation_hours)->format('H');

		// Determine proper time:

		$ActiveRandomizer->fill($values);
		$ActiveRandomizer->save();

		return $ActiveRandomizer;
		}

	}
