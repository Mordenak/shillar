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
	background-color: #555;
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
	background-color: #999;
	}

.map td.room.existing-room:not([data-zones_id])
	{
	background-color: #33b;
	}

.map td.start
	{
	background-color: #4D6;
	}

.map td.multiple-rooms
	{
	background-color: #d33;
	}

.map td.dislocated
	{
	background-color: #d33;
	}

.map td.highlight
	{
	background-color: #d3d339;
	animation-name: highlight;
	animation-duration: 2s;
	animation-iteration-count: infinite;
	color: brown;
	}

@keyframes highlight {
	0% {
		background-color: #c3c339;
		}
	50% {
		background-color: #ffff39;
		}
	100% {
		background-color: #c3c339;
		}
	}

.map td[data-north_rooms_id] .n-blip, .map td[data-northeast_rooms_id] .ne-blip, .map td[data-northwest_rooms_id] .nw-blip, .map td[data-east_rooms_id] .e-blip, .map td[data-south_rooms_id] .s-blip, .map td[data-southeast_rooms_id] .se-blip, .map td[data-southwest_rooms_id] .sw-blip, .map td[data-west_rooms_id] .w-blip
	{
	display: block;
	}

.map td[data-down_rooms_id]:after
	{
	font-family: 'Font Awesome 5 Free';
	content: '\f13a';
	color: #33ffee;
	position: absolute;
	bottom: 0;
	left: 0;
	}

.map td[data-up_rooms_id]:before
	{
	font-family: 'Font Awesome 5 Free';
	content: '\f139';
	color: #33ffee;
	position: absolute;
	top: 0;
	right: 0;
	}

