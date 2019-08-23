<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemType;
use App\ItemFood;
use App\ItemWeapon;
use App\ItemArmor;
use App\ItemAccessories;
use App\ItemOthers;
use App\EquipmentSlot;

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
			'value' => $request->value,
			'weight' => $request->weight,
			];

		$Item->fill($values);
		$Item->save();

		// values saved depend on type... if we change type, we have to drop old type data:
		// If we reference Item->item_types_id here we would have to refactor if we move save calls:
		$ItemType = ItemType::findOrFail($request->item_types_id);
		// $ItemType->table_name
		$ActualItem = new $ItemType->model_name;

		// Baseline values:
		$item_values = [
			'items_id' => $Item->id,
			'name' => $Item->name
			];

		// Maintain per type field list???

		if ($ItemType->table_name == 'item_weapons')
			{
			$item_values['equipment_slot'] = 1;
			$item_values['attack_text'] = $request->attack_text;
			$item_values['damage_low'] = $request->damage_low;
			$item_values['damage_high'] = $request->damage_high;
			}

		if ($ItemType->table_name == 'item_armors')
			{
			$item_values['equipment_slot'] = $request->equipment_slot;
			$item_values['armor'] = $request->armor;
			}

		if ($ItemType->table_name == 'item_accessories')
			{
			$item_values['equipment_slot'] = $request->equipment_slot;
			}

		if ($ItemType->table_name == 'item_foods')
			{
			$item_values['potency'] = $request->potency;
			}

		if ($ItemType->table_name == 'item_jewels')
			{
			// ??
			}

		if ($ItemType->table_name == 'item_dusts')
			{
			// ??
			}

		if ($ItemType->table_name == 'item_others')
			{
			// ??
			}

		$ActualItem->fill($item_values);
		$ActualItem->save();


		// TODO: May save all save calls until end?

		// return view('admin/main');
		return redirect()->action('ItemController@all');
		}

	public function get_item_fields($type_id, $item_id = null)
		{
		$partial_name = null;
		$equip_slots = null;
		switch ($type_id)
			{
			case 1:
				$partial_name = 'weapons';
				break;
			case 2:
				$equip_slots = EquipmentSlot::all();
				$partial_name = 'armors';
				break;
			case 3:
				$equip_slots = EquipmentSlot::all();
				$partial_name = 'accessories';
				break;
			case 4:
				$partial_name = 'foods';
				break;
			case 5:
				$partial_name = 'jewels';
				break;
			case 6:
				$partial_name = 'dusts';
				break;
			case 7:
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
				return view("partials/$partial_name", ['actual_item' => $item_values, 'equip_slots' => $equip_slots]);
				}
			}

		return view("partials/$partial_name", ['equip_slots' => $equip_slots]);
		}

	public function get_item_fields_ajax(Request $request)
		{
		if ($request->item_id)
			{
			return $this->get_item_fields($request->type_id, $request->item_id);
			}
		return $this->get_item_fields($request->type_id);
		}

	public function lookup(Request $request)
		{
		if ($request->term == 'has:title')
			{
			// $Rooms = Room::whereNotNull('title')->get();
			}
		elseif (preg_match("/type:(.+)/", $request->term, $matches))
			{
			// if (is_numeric($matches[1]))
			// 	{
			// 	$Zone = Zone::findOrFail($matches[1]);
			// 	}
			// else
			// 	{
			// 	$Zone = Zone::where('name', 'ilike', "%$matches[1]%")->first();
			// 	if ($Zone->count === 0)
			// 		{
			// 		return [];
			// 		}

			// 	}
			// $Rooms = $Zone->rooms();
			}
		else
			{
			$Items = Item::where('name', 'ilike', "%$request->term%")->get();
			}

		$arr = [];

		if ($Items)
			{
			foreach ($Items as $Item)
				{
				$label = "($Item->id) $Item->name [".$Item->type()->name."]";
				$arr[] = [
					'label' => $label,
					'value' => $Item->id,
					];
				}
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$Items = Item::where('id', '=', $request->term)->get();

			if ($Items)
				{
				foreach ($Items as $Item)
					{
					$label = "($Item->id) $Item->name [".$Item->type()->name."]";
					$arr[] = [
						'label' => $label,
						'value' => $Item->id,
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
