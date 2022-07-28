@extends('layouts.admin')

@section('content')

@if (isset($room_action))
Editing a Room Action:
@else
Creating a Room Action:
@endif
<br>
<div>
	<form action="/room_action/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">UID:</label>
			<div class="col-md-3">
				<input type="text" name="uid" value="{{isset($room_action) ? $room_action->uid : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Room:</label>
			<div class="col-md-3">
				<input type="text" name="rooms_id" value="{{isset($room_action) ? $room_action->rooms_id : ''}}" class="form-control room-lookup" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Redirect Room:</label>
			<div class="col-md-3">
				<input type="text" name="redirect_room" value="{{isset($room_action) ? $room_action->redirect_room : ''}}" class="form-control room-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($room_action) ? $room_action->description : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Action:</label>
			<div class="col-md-3">
				<input type="text" name="action" value="{{isset($room_action) ? $room_action->action : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Success Action:</label>
			<div class="col-md-3">
				<input type="text" name="success_action" value="{{isset($room_action) ? $room_action->success_action : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Failed Action:</label>
			<div class="col-md-3">
				<input type="text" name="failed_action" value="{{isset($room_action) ? $room_action->failed_action : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Display:</label>
			<div class="col-md-3">
				<input type="text" name="display" value="{{isset($room_action) ? $room_action->display : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Linked Img:</label>
			<div class="col-md-3">
				<input type="text" name="linked_img" value="{{isset($room_action) ? $room_action->linked_img : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Direction to Block ([0,1,2,3...]):</label>
			<div class="col-md-3">
				<input type="text" name="directions_blocked" value="{{isset($room_action) ? $room_action->directions_blocked : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Remember?:</label>
			<div class="col-md-3">
				<input type="checkbox" name="remember" class="form-control" {{isset($room_action) && $room_action->remember ? 'checked' : ''}}>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Item:</label>
			<div class="col-md-3">
				<input type="text" name="has_item" value="{{isset($room_action) ? $room_action->has_item : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Completed Quest:</label>
			<div class="col-md-3">
				<input type="text" name="completed_quest" value="{{isset($room_action) ? $room_action->completed_quest : ''}}" class="form-control quest-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Completed Quest Task:</label>
			<div class="col-md-3">
				<input type="text" name="completed_question_task" value="{{isset($room_action) ? $room_action->completed_quest_task : ''}}" class="form-control quest-task-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Strength:</label>
			<div class="col-md-3">
				<input type="text" name="strength_req" value="{{isset($room_action) ? $room_action->strength_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Dexterity:</label>
			<div class="col-md-3">
				<input type="text" name="dexterity_req" value="{{isset($room_action) ? $room_action->dexterity_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Constitution:</label>
			<div class="col-md-3">
				<input type="text" name="constitution_req" value="{{isset($room_action) ? $room_action->constitution_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Wisdom:</label>
			<div class="col-md-3">
				<input type="text" name="wisdom_req" value="{{isset($room_action) ? $room_action->wisdom_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Intelligence:</label>
			<div class="col-md-3">
				<input type="text" name="intelligence_req" value="{{isset($room_action) ? $room_action->intelligence_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Charisma:</label>
			<div class="col-md-3">
				<input type="text" name="charisma_req" value="{{isset($room_action) ? $room_action->charisma_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Required Wall Score:</label>
			<div class="col-md-3">
				<input type="text" name="score_req" value="{{isset($room_action) ? $room_action->score_req : ''}}" class="form-control">
			</div>
		</div>

		@if (isset($room_action))
		<input type="hidden" name="id" id="db-id" value="{{$room_action->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($room_action) ? 'Editing a Room Action' : 'Creating a Room Action' }}" baseroute="room_action" dbid="{{ isset($room_action) ? $room_action->id : 0}}"></x-admin-nav>
</div>
@endsection