<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomProperty;

class RoomPropertyController extends Controller
{
	public function lookup(Request $request)
		{
		$RoomProperties = RoomProperty::where('name', 'ilike', "%$request->term%")->get();	

		$arr = [];

		if ($RoomProperties)
			{
			foreach ($RoomProperties as $RoomProperty)
				{
				$label = "($RoomProperty->id) ".$RoomProperty->name." ".$RoomProperty->custom_view;
				$arr[] = [
					'label' => $label,
					'value' => $RoomProperty->id,
					];
				}
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$RoomProperties = RoomProperty::where('id', '=', $request->term)->get();

			if ($RoomProperties)
				{
				foreach ($RoomProperties as $RoomProperty)
					{
					$label = "($RoomProperty->id) ".$RoomProperty->name." ".$RoomProperty->custom_view;
					$arr[] = [
						'label' => $label,
						'value' => $RoomProperty->id,
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
