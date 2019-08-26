<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraderItem extends Model
{
	protected $fillable = ['traders_id', 'characters_id', 'items_id', 'from_characters_id'];

	public function trader()
		{
		return $this->belongsTo('App\Trader', 'traders_id')->first();
		}

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function from_character()
		{
		return $this->belongsTo('App\Character', 'from_characters_id')->first();
		}

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}
}