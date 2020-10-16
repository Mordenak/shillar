<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroundItem extends Model
	{
	protected $fillable = ['rooms_id', 'characters_id', 'items_id', 'expires_on', 'quantity'];

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}
	}
