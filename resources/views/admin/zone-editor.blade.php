@extends('layouts.admin')

@section('content')
<style>
#room-info
	{
	float: left;
	}

.map-wrapper
	{
	overflow: scroll;
	}

.map
	{
	background-color: gray;
	text-align: center;
	table-layout: fixed;
	}

.map td
	{
	/* vertical-align: top; */
	position: relative;
	padding: 0px;
	border: 1px solid black;
	margin: 5px;
	height: 50px;
	width: 50px;
	}

.map td.room
	{
	background-color: #DDD;
	}

.map td.highlight
	{
	background-color: yellow;
	}

.map td[data-north] .n-blip, .map td[data-northeast] .ne-blip, .map td[data-northwest] .nw-blip, .map td[data-east] .e-blip, .map td[data-south] .s-blip, .map td[data-southeast] .se-blip, .map td[data-southwest] .sw-blip, .map td[data-west] .w-blip
	{
	display: block;
	}

.blip
	{
	display: none;
	width: 4px;
	height: 4px;
	background-color: blue;
	position: absolute;
	}

.nw-blip
	{
	top:0;
	left:0;
	}

.n-blip
	{
	top: 0;
	left: 45%;
	}

.ne-blip
	{
	top: 0;
	left: 90%;
	}

.w-blip
	{
	top: 45%;
	left: 0;
	}

.e-blip
	{
	left: 90%;
	top: 45%;
	}

.se-blip
	{
	left: 90%;
	top: 90%;
	}

.s-blip
	{
	left: 45%;
	top: 90%;
	}

.sw-blip
	{
	top: 90%;
	left: 0;
	}
</style>

<div id="room-info" style="display:none;">
</div>
<div class="map-wrapper">
	<form method="post" action="/admin/zone_builder">
		<a href="#" class="add-row">Add Row</a>
		<a href="#" class="add-column">Add Column</a>
		<a href="#" class="link-adjacents">Link All Adjacents</a>
    <a href="#" class="clear-map">Clear Map</a>
		<table id="map" class="map">
			<thead>
			</thead>
			<tbody>
			</tbody>
		</table>

		<label for="zone-id" class="col-md-1">Zone:</label>
		<input type="text" id="zone-id" name="zones_id" class="col-md-2 form-control auto-lookup zone-lookup">
		<input type="submit" value="Build it!">
		{{csrf_field()}}
	</form>
</div>

<script>
var $new_ids = 0;
  
function start()
	{
	$new_ids = 0;
	// start canvas:
	height = 7;
	width = 7;

	for(i=0;i<width;i++)
		{
		$tr = $('<tr/>');
		for(x=0;x<height;x++)
			{
			$td = $('<td/>');
			$tr.append($td);
			}
		$('.map tbody').append($tr);
		}
  $('.map td').each(function(i,e) {
    $(e).append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
  	});
	}

start();

function show_room($td)
	{
	var $insert = $('<div/>', {"class": 'insert', 'data-id': $td.attr('id')});
	$insert.append($('<label/>').append('Room '+$td.attr('id')));
	$insert.append('<br>');
	$insert.append('N:');
	$insert.append($('<input/>', {id: 'north', name: 'north', value: $td.attr('data-north')}));
	$insert.append('<br>');
	$insert.append('E:');
	$insert.append($('<input/>', {id: 'east', name: 'east', value: $td.attr('data-east')}));
	$insert.append('<br>');
	$insert.append('S:');
	$insert.append($('<input/>', {id: 'south', name: 'south', value: $td.attr('data-south')}));
	$insert.append('<br>');
	$insert.append('W:');
	$insert.append($('<input/>', {id: 'west', name: 'west', value: $td.attr('data-west')}));
	$insert.append('<br>');
	$insert.append('NE:');
	$insert.append($('<input/>', {id: 'northeast', name: 'northeast', value: $td.attr('data-northeast')}));
	$insert.append('<br>');
	$insert.append('SE:');
	$insert.append($('<input/>', {id: 'southeast', name: 'southeast', value: $td.attr('data-southeast')}));
	$insert.append('<br>');
	$insert.append('SW:');
	$insert.append($('<input/>', {id: 'southwest', name: 'southwest', value: $td.attr('data-southwest')}));
	$insert.append('<br>');
	$insert.append('NW:');
	$insert.append($('<input/>', {id: 'northwest', name: 'northwest', value: $td.attr('data-northwest')}));
	$('#room-info').html($insert);
	$('#room-info').show();
	}
  
$('body').on('click', '.clear-map', function(e) {
	$('.map tbody').html('');
	$('.map').css({width: ''});
	start();
	});

$('body').on('click', '.add-row', function(e) {
	var $new = $('.map').find('tr').last().clone();
	$cols = $('.map').find('tr').last().find('td').length;
	$tr = $('<tr/>');
	for(i=0;i<$cols;i++)
		{
		$cell = $('<td/>');
		$cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
		$tr.append($cell);
		}
	$('.map tbody').append($tr);
	});
  
