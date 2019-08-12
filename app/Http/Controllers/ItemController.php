<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemType;

class ItemController extends Controller
{
	public function create()
		{
		$item_types = ItemType::all();
		return view('item.create', ['item_types' => $item_types]);
		}

	public function all(Request $request)
		{
		$items = Item::all();
		return view('item.all', ['items' => $items]);
		}

	public function edit($id)
		{
		$Item = Item::findOrFail($id);

		$ItemType = ItemType::findOrFail($Item->item_types_id);

		// regretful tree:
		if ($ItemType->name == 'Consumable')
			{
			$ActualItem = ItemConsumable::where(['items_id' => $Item->id])->first();
			}

		if ($ItemType->name == 'Weapon')
			{
			$ActualItem = ItemWeapon::where(['items_id' => $Item->id])->first();
			}

		if ($ItemType->name == 'Armor')
			{
			$ActualItem = ItemArmor::where(['items_id' => $Item->id])->first();
			}

		if ($ItemType->name == 'Accessories')
			{
			$ActualItem = ItemAccessories::where(['items_id' => $Item->id])->first();
			}

		if ($ItemType->name == 'Other')
			{
			$ActualItem = ItemOthers::where(['items_id' => $Item->id])->first();
			}

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
			'name' => $request->name,
			'item_types_id' => $request->item_types_id,
			];

		$Item->fill($values);
		$Item->save();

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
