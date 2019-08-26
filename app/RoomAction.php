<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomAction extends Model
{
	protected $fillable = ['uid', 'rooms_id', 'redirect_room', 'description', 'action', 'failed_action', 'display', 'directions_blocked', 'remember', 'has_item', 'completed_quest', 'completed_quest_task', 'strength_req', 'dexterity_req', 'constitution_req', 'wisdom_req', 'intelligence_req', 'charisma_req', 'score_req'];

	public function room()
		{
		return $this->belongsTo('App\Room')->first();
		}

	public function redirect_room()
		{
		return $this->belongsTo('App\Room', 'redirect_room', 'rooms_id')->first();
		}

	public function show_action()
		{
		$rep_str = str_replace('[action]', '<label for="room-action">'.$this->action.'</label>', $this->display);
		// $new_display = '<label for="room-action">'.$rep_str.'</label>';
		return $rep_str;
		}

	public function blocked_dirs()
		{
		$arr = explode(',',$this->directions_blocked);
		$list = [];
		foreach ($arr as $key)
			{
			$list[$key.'_rooms_id'] = true;
			}
		// die(print_r($list));
		return $list;
		}
}
