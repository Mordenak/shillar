<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class World extends Model
{
	protected $table = 'world';

	// Use this function to retrieve dates to provide a method to offset times when needed
	public static function getDateWithOffset($additional_offset = 0)
		{
		$current_offset = 0; // pull this from database value

		$current_offset += $additional_offset;

		$date = new \DateTime();

		$dateinterval = new \DateInterval('PT'.abs($current_offset).'H');

		if ($current_offset < 0)
			{
			$dateinterval->invert = 1;
			}

		return $date->add($dateinterval);
		}

	public static function getDateStringWithOffset()
		{
		return self::getDateWithOffset()->format('Y-m-d H:i:s');
		}

	public static function tick()
		{
		$World = World::all()->first();
		// $last_update = Carbon::createFromTimestamp($World->updated_at);
		// $current = Carbon::now();
		$mins = $World->updated_at->diffInMinutes(Carbon::now('UTC'));
		$new_cycles = floor($mins / 10);

		if ($World->cycle + $new_cycles > 200)
			{
			$new_years = floor(($World->cycle + $new_cycles) / 200);

			$World->cycle = ($World->cycle + $new_cycles) - ($new_years * 200);
			$World->year += $new_years;
			}

		// $World->cycle += $add_cycle;
		$World->save();
		return true;
		}

	public static function year()
		{
		$World = World::all()->first();
		return $World->year;
		}

	public static function cycle()
		{
		$World = World::all()->first();
		$string = $World->cycle;

		// dress up the string:
		if (substr($string, - 1) == '1')
			{
			$string .= 'st';
			}
		else if (substr($string, - 1) == '2')
			{
			$string .= 'nd';
			}
		else if (substr($string, - 1) == '3')
			{
			$string .= 'rd';
			}
		else
			{
			$string .= 'th';
			}

		return $string;
		}
}
