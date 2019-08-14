@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/npc/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add NPC" class="form-control">
			</div>
		</div>
	</form>
</div>

@foreach ($npcs as $npc)
	
@endforeach

@if ($npcs)
<table id="all-npcs">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Spawn Zone</th>
		<th>Spawn Room</th>
	</thead>
	<tbody>
		@foreach ($npcs as $npc)
		<tr>
			<td>{{$npc->id}}</td>
			<td>
				<a href="/npc/edit/{{$npc->id}}">{{$npc->name}}</a>
			</td>
			<td>
				@if ($npc->spawn_rules()->count() > 0)
				@foreach ($npc->spawn_rules() as $spawn_rule)
				@if ($spawn_rule->zone())
				{{$spawn_rule->zone()->name}},
				@endif
				@endforeach
				@endif
			</td>
			<td>
				@if ($npc->spawn_rules()->count() > 0)
				@foreach ($npc->spawn_rules() as $spawn_rule)
				@if ($spawn_rule->room())
				{{$spawn_rule->room()->title}},
				@endif
				@endforeach
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-npcs').dataTable();
</script>
@endif

@endsection