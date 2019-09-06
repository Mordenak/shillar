
@if (Session::has('combat_log'))
<p style="color: red;display: inline;">
@foreach (Session::pull('combat_log') as $log_entry)
	{!! $log_entry !!}
@endforeach
@endif

<div style="margin-left: auto;margin-right: auto;">
	<img src="{{asset('img/white.jpg')}}">
</div>

<p style="color: red;display: inline;">
Oops! Dying sucks does it!?
</p>

<form method="post" action="/game">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="submit" value="Continue">
	{{csrf_field()}}
</form>