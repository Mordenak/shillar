Quest Log:
<br><br>

@if ($character->quests()->count() > 0)
@foreach ($character->quests() as $quest)
{{$quest->quest()->name}} -- {{$quest->complete ? 'Complete' : 'In Progress'}}<br>

<p>
@foreach ($quest->criterias() as $crit)
{{$crit->criteria()->task()->log_entry}} -- {{$crit->complete ? 'Complete' : 'In Progress'}}<br>
@endforeach
</p>

@endforeach
@else
You have not been assigned any quests, go visit the Mayor!
@endif