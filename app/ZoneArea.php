<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneArea extends Model
	{
	protected $fillable = ['zones_id', 'uid', 'name', 'travel_text', 'description', 'inherit_creatures', 'inherit_properties', 'bg_img', 'bg_color', 'font_color', 'label_color', 'custom_view'];
	}
