<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
	{
	protected $fillable = ['name', 'travel_text', 'img_src', 'bg_img', 'bg_color', 'font_color', 'label_color', 'description',];

	private $property_list = [];

	public function rooms_q()
		{
		return $this->hasMany('App\Room', 'zones_id');
		}

	public function rooms()
		{
		return $this->hasMany('App\Room', 'zones_id')->get();
		}

	public function properties()
		{
		return $this->hasMany('App\ZoneToZoneProperty', 'zones_id');
		}

	public function darkness_level()
		{
		$is_dark = $this->get_property('DARKNESS');
		if ($is_dark)
			{
			return $is_dark->decode()['level'];
			}
		return 0;
		}

	public function get_property(string $property_name = null)
		{
		$ZoneProperty = ZoneProperty::where(['name' => $property_name])->first();
		if (!$ZoneProperty)
			{
			return false;
			}
		if ($this->properties()->get())
			{
			return $this->properties()->where(['zone_properties_id' => $ZoneProperty->id])->first();
			}
		return false;
		}

	public function has_property(string $property_name )
		{
		if ($this->properties()->get())
			{
			return $this->get_property($property_name) ? true : false;
			}
		return false;
		}

	public function has_restriction()
		{
		if ($this->has_property('STAT_RESTRICTION'))
			{
			return true;
			}
		return false;
		}

	public function get_restrictions()
		{
		// Restrictions are special properties, currently only 1 & 2:
		if ($this->has_property('STAT_RESTRICTION') || $this->has_property('ITEM_RESTRICTION'))
			{
			return $this->properties()->where(['zone_properties_id' => [1,2]])->get();
			}
		return false;
		}

	public function get_stat_restriction()
		{
		if ($this->has_property('STAT_RESTRICTION'))
			{
			// return $this->properties()->where(['zone_properties_id' => 1])->first();
			return $this->get_property('STAT_RESTRICTION');
			}
		return false;
		}

	public function get_item_restriction()
		{
		if ($this->has_property('ITEM_RESTRICTION'))
			{
			// return $this->properties()->where(['zone_properties_id' => 2])->first();
			return $this->get_property('ITEM_RESTRICTION');
			}
		return false;
		}

	}
