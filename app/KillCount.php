<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KillCount extends Model
{
	protected $fillable = ['characters_id', 'npcs_id', 'count'];
}
