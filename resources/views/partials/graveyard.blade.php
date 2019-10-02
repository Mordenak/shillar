The Graveyard
<br><br>
<div class="grave-list">
@foreach ($graves as $grave)
	<div>
		Here lies {!! $grave->character()->display_name() !!},<br>
		Slain by {{$grave->creature()->name}}<br>
		on {{$grave->created_at}}
	</div>
@endforeach
</div>

<style>
.grave-list
	{
	display: inline-grid;
	grid-template-columns: 1fr 1fr 1fr 1fr;
	grid-gap: 1rem;
	}

.grave-list > div
	{
	border: 1px solid #ddd;
	border-radius: 50px 50px 0 0;
	padding: 3rem .5rem 1rem .5rem;
	}
</style>
