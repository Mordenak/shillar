<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Spell;
use App\SpellProperty;
use App\SpellToSpellProperty;

class SpellPropertyController extends Controller
	{
	public function create()
		{
		$SpellProperties = SpellProperty::all();
		return view('spell_property.edit');
		}

	public function all(Request $request)
		{
		$SpellProperties = SpellProperty::all();
		return view('spell_property.all', ['spell_properties' => $SpellProperties]);
		}

	public function edit($id)
		{
		$SpellProperty = SpellProperty::findOrFail($id);
		// return view('spell.edit', ['spell' => $Spell]);
		return view('spell_property.edit', ['spell_property' => $SpellProperty]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$SpellProperty = SpellProperty::findOrFail($request->id);
		$SpellProperty->delete();
		Session::flash('success', 'SpellProperty Deleted!');
		return redirect()->action('SpellPropertyController@all');
		}

	public function save(Request $request)
		{
		$SpellProperty = new SpellProperty;

		if ($request->id)
			{
			$SpellProperty = SpellProperty::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'format' => $request->format,
			'custom_view' => $request->custom_view
			];

		$SpellProperty->fill($values);
		$SpellProperty->save();

		Session::flash('success', 'SpellProperty Updated!');
		return redirect()->action('SpellPropertyController@edit', ['id' => $SpellProperty->id]);
		}
	}
