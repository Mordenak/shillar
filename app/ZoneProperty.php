<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneProperty extends Model
	{
	protected $fillable = ['name', 'description', 'format', 'custom_view'];
	}