.map td[data-title]
	{
	color: #000;
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

.container
	{
	margin-right: 2rem;
	margin-left: 2rem;
	}

.zone-builder
	{
	display: grid;
	grid-template:
		'header header header'
		'sidebar map listing';
	grid-template-columns: 12.5rem auto 12.5rem;
	grid-gap: .25rem;
	}

#zone-header
	{
	grid-area: header;
	}

#room-info
	{
	grid-area: sidebar;
	min-height: 500px;
	}

.map-wrapper
	{
	grid-area: map;
	}

#unlinked-list
	{
	grid-area: listing;
	}

.container
	{
	max-width: none !important;
	}

</style>


<div class="zone-builder">
	<div id="zone-header">
		
	</div>
	<div id="room-info">
		-- Select a Room --
	</div>
	<div class="map-wrapper">
		<div class="level-view"></div>
		<form method="post" id="builder" action="/admin/zone_builder">
			<table id="map_0" class="map" data-zone_level="0">
				<thead>
				</thead>
				<tbody>
				</tbody>
			</table>

			<input type="hidden" id="zone-id" name="zones_id">
			<input type="submit" id="save-zone" value="Save" style="display:none;">
			{{csrf_field()}}
		</form>
	</div>
	<div id="unlinked-list">
		<div>
			-- Map Options --<br>
			<a href="#" onclick="switchZLevel(1);">+ Up</a> Level <a href="#" onclick="switchZLevel(-1);">- Down</a><br>
			-- Room Options --<br>
			<a href="#" onclick="linkUp();">Create Room Up</a><br>
			<a href="#" onclick="linkDown();">Create Room Down</a><br>
			-- Other Options --<br>
			<a href="#" onclick="addRow(true);">Add Row Top</a><br>
			<a href="#" onclick="addRow();">Add Row Bottom</a><br>
			<a href="#" onclick="addCol(true);">Add Column Left</a><br>
			<a href="#" onclick="addCol();">Add Column Right</a><br>
			<a href="#" onclick="addZLevel(1);">Add Floor Up</a><br>
			<a href="#" onclick="addZLevel(-1);">Add Floor Down</a><br>
			<a href="#" class="link-adjacents">Link All Adjacents</a><br>
			<a href="#" class="clear-map">Clear Map</a><br>
		</div>
		Unlinked List:<br>
		<div id="unlinked-rooms">
		</div>
	</div>
</div>

<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
	<div class="col-md-1">
		<a href="/admin" class="btn btn-info">Admin Home</a>
	</div>
	<div class="col-md-2 offset-md-1">
		<h3 style="display:inline-block;">
			Zone Editor
		</h3>
	</div>
	<div class="col-md-1">
		<form method="post" action="/admin/zone_select" style="display:inline-block;">
			<select id="zone-select" name="zones_id">
				<option value="null">-- Select --</option>
				@foreach (App\Zone::all() as $zone)
				<option value="{{$zone->id}}">{{$zone->name}}</option>
				@endforeach
			</select>
			{{csrf_field()}}
		</form>
	</div>
	<div class="offset-md-1">
		<button onclick="$('#builder').submit();" class="btn btn-primary">Save</button>
	</div>
</div>

<script>
$('body').on('change', '#zone-select', function(e) {
	$target = $(e.target);
	var formData = new FormData($target.closest('form')[0]);

	for (var pair of formData.entries())
		{
		console.log(pair[0] +':' + pair[1]);
		}

	clear();
	$('#zone-id').val($target.val());
	// $('#zone-select').val('null');

	$.ajax({
		type: 'POST',
		url: '/admin/zone_select',
		contentType: false,
		processData: false,
		data: formData,
		success: function(resp) {
			process_rooms(resp);
			}
		});
	});

var $z_levels = 0;
var $last_up = 0;
var $last_down = 0;
var $new_ids = 0;

// PLAN FOR LEVELS:
// Have the PHP sort the rooms and give us a list by levels :)
// Here comes the fun part lol.
function process_rooms(room_list)
	{
	console.log(room_list);
	var unlinks = [];
	Object.keys(room_list).forEach(function(key) {
		var curr_row = 0;
		var curr_col = 0;
		// console.log('Found '+room_list.length);
		var initial_count = room_list[key].length;
		// console.log('Found:'+initial_count);
		var tmp_list = room_list[key].slice(0);
		
		var room_checks = {};
		// Number of times to try to find a room:
		var max_attempts = 30;
		// for(i=0;i<room_list.length;i++)
		// var index = 0;
		// console.log('Processing...');

		while (tmp_list.length > 0)
			{
			// var current_map = 0;
			var selector = '#map_'+key;
			$current_room = null;
			$original_room = null;
			var room = null;
			// console.log(room_list[i]);
			var room = tmp_list.shift();

			// If a room is completely unlinked...???
			if (room && 
				 room.northwest_rooms_id == null && 
				 room.northeast_rooms_id == null &&
				 room.north_rooms_id == null &&
				 room.east_rooms_id == null &&
				 room.west_rooms_id == null &&
				 room.southwest_rooms_id == null &&
				 room.southeast_rooms_id == null &&
				 room.south_rooms_id == null &&
				 room.up_rooms_id == null &&
				 room.down_rooms_id == null)
				{
				console.log(room);
				$('#unlinked-rooms').append('Room: '+room.id+'<br>');
				continue;
				}

			// if (key != 0)
			// 	{
			// 	// Find a room on the map to start at:
			// 	curr_row = $(selector).find('.room').parent().index();
			// 	curr_col = $(selector).find('.room').index();
			// 	}

			console.log(' -- Room '+room.id+' --');
			if (room.uid == 'base_room')
				{
				console.log('Initial room');
				var $current_room = $('.map').find('tr').eq(curr_row).find('td').eq(curr_col);
				$new_room = create_room($current_room, room.id, true);
				$new_room.addClass('start');
				}
			else if ($(selector).find('td#'+room.id).length > 0)
				{
				console.log('Found a room.');
				// var $original_room = $('.map').find('td#'+room.id).first();
				var $current_room = $('.map').find('td#'+room.id).first();
				curr_col = $current_room.index();
				curr_row = $current_room.parent().index();

				if (key != 0 && room.up_rooms_id)
					{
					if ($('.map').find('td#'+room.up_rooms_id).length > 0)
						{
						console.log('Reseting current rows and cols:');
						curr_row = $('.map').find('td#'+room.up_rooms_id).parent().index();
						curr_col = $('.map').find('td#'+room.up_rooms_id).index();
						}
					console.log('Starting up/down at: ['+curr_row+','+curr_col+']');
					var $current_room = $('#map_'+key).find('tr').eq(curr_row).find('td').eq(curr_col);
					}

				if (key != 0 && room.down_rooms_id)
					{
					if ($('.map').find('td#'+room.down_rooms_id).length > 0)
						{
						curr_row = $('.map').find('td#'+room.down_rooms_id).parent().index();
						curr_col = $('.map').find('td#'+room.down_rooms_id).index();
						}
					var $current_room = $('#map_'+key).find('tr').eq(curr_row).find('td').eq(curr_col);
					}
				}
			else if (tmp_list.length == (initial_count-1) && key == 0)
				{
				// TODO: Doesn't exist yet but shouldn't be at 0,0?
				console.log('Initial room');
				var $current_room = $('.map').find('tr').eq(curr_row).find('td').eq(curr_col);
				$new_room = create_room($current_room, room.id, true);
				// $new_room.addClass('start');
				}
			else
				{
				console.log("We don't know what to do with this room.");
				possible_match = checkLinks(room.id);
				if (possible_match)
					{
					console.log('Apparently this room ['+room.id+'] is linked somewhere?')
					// Maybe reset checks here too?
					// This room does link to something on the map, proceed.
					// var $current_room = $('.map').find('td#'+possible_match);
					// maybe????????
					// $new_room = create_room($current_room, room.id, true);
					}
				else
					{
					if (room_checks[room.id])
						{
						room_checks[room.id]++;
						}
					else
						{
						room_checks[room.id] = 1;	
						}

					if (room_checks[room.id] > max_attempts)
						{
						console.log(room);
						console.log('We tried to link Room ['+room.id+'] '+max_attempts+' times, but could not.  Discarding.');
						unlinks.unshift(room.id);
						continue;
						}
					else
						{
						console.log('This room does not link to anything on the map yet.');
						// tmp_list.unshift(room);
						// tmp_list.unshift(room);
						tmp_list.splice(tmp_list.length, 0, room);
						continue;
						}
					}
				}

			// Add values:
			Object.keys(room).forEach(function(wkey) {	
				// Skip these:
				if (wkey == 'created_at' || wkey == 'updated_at')
					{
					// do nothing
					}
				else
					{
					addOrUpdateValue($current_room, wkey, room[wkey]);
					}
				});

			console.log(room);
			console.log('Looking at: ['+curr_col+','+curr_row+']');
			
			if (room && room.northwest_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.northwest_rooms_id).length == 0 )
					{
					if (curr_row - 1 <= 0)
						{
						addRow(true);
						curr_row++;
						}
					if (curr_col - 1 <= 0)
						{
						addCol(true);
						curr_col++;
						}
					console.log('Adding a NW ['+room.northwest_rooms_id+'] room at: ['+curr_col+','+curr_row+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row - 1).find('td').eq(curr_col - 1);
					var $target = $(selector).find('tr').eq(curr_row - 1).find('td').eq(curr_col - 1);
					if ($target.hasClass('room'))
						{
						// TODO: Not ready yet!
						// var $peek = $('.map').find('tr').eq(curr_row - 2).find('td').eq(curr_col - 2);
						// if ($peek.hasClass('room'))
						// 	{
						// 	$target.append('<br>'+room.northwest_rooms_id);
						// 	$target.addClass('multiple-rooms');
						// 	}
						// else
						// 	{
						// 	$new_room = create_room($peek, room.northwest_rooms_id, true);
						// 	$new_room.addClass('dislocated');
						// 	}
						}
					else
						{
						$new_room = create_room($target, room.northwest_rooms_id, true);
						}
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'northwest_rooms_id', room.northwest_rooms_id);
				}

			if (room && room.north_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.north_rooms_id).length == 0 )
					{
					if (curr_row - 1 <= 0)
						{
						addRow(true);
						curr_row++;
						}
					console.log('Adding a N ['+room.north_rooms_id+'] room at: ['+curr_col+','+curr_row+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row - 1).find('td').eq(curr_col);
					var $target = $(selector).find('tr').eq(curr_row - 1).find('td').eq(curr_col);
					$new_room = create_room($target, room.north_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'north_rooms_id', room.north_rooms_id);
				}

			if (room && room.northeast_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.northeast_rooms_id).length == 0 )
					{
					if (curr_row - 1 <= 0)
						{
						addRow(true);
						curr_row++;
						}
					if (curr_col + 1 >= $(selector).find('tr').first().find('td').length)
						{
						addCol();
						// curr_col++;
						}
					console.log('Adding a NE ['+room.northeast_rooms_id+'] room at: ['+curr_col+','+curr_row+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row - 1).find('td').eq(curr_col + 1);
					var $target = $(selector).find('tr').eq(curr_row - 1).find('td').eq(curr_col + 1);
					$new_room = create_room($target, room.northeast_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'northeast_rooms_id', room.northeast_rooms_id);
				}

			if (room && room.west_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.west_rooms_id).length == 0 )
					{
					if (curr_col - 1 <= 0)
						{
						addCol(true);
						curr_col++;
						}
					console.log('Adding a W ['+room.west_rooms_id+'] room at: ['+curr_row+','+curr_col+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row).find('td').eq(curr_col - 1);
					var $target = $(selector).find('tr').eq(curr_row).find('td').eq(curr_col - 1);
					$new_room = create_room($target, room.west_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'west_rooms_id', room.west_rooms_id);
				}

			if (room && room.east_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.east_rooms_id).length == 0 )
					{
					if (curr_col + 1 >= $(selector).find('tr').first().find('td').length)
						{
						addCol();
						// curr_col++;
						}
					console.log('Adding a E ['+room.east_rooms_id+'] room at: ['+curr_row+','+curr_col+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row).find('td').eq(curr_col + 1);
					var $target = $(selector).find('tr').eq(curr_row).find('td').eq(curr_col + 1);
					$new_room = create_room($target, room.east_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'east_rooms_id', room.east_rooms_id);
				}

			if (room && room.southwest_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.southwest_rooms_id).length == 0 )
					{
					if (curr_row + 1 >= $(selector).find('tr').length)
						{
						addRow();
						// curr_row++;
						}
					if (curr_col - 1 <= 0)
						{
						addCol(true);
						curr_col++;
						}
					console.log('Adding a SW ['+room.southwest_rooms_id+'] room at: ['+curr_col+','+curr_row+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row + 1).find('td').eq(curr_col - 1);
					var $target = $(selector).find('tr').eq(curr_row + 1).find('td').eq(curr_col - 1);
					$new_room = create_room($target, room.southwest_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'southwest_rooms_id', room.southwest_rooms_id);
				}

			if (room && room.south_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.south_rooms_id).length == 0 )
					{
					if (curr_row + 1 >= $(selector).find('tr').length)
						{
						addRow();
						// curr_row++;
						}
					console.log('Adding a S ['+room.south_rooms_id+'] room at: ['+curr_row+','+curr_col+']');
					// Now we can add the room:
					// var $current_room = $('.map').find('tr').eq(curr_row + 1).find('td').eq(curr_col);
					var $target = $(selector).find('tr').eq(curr_row + 1).find('td').eq(curr_col);
					$new_room = create_room($target, room.south_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'south_rooms_id', room.south_rooms_id);
				}

			if (room && room.southeast_rooms_id != null)
				{
				// Room already exists?
				if ($(selector).find('td#'+room.southeast_rooms_id).length == 0 )
					{
					if (curr_row + 1 >= $(selector).find('tr').length)
						{
						addRow();
						// curr_row++;
						}
					if (curr_col + 1 >= $(selector).find('tr').first().find('td').length)
						{
						addCol();
						// curr_col++;
						}
					console.log('Adding a SE ['+room.southeast_rooms_id+'] room at: ['+(curr_row+1)+','+(curr_col+1)+']');
					// Now we can add the room:
					var $target = $(selector).find('tr').eq(curr_row + 1).find('td').eq(curr_col + 1);
					$new_room = create_room($target, room.southeast_rooms_id, true);
					}
				else
					{
					// unk_room = false;
					}
				createLink($current_room, 'southeast_rooms_id', room.southeast_rooms_id);
				}

			// Grand finale of directions:
			if (room && room.up_rooms_id != null)
				{
				if ($('#map_'+(parseInt(key) +1)).length == 0)
					{
					console.log('map_'+(parseInt(key)+1)+' does not exist, creating.');
					added_level = addZLevel(1);
					}

				if ($(selector).find('td#'+room.up_rooms_id).length == 0)
					{
					var $target = $('#map_'+(parseInt(key)+1)).find('tr').eq(curr_row).find('td').eq(curr_col);
					$new_room = create_room($target, room.up_rooms_id, true);
					}
				else
					{
					// ??
					}
				console.log('Linking UP at: ['+$current_room.parent().index()+','+$current_room.index()+']');
				createLink($current_room, 'up_rooms_id', room.up_rooms_id);
				}

			if (room && room.down_rooms_id != null)
				{
				if ($('#map_'+(parseInt(key) -1)).length == 0)
					{
					added_level = addZLevel(-1);
					}

				if ($(selector).find('td#'+room.down_rooms_id).length == 0)
					{
					var $target = $('#map_'+(parseInt(key)-1)).find('tr').eq(curr_row).find('td').eq(curr_col);
					$new_room = create_room($target, room.down_rooms_id, true);
					}
				else
					{
					// ??
					}
				createLink($current_room, 'down_rooms_id', room.down_rooms_id);
				}


			// END OF CHECKS:
			// If we've linked something, reset the stalemate check:
			console.log('Reset checks?');
			room_checks = {};
			}
		});

	for(x=0;x<unlinks.length;x++)
		{
		$('#unlinked-rooms').append('Room: '+unlinks[x]+'<br>');
		result = checkLinks(unlinks[x]);
		if (result)
			{
			console.log('Room ['+unlinks[x]+'] does link somewhere!');
			}
		}

	// TODO: Just do this for now:
	console.log('Nuking these:')
	$('.map td.room:not([data-zones_id]) input').remove();
	}

