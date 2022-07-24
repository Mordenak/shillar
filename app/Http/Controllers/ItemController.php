<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Item;
use App\ItemType;
use App\ItemFood;
use App\ItemWeapon;
use App\ItemArmor;
use App\ItemJewel;
use App\ItemDust;
use App\ItemAccessories;
use App\ItemOthers;
use App\EquipmentSlot;
use App\WeaponType;
use App\ForgeRecipe;
use App\LootTable;
use App\ShopItem;
use App\ItemProperty;
use App\ItemToItemProperty;

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
		$weapon_types = WeaponType::all();

		$item_type_fields = $this->get_item_fields($Item->item_types_id, $Item->id);

		// Find item references:
		$ResultForges = ForgeRecipe::where('result_items_id', $id)->get();
		$UsedForges = ForgeRecipe::where('item_weapons_id', $id)
			->orWhere('item_armors_id', $id)
			->orWhere('item_jewels_id', $id)
			->orWhere('item_foods_id', $id)
			->orWhere('item_dusts_id', $id)->get();

		$LootTables = LootTable::where('items_id', $id)->get();
		$ShopItems = ShopItem::where('items_id', $id)->get();

		$ItemProperties = ItemProperty::all();
		
		return view('item.edit', ['item' => Item::findOrFail($id), 'item_types' => $item_types, 'item_fields' => $item_type_fields, 'weapon_types' => $weapon_types, 'forged_by' => $ResultForges, 'forged_with' => $UsedForges, 'dropped_by' => $LootTables, 'sold_by' => $ShopItems, 'item_properties' => $Item->properties()->get(), 'properties' => $ItemProperties]);
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

		if ($request->actual_id)
			{
			$ActualItem = $ItemType->model_name::findOrFail($request->actual_id);
			}

		// Baseline values:
		$item_values = [
			'items_id' => $Item->id,
			];

		// Maintain per type field list???

		if ($ItemType->table_name == 'item_weapons')
			{
			$item_values['equipment_slot'] = 1;
			$item_values['weapon_types_id'] = $request->weapon_types_id;
			$item_values['attack_text'] = $request->attack_text;
			$item_values['damage_low'] = $request->damage_low;
			$item_values['damage_high'] = $request->damage_high;
			$item_values['fatigue_use'] = $request->fatigue_use;
			$item_values['accuracy'] = $request->accuracy;
			$item_values['required_stat'] = $request->required_stat;
			$item_values['required_amount'] = $request->required_amount;
			}

		if ($ItemType->table_name == 'item_armors')
			{
			$item_values['equipment_slot'] = $request->equipment_slot;
			$item_values['armor'] = $request->armor;
			// $item_values['strength_bonus'] = $request->strength_bonus;
			// $item_values['dexterity_bonus'] = $request->dexterity_bonus;
			// $item_values['constitution_bonus'] = $request->constitution_bonus;
			// $item_values['wisdom_bonus'] = $request->wisdom_bonus;
			// $item_values['intelligence_bonus'] = $request->intelligence_bonus;
			// $item_values['charisma_bonus'] = $request->charisma_bonus;
			}

		// die(print_r($ItemType->table_name));
		if ($ItemType->table_name == 'item_accessories')
			{
			$item_values['equipment_slot'] = $request->equipment_slot;
			$item_values['light_level'] = $request->light_level;
			$item_values['strength_bonus'] = $request->strength_bonus;
			$item_values['dexterity_bonus'] = $request->dexterity_bonus;
			$item_values['constitution_bonus'] = $request->constitution_bonus;
			$item_values['wisdom_bonus'] = $request->wisdom_bonus;
			$item_values['intelligence_bonus'] = $request->intelligence_bonus;
			$item_values['charisma_bonus'] = $request->charisma_bonus;
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

		foreach ($request->item_properties as $item_property)
			{
			$ItemToItemProperty = new ItemToItemProperty;

			if (isset($item_property['id']))
				{
				$ItemToItemProperty = ItemToItemProperty::findOrFail($item_property['id']);
				if ($item_property['item_properties_id'] == 'null' && !$item_property['data'])
					{
					$ItemToItemProperty->delete();
					continue;
					}
				}

			if ($item_property['item_properties_id'] == 'null')
				{
				continue;
				}

			$values = [
				'items_id' => $Item->id,
				'item_properties_id' => $item_property['item_properties_id'],
				'data' => $item_property['data'],
				];

			$ItemToItemProperty->fill($values);
			$ItemToItemProperty->save();
			}

		// die(print_r($ActualItem));
		// TODO: May save all save calls until end?

		// return view('admin/main');
		Session::flash('success', 'Item Updated!');
		// return $this->edit($Quest->fresh()->id);
		return redirect()->action('ItemController@edit', ['id' => $Item->id]);
		}

	public function get_item_fields($type_id, $item_id = null)
		{
		$partial_name = null;
		$equip_slots = null;
		$weapon_types = null;
		switch ($type_id)
			{
			case 1:
				$partial_name = 'weapons';
				$weapon_types = WeaponType::all();
				break;
			case 2:
				$equip_slots = EquipmentSlot::where('type_restriction', 'armors')->get();
				$partial_name = 'armors';
				break;
			case 3:
				$equip_slots = EquipmentSlot::where('type_restriction', 'accessories')->get();
				$partial_name = 'accessories';
				break;
			case 4:
				$partial_name = 'foods';
				break;
			case 5:
				// Jewels
				$partial_name = null;
				break;
			case 6:
				// Dust
				$partial_name = null;
				break;
			case 7:
				// Others
				$partial_name = null;
				break;
			}
		$item_values = null;
		if ($item_id)
			{
			$Item = Item::findOrFail($item_id);
			$item_values = $Item->actual_item();
			if ($Item->item_types_id == $type_id)
				{
				if ($partial_name)
					{
					return view("partials/$partial_name", ['actual_item' => $item_values, 'equip_slots' => $equip_slots, 'weapon_types' => $weapon_types]);
					}
				}
			}

		if ($partial_name)
			{
			return view("partials/$partial_name", ['equip_slots' => $equip_slots, 'weapon_types' => $weapon_types]);
			}
		else
			{
			return '';
			}
		}

	public function get_item_fields_ajax(Request $request)
		{
		if ($request->item_id)
			{
			return $this->get_item_fields($request->type_id, $request->item_id);
			}
		return $this->get_item_fields($request->type_id);
		}

	public function placeholder(Request $request)
		{
		if ($request->id === 'null')
			{
			// This is our hacky select value workaround:
			return '{}';
			}
		// Given a property ID:
		$ItemProperty = ItemProperty::findOrFail($request->id);
		if ($ItemProperty)
			{
			return $ItemProperty->format;
			}
		return '{}';
		}

	public function lookup(Request $request)
		{
		if ($request->term == 'has:title')
			{
			// $Rooms = Room::whereNotNull('title')->get();
			}
		elseif (preg_match("/type:(.+)/", $request->term, $matches))
			{
			if (is_numeric($matches[1]))
				{
				$Items = Item::where('item_types_id', '=', $matches[1])->get();
				}
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
