<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
    public function stats()
    	{
    	return $this->hasOne('App\NpcStat', 'npcs_id');
    	}
}