var BASE_OBJECT = {
	'id': null,
	'zones_id': null,
	'zone_areas_id': null,
	'zone_level': null,
	'uid': null,
	'title': null,
	'north_rooms_id': null,
	'south_rooms_id': null,
	'east_rooms_id': null,
	'west_rooms_id': null,
	'northeast_rooms_id': null,
	'southeast_rooms_id': null,
	'southwest_rooms_id': null,
	'northwest_rooms_id': null,
	'up_rooms_id': null,
	'down_rooms_id': null,
	};

// Realistically, I could shorten this because you could just flip whether you look at the key or value.
var DIRECTION_MAP = {
	'north_rooms_id': 'south_rooms_id',	
	'east_rooms_id': 'west_rooms_id',
	'south_rooms_id': 'north_rooms_id',
	'west_rooms_id': 'east_rooms_id',
	'northeast_rooms_id': 'southwest_rooms_id',
	'southeast_rooms_id': 'northwest_rooms_id',
	'southwest_rooms_id': 'northeast_rooms_id',
	'northwest_rooms_id': 'southeast_rooms_id',
	'up_rooms_id': 'down_rooms_id',
	'down_rooms_id': 'up_rooms_id',
	};

function checkLinks(id)
	{
	$found_at = null;
	$('.map').find('td[id]').each(function(i,e)	{
		Object.keys(DIRECTION_MAP).forEach(function(key) {
			if ($(e).attr('data-'+key) == id)
				{
				$found_at = $(e).attr('id');
				}
			});
		});
	return $found_at;
	}

