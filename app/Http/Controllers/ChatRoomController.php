<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ChatRoom;

class ChatRoomController extends Controller
{
	public function show($id)
		{
		return view('chat_room.profile', ['chat_room' => ChatRoom::findOrFail($id)]);
		}

	public function create()
		{
		return view('chat_room.create');
		}

	public function all()
		{
		// admin command:
		$ChatRooms = ChatRoom::all();

		return view('chat_room.all', ['chat_rooms' => $ChatRooms]);
		}

	public function edit($id)
		{
		return view('chat_room.edit', ['chat_room' => ChatRoom::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		// die(print_r($request->chat_room_items));
		if ($request->id)
			{
			$ChatRoom = ChatRoom::findOrFail($request->id);
			// $ChatRoom->save();

			$values = [
				'id' => $ChatRoom->id,
				'name' => $request->name,
				'score_req' => $request->score_req,
				];

			$ChatRoomItem->fill($values);
			$ChatRoomItem->save();

			Session::flash('success', 'ChatRoom Updated!');
			return $this->edit($ChatRoom->id);
			}
		}
}
