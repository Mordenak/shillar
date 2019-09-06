<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneToZoneProperty extends Model
	{
	// protected $table = 'zone_properties';

	protected $fillable = ['zone_properties_id', 'zones_id', 'data'];

	public function zone()
		{
		return $this->belongsTo('App\Zone');
		}

	public function property()
		{
		return $this->belongsTo('App\ZoneProperty', 'zone_properties_id');
		}

	public function get_data()
		{
		// Somehow return data properly for everything?
		// Should there be a common method for this?
		}

	public function show_data()
		{
		return true;
		}

	public function decode()
		{
		return json_decode($this->data, true);
		}
	}
