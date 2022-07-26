<?php

namespace App\Http\Controllers;

use App\Item;
use App\InventoryItem;
use App\ItemProperty;
use App\InventoryItemToItemProperty;
use Session;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
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
		$InventoryItem = InventoryItem::findOrFail($id);

		$ItemProperties = ItemProperty::all();
		
		return view('inventory_item.edit', ['inventory_item' => InventoryItem::findOrFail($id), 'inventory_item_properties' => $InventoryItem->properties()->get(), 'properties' => $ItemProperties]);
		}

	public function save(Request $request)
		{
		$InventoryItem = new InventoryItem;

		if ($request->id)
			{
			$InventoryItem = InventoryItem::findOrFail($request->id);
			}

		$values = [
			'inventory_id' => $request->inventory_id,
			'items_id' => $request->items_id,
			'quantity' => $request->quantity
			];

		$InventoryItem->fill($values);
		$InventoryItem->save();

		foreach ($request->item_properties as $item_property)
			{
			$InventoryItemToItemProperty = new InventoryItemToItemProperty;

			if (isset($item_property['id']))
				{
				$InventoryItemToItemProperty = InventoryItemToItemProperty::findOrFail($item_property['id']);
				if ($item_property['item_properties_id'] == 'null' && !$item_property['data'])
					{
					$InventoryItemToItemProperty->delete();
					continue;
					}
				}

			if ($item_property['item_properties_id'] == 'null')
				{
				continue;
				}

			$values = [
				'inventory_items_id' => $InventoryItem->id,
				'item_properties_id' => $item_property['item_properties_id'],
				'data' => $item_property['data'],
				];

			$InventoryItemToItemProperty->fill($values);
			$InventoryItemToItemProperty->save();
			}

		// die(print_r($ActualItem));
		// TODO: May save all save calls until end?

		// return view('admin/main');
		Session::flash('success', 'Inventory Item Updated!');
		// return $this->edit($Quest->fresh()->id);
		return redirect()->action('InventoryItemController@edit', ['id' => $InventoryItem->id]);
		}
}
