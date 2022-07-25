<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\ChatRoom;

class ChatRoomController extends Controller
{
	public function create()
		{
		return view('chat_room.edit');
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
		$ChatRoom = new ChatRoom;
		if ($request->id)
			{
			$ChatRoom = ChatRoom::findOrFail($request->id);
			}

		$values = [
			'id' => $ChatRoom->id,
			'name' => $request->name,
			'score_req' => $request->score_req,
			];

		$ChatRoom->fill($values);
		$ChatRoom->save();

		Session::flash('success', 'ChatRoom Updated!');
		return $this->edit($ChatRoom->id);
		}
}
