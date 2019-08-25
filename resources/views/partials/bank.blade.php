
<p>
This is the Bank
</p>


@if( Session::has("bank") )
<p>
{{ Session::get("bank") }}
</p>
@endif

You currently have {{$character->bank}} gold in the bank.
<br><br>
<form method="post" action="/game/deposit" class="ajax">
	Deposit:
	<input type="text" name="deposit">
	<input type="submit" value="Deposit">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>
<br><br>
<form method="post" action="/game/withdraw" class="ajax">
	Withdraw:
	<input type="text" name="withdraw">
	<input type="submit" value="Withdraw">
	<input type="hidden" name="room_id" value="{{$room->id}}">
	<input type="hidden" name="character_id" value="{{$character->id}}">
	{{csrf_field()}}
</form>