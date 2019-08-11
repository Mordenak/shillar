<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
	public function create()
		{
		return view('item.create');
		}

	public function all(Request $request)
		{
		$items = Item::all();
		return view('item.all', ['items' => $items]);
		}

	public function edit($id)
		{
		// $zones = Zone::all();
		return view('item.edit', ['item' => Item::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		$Item = new Item;

		if ($request->id)
			{
			$Item = Item::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name
			];

		$Item->fill($values);
		$Item->save();

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
