@extends('layouts.admin')

@section('content')

@if (isset($quest))
Editing a Quest:
@else
Creating a Quest:
@endif
<br>
<div>
	<form action="/quest/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($quest) ? $quest->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Pickup Message:</label>
			<div class="col-md-3">
				<textarea type="text" name="pickup_message" class="form-control">{{isset($quest) ? $quest->pickup_message : ''}}</textarea>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Completion Message:</label>
			<div class="col-md-3">
				<textarea type="text" name="completion_message" class="form-control">{{isset($quest) ? $quest->completion_message : ''}}</textarea>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Optional:</label>
			<div class="col-md-3">
				<input type="checkbox" name="optional" class="form-control" {{isset($quest) && $quest->optional ? 'checked' : ''}}>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Wisdom Requirement:</label>
			<div class="col-md-3">
				<input type="text" name="wisdom_req" value="{{isset($quest) ? $quest->wisdom_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Intelligence Requirement:</label>
			<div class="col-md-3">
				<input type="text" name="intelligence_req" value="{{isset($quest) ? $quest->intelligence_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Wall Score Requirement:</label>
			<div class="col-md-3">
				<input type="text" name="score_req" value="{{isset($quest) ? $quest->score_req : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Quest Prerequisite:</label>
			<div class="col-md-3">
				<input type="text" name="quest_prereq" value="{{isset($quest) ? $quest->quest_prereq : ''}}" class="form-control quest-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Pickup Room:</label>
			<div class="col-md-3">
				<input type="text" name="pickup_rooms_id" value="{{isset($quest) ? $quest->pickup_rooms_id : ''}}" class="form-control room-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Turnin Room:</label>
			<div class="col-md-3">
				<input type="text" name="turnin_rooms_id" value="{{isset($quest) ? $quest->turnin_rooms_id : ''}}" class="form-control room-lookup">
			</div>
		</div>

		<h3>Quest Tasks:</h3>
		<div class="quest-tasks">
			<div class="task-forms">

			@if (isset($quest) && $quest->tasks()->count() > 0)
				@foreach ($quest->tasks() as $quest_task)
				<div class="form-group row">
					<h5>Task</h5>
					<div class="form-group row">
						<input type="hidden" name="tasks[{{$quest_task->id}}][id]" value="{{$quest_task->id}}">
						<label class="col-md-1 col-form-label text-md-right">UID:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][uid]" value="{{$quest_task->uid}}" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Name:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][name]" value="{{$quest_task->name}}" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Log Entry:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][log_entry]" value="{{$quest_task->log_entry}}" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Pickup Message:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][pickup_message]" value="{{$quest_task->pickup_message}}" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Completion Message:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][completion_message]" value="{{$quest_task->completion_message}}" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Seq:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][seq]" value="{{$quest_task->seq}}" class="form-control">
						</div>
					</div>
					<h5>Criteria</h5>
					<div class="form-group row" style="padding-left: 3rem;">
						<input type="hidden" name="tasks[{{$quest_task->criteria()->id}}][criteria_id]" value="{{$quest_task->criteria()->id}}">
						<label class="col-md-1 col-form-label text-md-right">Creature:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->id}}][creature_target]" value="{{$quest_task->criteria()->creature_target}}" class="form-control creature-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Zone:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][zone_target]" value="{{$quest_task->criteria()->zone_target}}" class="form-control zone-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Room:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][room_target]" value="{{$quest_task->criteria()->room_target}}" class="form-control room-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Room Action:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][room_action_target]" value="{{$quest_task->criteria()->room_action_target}}" class="form-control room-action-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Item:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][item_target]" value="{{$quest_task->criteria()->item_target}}" class="form-control item-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Alignment:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][alignment_target]" value="{{$quest_task->criteria()->alignment_target}}" class="form-control alignment-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Amount:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[{{$quest_task->criteria()->id}}][creature_amount]" value="{{$quest_task->criteria()->creature_amount}}" class="form-control">
						</div>
					</div>

				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<h5>Task</h5>
					<div class="form-group row">
						<label class="col-md-1 col-form-label text-md-right">Uid:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][uid]" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Name:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][name]" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Log Entry:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][log_entry]" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Pickup Message:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][pickup_message]" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Completion Message:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][completion_message]" class="form-control">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Seq:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][seq]" class="form-control">
						</div>
					</div>

					<h5>Criteria</h5>
					<div class="form-group row" style="padding-left: 3rem;">
						
						<label class="col-md-1 col-form-label text-md-right">Creature:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][creature_target]" class="form-control creature-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Zone:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][zone_target]" class="form-control zone-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Room:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][room_target]" class="form-control room-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Room Action:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][room_action_target]" class="form-control room-action-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Item:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][item_target]" class="form-control item-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Alignment:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][alignment_target]" class="form-control alignment-lookup">
						</div>
						<label class="col-md-1 col-form-label text-md-right">Amount:</label>
						<div class="col-md-2">
							<input type="text" name="tasks[0][creature_amount]" class="form-control">
						</div>
					</div>

				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addQuestTask(this);">Add Quest Task</a>

		<br><br>
		<h3>Quest Reward</h3>

		@if (isset($quest))
		<input type="hidden" name="reward_id" id="reward-id" value="{{$quest->reward()->id}}">
		@endif

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Item Reward:</label>
			<div class="col-md-3">
				<input type="text" name="item_reward" value="{{isset($quest) ? $quest->reward()->item_reward : ''}}" class="form-control item-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">XP Reward:</label>
			<div class="col-md-3">
				<input type="text" name="xp_reward" value="{{isset($quest) ? $quest->reward()->xp_reward : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Gold Reward:</label>
			<div class="col-md-3">
				<input type="text" name="gold_reward" value="{{isset($quest) ? $quest->reward()->gold_reward : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">QP Reward:</label>
			<div class="col-md-3">
				<input type="text" name="quest_point_reward" value="{{isset($quest) ? $quest->reward()->quest_point_reward : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Item Choices (1,2,3,...):</label>
			<div class="col-md-3">
				<input type="text" name="item_choices" value="{{isset($quest) ? $quest->reward()->item_choices : ''}}" class="form-control">
			</div>
		</div>


		@if (isset($quest))
		<input type="hidden" name="id" id="db-id" value="{{$quest->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/quest/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<script>
function addQuestTask($btn)
	{
	var $tmp = $('.task-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/tasks\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/tasks\[\d*\]/, 'tasks['+new_id+']');
		$(this).attr('name', name);
		});

	$('.task-forms').append($tmp);
	$('.task-forms').last().find('input[name="id"]').remove();
	}

</script>
@endsection