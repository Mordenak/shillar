<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
	protected $fillable = ['name', 'score_req'];

	public function messages()
		{
		return $this->hasMany('App\ChatRoomMessage', 'chat_rooms_id')->orderBy('created_at', 'desc')->limit(50)->get();
		}
}
