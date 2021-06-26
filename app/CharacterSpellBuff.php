<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterSpellBuff extends Model
	{
	protected $fillable = ['character_spells_id', 'characters_id', 'expires_on', 'buff', 'buff_type'];

	public static function clean_buffs()
		{
		$CharacterSpellBuffs = CharacterSpellBuff::where('expires_on', '<', time())->get();

		foreach ($CharacterSpellBuffs as $CharacterSpellBuff)
			{
			$CharacterSpellBuff->delete();
			}

		return true;
		}

	public function decode()
		{
		return json_decode($this->buff, true);
		}
	}