function findNearestOpen($room)
	{
	return true;
	}

// TODO: Data necessary?
function create_room($room, id, in_database = false)
	{
	// var $room = $('.map').find('tr').eq(row).find('td').eq(col);
	if (!$room.hasClass('room'))
		{
		$room.addClass('room');
		// TODO: Detect that it's already in the DB:
		if (in_database)
			{
			$room.addClass('existing-room');
			}
		$room.append(id);
		$room.attr('id', id);
		$room.attr('data-zone_level', $room.closest('.map').attr('data-zone_level'));
		// Set up the hidden values tracker:
		addOrUpdateValue($room, 'id', id);
		}
	// Return false if something breaks?
	return $room;
	}

function createLink($room, direction, value)
	{
	if (!$room)
		{
		return true;
		}
	addOrUpdateValue($room, direction, value);

	// Value should be another room's id, but may not be created yet:
	if ($('.map td#'+value).length > 0)
		{
		// It has been created, update it's link as well:
		$target = $('.map td#'+value);
		addOrUpdateValue($target, DIRECTION_MAP[direction], $room.attr('id'));
		}

	return true;
	}

function removeLink($room, direction)
	{
	if (!$room)
		{
		return true;
		}
	$target = $('.map td#'+getValue($room, direction));
	addOrUpdateValue($room, direction, null);
	addOrUpdateValue($target, DIRECTION_MAP[direction], null);
	}

