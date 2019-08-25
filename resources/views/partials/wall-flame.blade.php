@if ($room->has_property('WALL_SCORE'))
	<table>
	@foreach ($score_list as $listing)
		<tr>
			<td>{!! $listing->display_name() !!}</td>
			<td>{{$listing->score}}</td>
			<td>{{ $listing->rank() }}</td>
			<td>{{$listing->playerrace()->gender}}</td>
			<td>{{$listing->playerrace()->name}}</td>
		</tr>
	@endforeach
	</table>
@endif