<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterSpell extends Model
	{
	protected $fillable = ['spells_id', 'characters_id', 'level'];

	public $operators = ['+', '-', '*', '/'];

	public function __construct()
		{
		
		}

	public function spell()
		{
		return $this->belongsTo('App\Spell', 'spells_id')->first();
		}

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function process($index = null)
		{
		$return_data = [];

		// $operators = ['+', '-', '*', '/'];

		// $db_map = [
		// 	'spell.level' => $this->spell()->level,
		// 	'character.strength' => $this->character()->strength(),
		// 	'character.dexterity' => $this->character()->dexterity(),
		// 	'character.constitution' => $this->character()->constitution(),
		// 	'character.wisdom' => $this->character()->wisdom(),
		// 	'character.intelligence' => $this->character()->intelligence(),
		// 	'character.charisma' => $this->character()->charisma(),
		// 	];
		// $spell_damage = $Spell->get_property('DAMAGE_HEALTH')->decode();
		if ($this->spell()->has_property('DAMAGE_HEALTH'))
			{
			// die('yes');
			$data = $this->spell()->get_property('DAMAGE_HEALTH')->decode();

			if (preg_match_all('/\S*/', $data['formula'], $new_matches))
				{
				$return = $this->calculate($new_matches[0]);

				if (isset($data['variance']))
					{
					$return = rand(($return * (1.0 - $data['variance'])), ($return * (1.0 + $data['variance'])));
					}
				else
					{
					$return = rand(($return * (1.0 - 0.1)), ($return * (1.0 + 0.1)));	
					}

				$return_data['DAMAGE_HEALTH'] = $return;
				}

			}

		if ($this->spell()->has_property('RESTORE_HEALTH'))
			{
			$data = $this->spell()->get_property('RESTORE_HEALTH')->decode();

			// ([a-zA-Z.0-9+-\/*{}]*)
			if (preg_match_all('/\S*/', $data['formula'], $new_matches))
				{
				$return = $this->calculate($new_matches[0]);

				if (isset($data['variance']))
					{
					$return = rand(($return * (1.0 - $data['variance'])), ($return * (1.0 + $data['variance'])));
					}
				else
					{
					$return = rand(($return * (1.0 - 0.1)), ($return * (1.0 + 0.1)));	
					}

				$return_data['RESTORE_HEALTH'] = $return;
				}

			}

		if ($this->spell()->has_property('RESTORE_FATIGUE'))
			{
			$data = $this->spell()->get_property('RESTORE_FATIGUE')->decode();

			if (preg_match_all('/\S*/', $data['formula'], $new_matches))
				{
				$return = $this->calculate($new_matches[0]);

				if (isset($data['variance']))
					{
					$return = rand(($return * (1.0 - $data['variance'])), ($return * (1.0 + $data['variance'])));
					}
				else
					{
					$return = rand(($return * (1.0 - 0.1)), ($return * (1.0 + 0.1)));	
					}

				$return_data['RESTORE_FATIGUE'] = $return;
				}

			}

		if ($this->spell()->has_property('CONSUME_ITEM'))
			{
			$data = $this->spell()->get_property('CONSUME_ITEM')->decode();

			$return_data['CONSUME_ITEM'] = $data['item_id'];
			}

		if ($this->spell()->has_property('CHANGE_ROOM'))
			{
			$data = $this->spell()->get_property('CHANGE_ROOM')->decode();

			$return_data['CHANGE_ROOM'] = $data;
			}

		if ($this->spell()->has_property('APPLY_BUFF'))
			{
			$data = $this->spell()->get_property('APPLY_BUFF')->decode();

			if (preg_match_all('/\S*/', $data['formula'], $new_matches))
				{
				// die(print_r($new_matches));
				$data['result'] = $this->evaluate($data['formula']);
				// $data['result'] = $this->calculate($new_matches[0]);
				// die(print_r($data['result']));
				// die(print_r($new_matches[0]));
				}

			$return_data['APPLY_BUFF'] = $data;
			}

		if ($index)
			{
			return $return_data[$index];
			}
		return $return_data;
		}

	public function evaluate($formula)
		{
		$db_map = [
			'{spell.level}' => $this->level,
			'{character.strength}' => $this->character()->strength(),
			'{character.dexterity}' => $this->character()->dexterity(),
			'{character.constitution}' => $this->character()->constitution(),
			'{character.wisdom}' => $this->character()->wisdom(),
			'{character.intelligence}' => $this->character()->intelligence(),
			'{character.charisma}' => $this->character()->charisma(),
			'{character.max_health}' => $this->character()->max_health
			];

		$new_string = $formula;
		foreach ($db_map as $key => $value)
			{
			$new_string = str_replace($key, $value, $new_string);
			}

		// TODO: RED ALERT
		eval('$o = ' . preg_replace('/[^0-9\+\-\*\/\(\)\.]/', '', $new_string) . ';');

		return $o;
		// die(print_r(floor($o * 100)));
		}

	public function calculate($matches)
		{
		/**
		 * On calculate and the regex matching... We need to be able to handle parenthesis
		 * and proper order of operations to support complex evaluations.  The current code
		 * here will only handle easy operations that do not depend on order of operations.
		 * This will not work for spells like Bedazzle that require complex evaluations.
		 */
		$db_map = [
			'{spell.level}' => $this->level,
			'{character.strength}' => $this->character()->strength(),
			'{character.dexterity}' => $this->character()->dexterity(),
			'{character.constitution}' => $this->character()->constitution(),
			'{character.wisdom}' => $this->character()->wisdom(),
			'{character.intelligence}' => $this->character()->intelligence(),
			'{character.charisma}' => $this->character()->charisma(),
			'{character.max_health}' => $this->character()->max_health
			];

		$base = 0.0;
		$last_operator = null;
		// $log = [];
		// eval('$o = ' . preg_replace('/[^0-9\+\-\*\/\(\)\.]/', '', $expression) . ';');
		foreach ($matches as $idx => $match)
			{
			// $log[] = $base;
			if ($idx == 0)
				{
				// die(print_r($matches));
				$base = $db_map[$match];
				// die(print_r($db_map));
				// die(print_r($base));
				continue;
				}

			if ($match == '' || $match == null)
				{
				continue;
				}

			if (in_array($match, $this->operators))
				{
				$last_operator = $match;
				continue;
				}

			$next_value = null;
			if (isset($db_map[$match]))
				{
				$next_value = $db_map[$match];
				}
			else
				{
				$next_value = (float)$match;
				}

			if ($last_operator == '+')
				{
				$base = $base + $next_value;
				}
			elseif ($last_operator == '-')
				{
				$base = $base - $next_value;
				}
			elseif ($last_operator == '*')
				{
				$base = $base * $next_value;
				}
			elseif ($last_operator == '/')
				{
				$base = $base / $next_value;
				}
			}
		// die(print_r($log));
		return $base;
		}
	}
