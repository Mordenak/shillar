<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Spell;
use App\SpellProperty;
use App\SpellToSpellProperty;

class SpellController extends Controller
{
	public function create()
		{
		$SpellProperties = SpellProperty::all();
		return view('spell.edit', ['properties' => $SpellProperties]);
		}

	public function all(Request $request)
		{
		$spells = Spell::all();
		return view('spell.all', ['spells' => $spells]);
		}

	public function edit($id)
		{
		$Spell = Spell::findOrFail($id);
		$SpellProperties = SpellProperty::all();
		// return view('spell.edit', ['spell' => $Spell]);
		return view('spell.edit', ['spell' => $Spell, 'spell_properties' => $Spell->properties()->get(), 'properties' => $SpellProperties]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$Spell = Spell::findOrFail($request->id);
		$Spell->delete();
		Session::flash('success', 'Spell Deleted!');
		return redirect()->action('SpellController@all');
		}

	public function save(Request $request)
		{
		$Spell = new Spell;

		if ($request->id)
			{
			$Spell = Spell::findOrFail($request->id);
			}

		// die(print_r($_REQUEST));

		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'display_text' => $request->display_text,
			'rooms_id' => $request->rooms_id,
			'is_combat' => $request->is_combat ? true : false
			];

		$Spell->fill($values);
		$Spell->save();

		foreach ($request->spell_properties as $spell_property)
			{
			$SpellToSpellProperty = new SpellToSpellProperty;

			if (isset($spell_property['id']))
				{
				$SpellToSpellProperty = SpellToSpellProperty::findOrFail($spell_property['id']);
				if ($spell_property['spell_properties_id'] == 'null' && !$spell_property['data'])
					{
					$SpellToSpellProperty->delete();
					continue;
					}
				}

			if ($spell_property['spell_properties_id'] == 'null')
				{
				continue;
				}

			$values = [
				'spells_id' => $Spell->id,
				'spell_properties_id' => $spell_property['spell_properties_id'],
				'target_is_self' => $spell_property['target'] == 'self' ? true : false,
				'data' => $spell_property['data'],
				];

			$SpellToSpellProperty->fill($values);
			$SpellToSpellProperty->save();
			}

		Session::flash('success', 'Spell Updated!');
		return redirect()->action('SpellController@edit', ['id' => $Spell->id]);
		}

	public function placeholder(Request $request)
		{
		if ($request->id === 'null')
			{
			// This is our hacky select value workaround:
			return '{}';
			}
		// Given a property ID:
		$SpellProperty = SpellProperty::findOrFail($request->id);
		if ($SpellProperty)
			{
			return $SpellProperty->format;
			}
		return '{}';
		}

	public function lookup(Request $request)
		{
		$Spells = Spell::where('name', 'ilike', "%$request->term%")->get();	

		$arr = [];

		if ($Spells)
			{
			foreach ($Spells as $Spell)
				{
				$label = "($Spell->id) ".$Spell->name;
				$arr[] = [
					'label' => $label,
					'value' => $Spell->id,
					];
				}
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$Spells = Spell::where('id', '=', $request->term)->get();

			if ($Spells)
				{
				foreach ($Spells as $Spell)
					{
					$label = "($Spell->id) ".$Spell->name;
					$arr[] = [
						'label' => $label,
						'value' => $Spell->id,
						];
					}
				}
			}

		if (empty($arr))
			{
			$arr[] = ['label' => 'No Results', 'value' => $request->term];
			}

		echo (json_encode($arr));;
		header('Content-type: application/json');
		}
}
