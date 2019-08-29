<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Shop;
use App\ShopItem;
use App\Room;
use App\Item;

class ShopController extends Controller
{
	public function all(Request $request)
		{
		$shops = Shop::all();
		return view('shop.all', ['shops' => $shops]);
		}

	public function create()
		{
		$rooms = Room::all();
		$items = Item::all();
		return view('shop.edit', ['items' => $items, 'rooms' => $rooms]);
		}

	public function edit($id)
		{
		// $zones = Zone::all();
		// $Creature = Creature::findOrFail($id);
		// Remove?
		$rooms = Room::all();
		$items = Item::all();

		// $SpawnRules = SpawnRule::where(['creatures_id' => $Creature->id])->get();
		// $LootTables = LootTable::where(['creatures_id' => $Creature->id])->get();

		// return view('creature.edit', ['creature' => $Creature, 'spawn_rules' => $SpawnRules, 'loot_tables' => $LootTables, 'zones' => $zones, 'items' => $items]);
		return view('shop.edit', ['shop' => Shop::findOrFail($id), 'items' => $items, 'rooms' => $rooms]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$Shop = Shop::findOrFail($request->id);

		if ($Shop->shop_items())
			{
			foreach ($Shop->shop_items() as $shop_item)
				{
				$shop_item->delete();
				}
			}

		$Shop->delete();
		Session::flash('success', 'Shop Deleted!');
		// return $this->all($request);
		return redirect()->action('ShopController@all');
		}

	public function save(Request $request)
		{
		$Shop = new Shop;

		if ($request->id)
			{
			$Shop = Shop::findOrFail($request->id);
			}
		
		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'rooms_id' => $request->rooms_id,
			'buys_weapons' => $request->buys_weapons ? true : false,
			'buys_armors' => $request->buys_armors ? true : false,
			'buys_accessories' => $request->buys_accessories ? true : false,
			'buys_foods' => $request->buys_foods ? true : false,
			'buys_jewels' => $request->buys_others ? true : false,
			'buys_dusts' => $request->buys_others ? true : false,
			'buys_others' => $request->buys_others ? true : false,
			];

		$Shop->fill($values);
		$Shop->save();

		foreach ($request->shop_items as $shop_item)
			{
			$ShopItem = new ShopItem;

			if (isset($shop_item['id']))
				{
				$ShopItem = ShopItem::findOrFail($shop_item['id']);

				if (!$shop_item['item_id'] && !$shop_item['price'] && !$shop_item['markup'])
					{
					$ShopItem->delete();
					continue;
					}
				}

			if (!$shop_item['item_id'] || (!$shop_item['price'] && !$shop_item['markup']))
				{
				continue;
				}

			$values = [
				'shops_id' => $Shop->id,
				'items_id' => $shop_item['item_id'],
				'markup' => $shop_item['markup'],
				'price' => $shop_item['price'],
				];

			$ShopItem->fill($values);
			$ShopItem->save();
			}

		Session::flash('success', 'Shop Updated!');

		return redirect()->action('ShopController@edit', ['id' => $Shop->id]);
		// return $this->edit($Shop->fresh()->id);
		}
}
