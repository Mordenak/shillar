@extends('layouts.app')

@section('content')
Create a Character:<br>


<form action="/character/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	<!-- <input type="hidden" name="users_id" value=""> -->

	<div class="form-group row">
		<label class="col-md-2 col-form-label text-md-right">Name:</label>
		<div class="col-md-3">
			<input type="text" name="name" class="form-control">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-2 col-form-label text-md-right">Race:</label>
		<div class="col-md-3">
			<select name="selected_race" class="form-control">
			@foreach ($races as $race)
				<option value="{{$race->id}}">{{$race->name}}</option>
			@endforeach
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-2 col-form-label text-md-right">Gender:</label>
		<div class="col-md-3">
			<select name="selected_gender" class="form-control">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-2 col-form-label text-md-right">Bonus Stats:</label>
		<div class="col-md-2">
			<select name="bonus_stats_1" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="bonus_stats_2" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="bonus_stats_3" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-2 col-form-label text-md-right"></label>
		<div class="col-md-2">
			<select name="bonus_stats_4" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="bonus_stats_5" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="bonus_stats_6" class="form-control">
				<option value="strength">+5 Str</option>
				<option value="dexterity">+5 Dex</option>
				<option value="constitution">+5 Con</option>
				<option value="wisdom">+5 Wis</option>
				<option value="intelligence">+5 Int</option>
				<option value="charisma">+5 Cha</option>
			</select>
		</div>
	</div>


	<div class="form-group row mb-0">
		<div class="col-md-1 offset-md-1">
			<a href="/npc/all" class="btn btn-primary">Cancel</a>
		</div>
		<div class="col-md-2 offset-md-2">
			<input type="submit" value="Save" class="btn btn-primary">
		</div>
	</div>
</form>
@endsection