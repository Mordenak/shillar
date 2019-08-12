<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemType;
use App\ItemConsumable;
use App\ItemWeapon;
use App\ItemArmor;
use App\ItemAccessories;
use App\ItemOthers;

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

		$item_types = ItemType::all();

		$item_type_fields = null;

		// regretful tree:
		if ($ItemType->name == 'Consumable')
			{
			$ActualItem = ItemConsumable::where(['items_id' => $Item->id])->first();
			$item_type_fields = view('partials/consumables', ['actual_item' => $ActualItem]);
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

		return view('item.edit', ['item' => Item::findOrFail($id), 'actual_item' => $ActualItem, 'item_types' => $item_types, 'item_fields' => $item_type_fields]);
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

	public function get_item_fields(Request $request)
		{
		if ($request->id == 1)
			{
			return view('partials/consumables');
			}

		if ($request->id == 2)
			{
			return view('partials/weapons');
			}
		}
}
