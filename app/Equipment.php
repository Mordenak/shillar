<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    protected $fillable = ['characters_id', 'head', 'chest', 'legs', 'weapon'];

    public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function calculate_armor()
		{
		$total_armor = 3;

		if ($this->head)
			{
			$ItemArmor = ItemArmor::findOrFail($this->head);
			$total_armor += $ItemArmor->armor;
			}

		if ($this->chest)
			{
			$ItemArmor = ItemArmor::findOrFail($this->chest);
			$total_armor += $ItemArmor->armor;
			}

		if ($this->legs)
			{
			$ItemArmor = ItemArmor::findOrFail($this->legs);
			$total_armor += $ItemArmor->armor;
			}

		return $total_armor;
		}
}