function getValue($room, field)
	{
	var id = $room.attr('id');
	if ($room.find('input.hidden-vals').length > 0)
		{
		var val_str = $('input.hidden-vals#hidden_'+id).val();
		var hash = JSON.parse(val_str);
		return hash[field];
		}
	return false
	}

// function removeValue($room, field)
// 	{
// 	if (!$room)
// 		{
// 		return true;
// 		}
// 	$room.removeAttr('data-'+field);
// 	addOrUpdateValue($room, field, null);
// 	return true;
// 	}

function addOrUpdateValue($room, field, value)
	{
	if (!$room)
		{
		return true;
		}
	// Always give the room the data attrib:
	$room.attr('data-'+field, value);
	var current_level = $room.closest('.map').attr('data-zone_level');
	// console.log('level: '+$room.attr('data-zone_level'));
	var id = $room.attr('id');
	var submit_name = 'new_rooms';
	if ($room.hasClass('existing-room'))
		{
		submit_name = 'existing_rooms';
		}
	
	if ($room.find('input.hidden-vals#hidden_'+id).length > 0)
		{
		// Get the matching hidden:
		var val_str = $('input.hidden-vals#hidden_'+id).val();
		var hash = JSON.parse(val_str);
		hash[field] = value;
		$('input.hidden-vals#hidden_'+id).val(JSON.stringify(hash));
		}
	else
		{
		// We haven't added a value before for this element & set:
		var hash = $.extend({}, BASE_OBJECT);
		hash[field] = value;
		$('<input/>', {type: 'hidden', id: 'hidden_'+id, name: submit_name+'['+current_level+']['+id+'][data]', "class": 'hidden-vals', value: JSON.stringify(hash)}).appendTo($room);
		}
	return true;
	}
  
