<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveRandomizer extends Model
	{
	use HasFactory;

	protected $fillable = ['randomizers_id', 'rooms_id', 'creatures_id', 'creature_groups_id', 'expires_on', 'spawn_chance', 'block_other_spawns'];

	public function randomizer()
		{
		return $this->belongsto('App\Randomizer', 'randomizers_id')->first();
		}

	public function room()
		{
		return $this->belongsto('App\Room', 'rooms_id')->first();
		}

	public function creature()
		{
		return $this->belongsto('App\Creature', 'creatures_id')->first();
		}

	public function creature_group()
		{
		return $this->belongsto('App\CreatureGroup', 'creature_groups_id')->first();
		}
	}
