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
		return view('item.edit', ['item_types' => $item_types]);
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

		$item_type_fields = $this->get_item_fields($Item->item_types_id, $Item->id);
		
		return view('item.edit', ['item' => Item::findOrFail($id), 'item_types' => $item_types, 'item_fields' => $item_type_fields]);
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

		// values saved depend on type... if we change type, we have to drop old type data:
		// If we reference Item->item_types_id here we would have to refactor if we move save calls:
		$ItemType = ItemType::findOrFail($request->item_types_id);
		// $ItemType->table_name



		// TODO: May save all save calls until end?

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}

	public function get_item_fields($type_id, $item_id = null)
		{
		$partial_name = null;
		switch ($type_id)
			{
			case 1:
				$partial_name = 'consumables';
				break;
			case 2:
				$partial_name = 'weapons';
				break;
			case 3:
				$partial_name = 'armors';
				break;
			case 4:
				$partial_name = 'accessors';
				break;
			case 5:
				$partial_name = 'others';
				break;
			}
		$item_values = null;
		if ($item_id)
			{
			$Item = Item::findOrFail($item_id);
			$item_values = $Item->actual_item();
			if ($Item->item_types_id == $type_id)
				{
				return view("partials/$partial_name", ['actual_item' => $item_values]);
				}
			}

		return view("partials/$partial_name");
		}

	public function get_item_fields_ajax(Request $request)
		{
		if ($request->item_id)
			{
			return $this->get_item_fields($request->type_id, $request->item_id);
			}
		return $this->get_item_fields($request->type_id);
		}

	// TODO: Have controller maintain this list for now?
	public function slot_list()
		{
		$slots = [
			'weapon',
			'head',
			'chest',
			'legs',
			];
		return $slots;
		}
}