function start()
	{
	$new_ids = 0;
	// start canvas:
	height = 2;
	width = 2;

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
	if ($td.hasClass('dislocated'))
		{
		$insert.append('<br>This room is NOT displayed on the map correctly due to room overlap!<br>');
		}

	if ($('input#hidden_'+$td.attr('id')).length > 0)
		{
		$insert.append($('<label/>').append('Room <a href="/room/edit/'+$td.attr('id')+'" target="new">'+$td.attr('id')+'</a>'));
		$insert.append('<br>');
		Object.keys(BASE_OBJECT).forEach(function(key) {
			if (key != 'id' && key != 'zones_id')
				{
				$insert.append(key);
				// $td.attr('data-'+key)
				$insert.append($('<input/>', {id: key, name: key, value: getValue($td, key)}));
				$insert.append('<br>');
				}
			});
		}
	else
		{
		$insert.append('This Room is from another zone.');
		}
	$('#room-info').html($insert);
	}
  
$('body').on('click', '.clear-map', function(e) {
	clear();
	});

function clear()
	{
	$('table:not([id="map_0"])').remove();
	$('#map_0').show();
	$('.map tbody').html('');
	$('#unlinked-rooms').html('');
	$('.map').css({width: ''});
	$z_levels = 0;
	$last_up = 0;
	$last_down = 0;
	start();
	}

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

function addRow(before = false)
	{
	var $new = $('.map').find('tr').last().clone();
	$cols = $('.map').find('tr').last().find('td').length;
	$tr = $('<tr/>');
	for(i=0;i<$cols;i++)
		{
		$cell = $('<td/>');
		$cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
		$tr.append($cell);
		}
	if (before)
		{
		$('.map tbody').prepend($tr);
		}
	else
		{
		$('.map tbody').append($tr);
		}
	return true;
	}
  
$('body').on('click', '.add-column', function(e) { 
	$('.map tbody tr').each(function(i,e) {
		$cell = $('<td/>');
		$cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
		$(e).append($cell);
		});

	// map width doesn't work if the float is displaying???
	if ($('.map').width() > $('.map-wrapper').width() - 50)
		{
		$('.map').css({width: '100%'});
		}
	});