$('body').on('click', '.add-column', function(e) { 
	$('.map tbody tr').each(function(i,e) {
		$cell = $('<td/>');
		$cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
		$(e).append($cell);
		});

	// map width doesn't work if the float is displaying???
	if ($('.map').width() > 1000)
		{
		$('.map').css({width: '100%'});
		}
	});
  
$('body').on('click', '.link-adjacents', function(e) {
	$('.room').each(function(i,e) {
		getAdjacents($(e));
		});
	});
  
function getAdjacents($el)
	{
	var search_start = $el.index();
	var parent_start = $el.parent().index();

	indexes = [-1, 0, 1];

	for(i=0;i<indexes.length;i++)
		{
		if (parent_start + indexes[i] < 0)
			{
			continue;
			}
		$parent = $($('.map').find('tr')[parent_start + indexes[i]]);
		for (x=0;x<indexes.length;x++)
			{
			if (parent_start + indexes[x] < 0)
				{
				continue;
				}
			$room = $($parent.find('td')[search_start + indexes[x]]);
			if ($room.attr('id') == $el.attr('id'))
				{
				continue;
				}
			if ($room.hasClass('room'))
				{
				performLink($el, $room);
				}
			}
		}
	}

$('body').on('click', '.map td', function(e) { 
	/* $('.container').append($('<div/>', {"class": 'child'})); */
	select_room($(e.target));
	});
  
function select_room($room)
	{
  $('.map td').removeClass('highlight');
  $room.addClass('highlight');
  
  if ($room.hasClass('room'))
  	{
    show_room($room);
    }
  else
  	{
    $('#room-info').hide();
    }
  }

// Not needed yet:
/* document.getElementById('map').addEventListener("wheel", event => {
	 const delta = Math.sign(event.deltaY);
	 if (delta == -1)
		{
		$('.map').animate({ 'zoom': 2 }, {'queue': false});
		}
	 else
		{
		$('.map').animate({ 'zoom': 1 }, {'queue': false});
		}
}); */

$('body').on('contextmenu', '.map td', function(e) { 
	/* $('.container').append($('<div/>', {"class": 'child'})); */
	if ($(e.target).hasClass('room'))
		{
   	// var result = do we care?
		var result = performLink($('.map td.highlight'), $(e.target), true);
    if (result)
    	{
      select_room($(e.target));
      }
    return false;
		}

	$('.map td').removeClass('highlight');
	$(e.target).addClass('room');
	$(e.target).attr('id', $new_ids);
	$(e.target).append($new_ids);
	$(e.target).append($('<input/>', {type: 'hidden', name: 'new_rooms['+$new_ids+'][id]', value: $new_ids}));
	$new_ids++;
	return false;
	});

