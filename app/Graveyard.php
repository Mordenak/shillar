<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graveyard extends Model
	{
	protected $table = 'graveyard';
	
	protected $fillable = ['characters_id', 'creatures_id', 'zones_id'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}
	}
