<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootTable extends Model
{
	protected $fillable = ['zones_id', 'npcs_id', 'items_id', 'chance'];

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}

	public function npc()
		{
		return $this->belongsTo('App\Npc', 'npcs_id')->first();
		}

	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}
}
