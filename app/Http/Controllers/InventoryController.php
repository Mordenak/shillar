<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inventory;
use App\InventoryItem;
use App\Equipment;
use Session;

class InventoryController extends Controller
{
	public function show($id)
		{
		return view('inventory.profile', ['inventory' => Inventory::findOrFail($id)]);
		}

	public function create()
		{
		return view('inventory.create', ['races' => Race::orderby('name')->get(), 'genders' => Gender::all()]);
		}

	public function all()
		{
		// admin command:
		$Inventorys = Inventory::all();

		return view('inventory.all', ['inventorys' => $Inventorys]);
		}

	public function edit($id)
		{
		return view('inventory.edit', ['inventory' => Inventory::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		// die(print_r($request->inventory_items));
		if ($request->id)
			{
			$Inventory = Inventory::findOrFail($request->id);
			// $Inventory->save();

			foreach ($request->inventory_items as $inventory_item)
				{
				$InventoryItem = new InventoryItem;

				if (isset($inventory_item['id']))
					{
					$InventoryItem = InventoryItem::findOrFail($inventory_item['id']);
					if ((!$inventory_item['items_id'] && !$inventory_item['quantity']) || $inventory_item['quantity'] == 0)
						{
						$InventoryItem->delete();
						continue;
						}
					}

				if (!$inventory_item['items_id'])
					{
					continue;
					}

				$values = [
					'inventory_id' => $Inventory->id,
					'items_id' => $inventory_item['items_id'],
					'quantity' => $inventory_item['quantity'],
					];

				$InventoryItem->fill($values);
				$InventoryItem->save();
				}

			$Inventory->cache_items();

			Session::flash('success', 'Inventory Updated!');
			return $this->edit($Inventory->id);
			}
		}
}
