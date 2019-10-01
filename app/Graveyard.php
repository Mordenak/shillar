<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graveyard extends Model
	{
	protected $table = 'graveyard';
	
	protected $fillable = ['characters_id', 'creatures_id', 'zones_id'];
	}
