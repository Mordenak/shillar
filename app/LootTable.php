<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootTable extends Model
{
	protected $fillable = ['zones_id', 'creatures_id', 'items_id', 'chance'];

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}

	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}
}
