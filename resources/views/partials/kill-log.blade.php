Kill Log:

@if (isset($kill_list))
<table>
	<thead>
		<tr>
			<td>Creature</td>
			<td>Amount</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($kill_list as $item)
		<tr>
			<td>{{$item->creature()->name}}</td>
			<td>{{$item->count}}</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endif