function addCol(before = false)
	{
	$('.map tbody tr').each(function(i,e) {
		$cell = $('<td/>');
		$cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');

		if (before)
			{
			$(e).prepend($cell);
			}
		else
			{
			$(e).append($cell);
			}
		});

	// map width doesn't work if the float is displaying???
	if ($('.map').width() > $('.map-wrapper').width() - 50)
		{
		$('.map').css({width: '100%'});
		}
	}
  
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

	// row_indexes = [-1, 0, 1];
	// map = {
	// 	-1: 0,
	// 	0: -1, 1
	// 	1: 0
	// }

	// console.log('searching Adjacents');

	for(i=0;i<indexes.length;i++)
		{
		if (parent_start + indexes[i] < 0)
			{
			continue;
			}
		$parent = $($('.map:visible').find('tr')[parent_start + indexes[i]]);
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
				if ((i == -1 && x == 0) ||
					(i == 0 && x == -1) || 
					(i == 0 && x == 1) ||
					(i == 1 && x == 0)
					)
					{
					performLink($el, $room);
					}
					
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
	}

function linkUp()
	{
	var $selection = $('.highlight:visible');
	if ($selection.length == 0)
		{
		return false;
		}
	var row = $selection.parent().index();
	var col = $selection.index();
	var current_level = $selection.closest('.map').attr('data-zone_level');
	var next_level = parseInt(current_level) + 1;
	console.log('next_level: '+next_level);
	if ($('#map_'+next_level).length == 0)
		{
		addZLevel(1);
		}
	var $target_room = $('#map_'+next_level).find('tr').eq(row).find('td').eq(col);
	create_room($target_room, $new_ids);
	$new_ids++;
	performLink($selection, $target_room);
	$selection.removeClass('highlight');
	$target_room.addClass('highlight');
	switchZLevel(1);
	}

function linkDown()
	{
	var $selection = $('.highlight:visible');
	if ($selection.length == 0)
		{
		return false;
		}
	var row = $selection.parent().index();
	var col = $selection.index();
	var current_level = $selection.closest('.map').attr('data-zone_level');
	var next_level = parseInt(current_level) - 1;
	console.log('next_level: '+next_level);
	if ($('#map_'+next_level).length == 0)
		{
		addZLevel(-1);
		}
	var $target_room = $('#map_'+next_level).find('tr').eq(row).find('td').eq(col);
	create_room($target_room, $new_ids);
	$new_ids++;
	performLink($selection, $target_room);
	$selection.removeClass('highlight');
	$target_room.addClass('highlight');
	switchZLevel(-1);
	}


function switchZLevel($int)
	{
	console.log("let's switch levels!");
	$current_map = $('.map:visible');
	console.log($current_map);
	$current_level = $current_map.attr('data-zone_level');
	var search = parseInt($current_level) + $int;
	console.log('looking for: '+ search);
	if ($('#map_'+search).length > 0)
		{
		console.log("it existed, let's go?");
		$current_map.hide();
		$('#map_'+search).show();
		$('.level-view').html('Viewing level: '+ (search - $z_levels) );
		}
	return true;
	}

function addZLevel($int)
	{
	var new_level = null;
	if ($int > 0)
		{
		$last_up++;
		// Careful of assignment here:
		new_level = $last_up;
		}
	else
		{
		$last_down--;
		new_level = $last_down;
		}
	console.log('gogo gadget!');
	$new_map = $('#map_0').clone();
	$new_map.removeAttr('id');
	$new_map.removeAttr('data-zone_level');
	$new_map.attr('id', 'map_'+new_level);
	$new_map.attr('data-zone_level', new_level);
	// Blast the current data:
	var height = $new_map.find('tr').length;
	var width = $new_map.find('tr').first().find('td').length;
	$new_map.find('tbody').html('');
	for(i=0;i<height;i++)
		{
		$tr = $('<tr/>');
		for(x=0;x<width;x++)
			{
			$td = $('<td/>');
			$tr.append($td);
			}
		$new_map.find('tbody').append($tr);
		}
		$new_map.find('td').each(function(i,e) {
			$(e).append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
		});
	// $('map-wrapper').append($('.map').clone());
	// $('#map_0').hide();
	// $('.level-view').html('Viewing level: '+ (new_level - $z_levels) );
	$('.map-wrapper form').append($new_map);
	$new_map.hide();
	return new_level;
	}

// Not needed yet:
// document.getElementById('map_0').addEventListener("wheel", event => {
// 	 const delta = Math.sign(event.deltaY);
// 	 if (delta == -1)
// 		{
// 		$('.map').animate({ 'zoom': 1 }, {'queue': false});
// 		}
// 	 else
// 		{
// 		$('.map').animate({ 'zoom': .65 }, {'queue': false});
// 		}
// }); 

