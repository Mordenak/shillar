@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/creature/create">
			<div class="form-group row">
				<div class="col-md-3">
					<input type="submit" value="Add Creature" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>

	@if ($creatures)
	<table id="all-records">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Creature Group(s)</th>
			<th>Spawn Zone</th>
			<th>Spawn Room</th>
		</thead>
		<tbody>
			@foreach ($creatures as $creature)
			<tr>
				<td>{{$creature->id}}</td>
				<td>
					<a href="/creature/edit/{{$creature->id}}">{{$creature->name}}</a>
				</td>
				<td>
					@if ($creature->creature_groups()->get())
					@foreach ($creature->creature_groups()->get() as $group)
					{{$group->name}}
					@endforeach
					@endif
				</td>
				<td>
					@if ($creature->spawn_rules()->count() > 0)
					@foreach ($creature->spawn_rules() as $spawn_rule)
					@if ($spawn_rule->zone())
					{{$spawn_rule->zone()->name}},
					@endif
					@endforeach
					@endif

					@if ($creature->creature_groups()->get())
					@foreach ($creature->creature_groups()->get() as $group)

					@foreach ($group->spawn_rules() as $spawn_rule)
					@if ($spawn_rule->zone())
					{{$spawn_rule->zone()->name}},
					@endif
					@endforeach
					@endforeach
					@endif
				</td>
				<td>
					@if ($creature->spawn_rules()->count() > 0)
					@foreach ($creature->spawn_rules() as $spawn_rule)
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
</div>
@endif

@endsection