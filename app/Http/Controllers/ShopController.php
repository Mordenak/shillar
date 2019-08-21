<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
	public function all(Request $request)
		{
		$shops = Shop::all();
		return view('shop.all', ['shops' => $shops]);
		}

	public function create()
		{
		return view('shop.edit');
		}

	public function edit($id)
		{
		return view('shop.edit', ['shop' => Shop::findOrFail($id)]);
		}

	public function delete($id)
		{
		Shop::delete($id);
		return $this->action('ShopController@all');
		}

	public function save(Request $request)
		{
		if ($request->id)
			{
			// 
			}
		else
			{
			// 
			}

		return true;
		}
}
