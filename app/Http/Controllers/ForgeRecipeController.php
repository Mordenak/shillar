<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\ForgeRecipe;

class ForgeRecipeController extends Controller
{
	public function create()
		{
		// $forges = ForgeRecipe::all();
		return view('forge.edit');
		}

	public function all(Request $request)
		{
		$forges = ForgeRecipe::all();
		return view('forge.all', ['forges' => $forges]);
		}

	public function edit($id)
		{
		$ForgeRecipe = ForgeRecipe::findOrFail($id);
		return view('forge.edit', ['forge' => $ForgeRecipe]);
		}

	public function delete(Request $request)
		{
		$ForgeRecipe = ForgeRecipe::findOrFail($request->id);
		$ForgeRecipe->delete();
		Session::flash('success', 'Forge Recipe Deleted!');
		return redirect()->action('ForgeRecipeController@all');
		}

	public function save(Request $request)
		{
		$ForgeRecipe = new ForgeRecipe;

		if ($request->id)
			{
			$ForgeRecipe = ForgeRecipe::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'result_items_id' => $request->result_items_id,
			'item_weapons_id' => $request->item_weapons_id,
			'item_armors_id' => $request->item_armors_id,
			'item_foods_id' => $request->item_foods_id,
			'item_jewels_id' => $request->item_jewels_id,
			'item_dusts_id' => $request->item_dusts_id,
			];

		$ForgeRecipe->fill($values);
		$ForgeRecipe->save();

		Session::flash('success', 'Forge Recipe Updated!');
		return $this->edit($ForgeRecipe->fresh()->id);
		}
}