$('body').on('contextmenu', '.map td', function(e) { 
	$target = $(e.target);
	if ($target.hasClass('room'))
		{
		$selection = $('.map td.highlight');
		var result = performLink($selection, $target, true);
		if (result)
			{
			select_room($target);
			}
		return false;
		}

	create_room($target, $new_ids);
	if ($('.room').length == 1)
		{
		addOrUpdateValue($target, 'title', 'entrance');
		}

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
		console.log('Perfoming Link');

		if ($current.attr('id') == $target.attr('id'))
			{
			return false;
			}

		if ($current.index() == $target.index())
			{
			if ($target.parent().index() == $current.parent().index())
				{
				// Then this could go up or down:
				if (parseInt($selected.closest('.map').attr('data-zone_level')) > parseInt($target.closest('.map').attr('data-zone_level')))
					{
					// Down
					createLink($current, 'down_rooms_id', $target.attr('id'));
					}
				else
					{
					// Up
					createLink($current, 'up_rooms_id', $target.attr('id'));
					}
				}
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

		// TODO: Switch to allow if up/down links:
		if ($selected.attr('data-zone_level') != $target.attr('data-zone_level'))
			{
			// Don't link across z-levels
			return false;
			}
		// TODO: Make it smarter!
		// left or right?
		if ($current.index() == $target.index())
			{
			// north or south:
			if ($target.parent().index() > $current.parent().index())
				{
				if (getValue($current, 'south_rooms_id') && $reverse)
					{
					removeLink($current, 'south_rooms_id');
					}
				else
					{
					createLink($current, 'south_rooms_id', $target.attr('id'));
					}
				}
			else
				{
				if (getValue($current, 'north_rooms_id') && $reverse)
					{
					removeLink($current, 'north_rooms_id');
					}
				else
					{
					createLink($current, 'north_rooms_id', $target.attr('id'));
					}
				}
			}
		else if ($current.index() > $target.index())
			{
			// west
			if ($target.parent().index() == $current.parent().index())
				{
				if (getValue($current, 'west_rooms_id') && $reverse)
					{
					removeLink($current, 'west_rooms_id');
					}
				else
					{
					createLink($current, 'west_rooms_id', $target.attr('id'));
					}
				}
			else if ($target.parent().index() > $current.parent().index())
				{
				if (getValue($current, 'southwest_rooms_id') && $reverse)
					{
					removeLink($current, 'southwest_rooms_id');
					}
				else
					{
					createLink($current, 'southwest_rooms_id', $target.attr('id'));
					}
				}
			else
				{
				if (getValue($current, 'northwest_rooms_id') && $reverse)
					{
					removeLink($current, 'northwest_rooms_id');
					}
				else
					{
					createLink($current, 'northwest_rooms_id', $target.attr('id'));
					}
				}
			}
		else
			{
			// east
			if ($target.parent().index() == $current.parent().index())
				{
				if (getValue($current, 'east_rooms_id') && $reverse)
					{
					removeLink($current, 'east_rooms_id');
					}
				else
					{
					createLink($current, 'east_rooms_id', $target.attr('id'));
					}
				}
			else if ($target.parent().index() > $current.parent().index())
				{
				if (getValue($current, 'southeast_rooms_id') && $reverse)
					{
					removeLink($current, 'southeast_rooms_id');
					}
				else
					{
					createLink($current, 'southeast_rooms_id', $target.attr('id'));
					}
				}
			else
				{
				if (getValue($current, 'northeast_rooms_id') && $reverse)
					{
					removeLink($current, 'northeast_rooms_id');
					}
				else
					{
					createLink($current, 'northeast_rooms_id', $target.attr('id'));
					}
				} 
			}
		/* $(e.target).removeClass('room'); */
		return true;
		}
	}

$('#room-info').on('change', 'input', function(e) {
	field = $(e.target).attr('name');
	value = $(e.target).val();
	room = $(e.target).parent().data('id');
	if (value == '')
		{
		addOrUpdateValue($('.map td#'+room), field, null);
		}
	else
		{
		addOrUpdateValue($('.map td#'+room), field, value);
		}
	});
</script>
@endsection