<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['name', 'player_races_id', 'last_rooms_id'];

	public function playerrace()
		{
		return $this->belongsTo('App\PlayerRace', 'player_races_id');
		}

	public function stats()
		{
		return $this->hasOne('App\CharacterStats', 'characters_id')->first();
		}

	public function inventory()
		{
		return $this->hasOne('App\Inventory', 'characters_id')->first();
		}

	public function equipment()
		{
		return $this->hasOne('App\Equipment', 'characters_id')->first();
		}
}
