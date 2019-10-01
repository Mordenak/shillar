<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\RoomAction;

class RoomActionController extends Controller
{
	public function create()
		{
		// $forges = ForgeRecipe::all();
		return view('room_action.edit');
		}

	public function all(Request $request)
		{
		$room_actions = RoomAction::all();
		return view('room_action.all', ['room_actions' => $room_actions]);
		}

	public function edit($id)
		{
		$RoomAction = RoomAction::findOrFail($id);
		return view('room_action.edit', ['room_action' => $RoomAction]);
		}

	public function delete(Request $request)
		{
		$RoomAction = RoomAction::findOrFail($request->id);
		$RoomAction->delete();
		Session::flash('success', 'RoomAction Deleted!');
		return redirect()->action('RoomActionController@all');
		}

	public function save(Request $request)
		{
		$RoomAction = new RoomAction;

		if ($request->id)
			{
			$RoomAction = RoomAction::findOrFail($request->id);
			}

		$values = [
			'uid' => $request->uid,
			'rooms_id' => $request->rooms_id,
			'redirect_room' => $request->redirect_room,
			'description' => $request->description,
			'action' => $request->action,
			'failed_action' => $request->failed_action,
			'display' => $request->display,
			'directions_blocked' => $request->directions_blocked,
			'remember' => isset($request->remember) ? true : false,
			'has_item' => $request->has_item,
			'completed_quest' => $request->completed_quest,
			'completed_quest_task' => $request->completed_quest_task,
			'strength_req' => $request->strength_req,
			'dexterity_req' => $request->dexterity_req,
			'constitution_req' => $request->constitution_req,
			'wisdom_req' => $request->wisdom_req,
			'intelligence_req' => $request->intelligence_req,
			'charisma_req' => $request->charisma_req,
			'score_req' => $request->score_req,
			];

		$RoomAction->fill($values);
		$RoomAction->save();

		Session::flash('success', 'Room Action Updated!');
		return $this->edit($RoomAction->fresh()->id);
		}
}
