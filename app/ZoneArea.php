<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneArea extends Model
	{
	protected $fillable = ['zones_id', 'uid', 'name', 'travel_text', 'description', 'inherit_creatures', 'inherit_properties', 'bg_img', 'bg_color', 'font_color', 'label_color', 'custom_view'];

	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function rooms_q()
		{
		return $this->hasMany('App\Room', 'zone_areas_id');
		}

	public function rooms()
		{
		return $this->hasMany('App\Room', 'zone_areas_id')->get();
		}

	public function get_random_room()
		{
		return $this->rooms_q()->inRandomOrder()->first();
		}
	}
