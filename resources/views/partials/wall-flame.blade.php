Gaze upon the Wall of Flame.<br><br>
@if ($room->has_property('WALL_OF_FLAME'))
	<table>
	@foreach ($score_list as $listing)
		<tr>
			<td>{!! $listing->display_name() !!}</td>
			<td>{{$listing->score}}</td>
			<td>{{ $listing->rank() }}</td>
			@if ($listing->alignment())
			<td><span style="color: #{{$listing->alignment()->color}}">{{$listing->alignment()->name}}</span></td>
			@else
			<td></td>
			@endif
			<td>{{$listing->gender()->title}}</td>
			<td>{{$listing->race()->name}}</td>
			@if ($listing->kill_stats()->first())
			<td>{{$listing->kill_rank()}}</td>
			@endif
		</tr>
	@endforeach
	</table>
@endif