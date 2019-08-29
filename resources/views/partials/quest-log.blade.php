Quest Log:
<br><br>

@if ($character->quests()->count() > 0)
@foreach ($character->quests() as $quest)
{{$quest->quest()->name}} -- {{$quest->complete ? 'Complete' : 'In Progress'}}<br>
@endforeach
@else
You have not been assigned any quests, go visit the Mayor!
@endif