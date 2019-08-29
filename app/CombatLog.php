<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CombatLog extends Model
{
	protected $fillable = ['characters_id', 'creatures_id', 'rooms_id', 'remaining_health', 'expires_on'];
}