function performLink($selected, $target, $reverse = false)
	{
	if (!$selected)
		{
		return false;
		}
	if ($target.hasClass('room'))
		{
		$current = $selected;
		//$target = $el;

		if ($current.attr('id') == $target.attr('id'))
		{
		return false;
		}

		//otherwise link:
		// unless too far:
		if (Math.abs($current.index() - $target.index()) > 1)
			{
			return false;
			}
		else
			{
			if (Math.abs($target.parent().index() - $current.parent().index()) > 1)
				{
				return false;
				}
			}
		// TODO: Make it smarter!
		// left or right?
		if ($current.index() == $target.index())
			{
			// north or south:
			if ($target.parent().index() > $current.parent().index())
				{
				// south
				if ($reverse && $current.attr('data-south') && $target.attr('data-north'))
					{
					removeLinks($current, 'south');
					removeLinks($target, 'north');
					}
				else
					{
					$current.attr('data-south', $target.attr('id'));
					$target.attr('data-north', $current.attr('id'));
					updateLinks($current, 'south', $target.attr('id'));
					updateLinks($target, 'north', $current.attr('id'));
					}
				}
			else
				{
				// north
				if ($reverse && $current.attr('data-north') && $target.attr('data-south'))
					{
					removeLinks($current, 'north');
					removeLinks($target, 'south');
					}
				else
					{
					$current.attr('data-north', $target.attr('id'));
					$target.attr('data-south', $current.attr('id'));
					updateLinks($current, 'north', $target.attr('id'));
					updateLinks($target, 'south', $current.attr('id'));
					}
				}
			}
		else if ($current.index() > $target.index())
			{
			// west
			if ($target.parent().index() == $current.parent().index())
				{
				// due west
				if ($reverse && $current.attr('data-west') && $target.attr('data-east'))
					{
					removeLinks($current, 'west');
					removeLinks($target, 'east');
					}
				else
					{
					$current.attr('data-west', $target.attr('id'));
					$target.attr('data-east', $current.attr('id'));
					updateLinks($current, 'west', $target.attr('id'));
					updateLinks($target, 'east', $current.attr('id'));
					}
				}
			else if ($target.parent().index() > $current.parent().index())
				{
				// sw
				if ($reverse && $current.attr('data-southwest') && $target.attr('data-northeast'))
					{
					removeLinks($current, 'southwest');
					removeLinks($target, 'northeast');
					}
				else
					{
					$current.attr('data-southwest', $target.attr('id'));
					$target.attr('data-northeast', $current.attr('id'));
					updateLinks($current, 'southwest', $target.attr('id'));
					updateLinks($target, 'northeast', $current.attr('id'));
					}
				}
			else
				{
				// nw
				if ($reverse && $current.attr('data-northwest') && $target.attr('data-southeast'))
					{
					removeLinks($current, 'northwest');
					removeLinks($target, 'southeast');
					}
				else
					{
					$current.attr('data-northwest', $target.attr('id'));
					$target.attr('data-southeast', $current.attr('id'));
					updateLinks($current, 'northwest', $target.attr('id'));
					updateLinks($target, 'southeast', $current.attr('id'));
					}
				}
			}
		else
			{
			// east
			if ($target.parent().index() == $current.parent().index())
				{
				// due east
				if ($reverse && $current.attr('data-east') && $target.attr('data-west'))
					{
					removeLinks($current, 'east');
					removeLinks($target, 'west');
					}
				else
					{
					$current.attr('data-east', $target.attr('id'));
					$target.attr('data-west', $current.attr('id'));
					updateLinks($current, 'east', $target.attr('id'));
					updateLinks($target, 'west', $current.attr('id'));
					}
				}
			else if ($target.parent().index() > $current.parent().index())
				{
				// se
				if ($reverse && $current.attr('data-southeast') && $target.attr('data-northwest'))
					{
					removeLinks($current, 'southeast');
					removeLinks($target, 'northwest');
					}
				else
					{
					$current.attr('data-southeast', $target.attr('id'));
					$target.attr('data-northwest', $current.attr('id'));
					updateLinks($current, 'southeast', $target.attr('id'));
					updateLinks($target, 'northwest', $current.attr('id'));
					}
				}
			else
				{
				// ne
				if ($reverse && $current.attr('data-northeast') && $target.attr('data-southwest'))
					{
					removeLinks($current, 'northeast');
					removeLinks($target, 'southwest');
					}
				else
					{
					$current.attr('data-northeast', $target.attr('id'));
					$target.attr('data-southwest', $current.attr('id'));
					updateLinks($current, 'northeast', $target.attr('id'));
					updateLinks($target, 'southwest', $current.attr('id'));
					}
				} 
			}
		/* $(e.target).removeClass('room'); */
		return true;
		}
	}
  
function removeLinks($current_room, direction)
	{
	var id = $current_room.attr('id');
	$('td#'+id).removeAttr('data-'+direction);
	var val_str = $('input.hidden-vals#hidden_'+id).val();
	var hash = JSON.parse(val_str);
	// insert
	delete hash[direction];
	$('input.hidden-vals#hidden_'+id).val(JSON.stringify(hash));
	return true;
	}

function updateLinks($current_room, direction, new_link)
	{
	if ($('#room-info div').data('id') == $current_room.attr('id'))
		{
		$('input#'+direction).val(new_link);
		}
	var id = $current_room.attr('id');
	if ($current_room.find('input.hidden-vals').length > 0)
		{
		console.log('exists');
		// if it exists, decode it:
		var val_str = $('input.hidden-vals#hidden_'+id).val();
		var hash = JSON.parse(val_str);
		// insert
		hash[direction] = new_link;
		$('input.hidden-vals#hidden_'+id).val(JSON.stringify(hash));
		}
	else
		{
		console.log('new!')
		var obj = {};
		obj[direction] = new_link;
		$('<input/>', {type: 'hidden', id: 'hidden_'+id, name: 'new_rooms['+id+'][dirs]', "class": 'hidden-vals', value: JSON.stringify(obj)}).appendTo($current_room);
		}
	}

$('#room-info').on('change', 'input', function(e) {
	$newdir = $(e.target).attr('name');
	$newval = $(e.target).val();
	room = $(e.target).parent().data('id');
	if ($newval)
		{
		$('td#'+room).attr('data-'+$newdir, $newval);
		}
	else
		{
		$('td#'+room).removeAttr('data-'+$newdir);
		var val_str = $('input.hidden-vals#hidden_'+room).val();
		var hash = JSON.parse(val_str);
		// insert
		delete hash[$newdir];
		$('input.hidden-vals#hidden_'+room).val(JSON.stringify(hash));
		}
	// flip it?
	});
</script>
@endsection