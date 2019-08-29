<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ChatRoomMessage extends Model
{
	protected $fillable = ['chat_rooms_id', 'characters_id', 'message'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function created_time()
		{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('H:i');
		}

	public function created_date()
		{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('n/d/Y');
		}
}
