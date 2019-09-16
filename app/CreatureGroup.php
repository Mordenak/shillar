<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreatureGroup extends Model
	{
	protected $fillable = ['name', 'description'];

	public function spawn_rules()
		{
		return $this->hasMany('App\SpawnRule', 'creature_groups_id')->get();
		}

	public function creatures()
		{
		return $this->hasMany('App\CreatureToCreatureGroup', 'creature_groups_id');
		}

	public function weight_sum()
		{
		return $this->creatures()->sum('weight');
		}

	public function generate_creature()
		{
		// .25 .30 .30 .15
		// rand() / getrandmax()
		// $probability = rand() / getrandmax();
		$total = $this->weight_sum();
		$spawn_marker = rand(0, $total);
		$n = 0;
		foreach ($this->creatures()->get() as $creature)
			{
			// die(print_r($creature));
			$n += $creature->weight;
			if ($n >= $spawn_marker)
				{
				// die(print_r($creature));
				return $creature->creature();
				}
			}
		// die('no creature');
		// TODO: ??
		return null;
		}
	}
