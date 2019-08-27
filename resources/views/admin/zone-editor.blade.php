@extends('layouts.admin')

@section('content')

<style>
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

.map td[data-north] .n-blip
	{
	display: block;
	}

.map td[data-northeast] .ne-blip
	{
	display: block;
	}

.map td[data-northwest] .nw-blip
	{
	display: block;
	}

.map td[data-east] .e-blip
	{
	display: block;
	}
  
.map td[data-south] .s-blip
	{
	display: block;
	}

.map td[data-southeast] .se-blip
	{
	display: block;
	}

.map td[data-southwest] .sw-blip
	{
	display: block;
	}

.map td[data-west] .w-blip
	{
	display: block;
	}

.blip
	{
	display: none;
	width: 4px;
	height: 4px;
	background-color: red;
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
<div class="form-group row">
	<div class="col-md-3">
		<div id="room-info" style="display:none;">

		</div>
	</div>
	<div class="col">
		<a href="#" class='add-row'>Add Row</a>
		<a href="#" class="add-column">Add Column</a>
		<form>
			<table id="map" class="map">

				<thead>
				<!-- track sizing here? -->
				</thead>

				<tbody>
				</tbody>

			</table>
		</form>
	</div>
</div>
<script>
var $new_ids = 0;

function start()
	{
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
	}

start();

$('.map td').each(function(i,e) {
	$(e).append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
	});

function show_room($td)
	{
	var $insert = $('<div/>', {"class": 'insert', 'data-id': $td.attr('id')});
	$insert.append($('<label/>').append('Room '+$td.attr('id')));
	$insert.append('<br>');
	$insert.append('N:');
	$insert.append($('<input/>', {name: 'north', value: $td.data('north')}));
	$insert.append('<br>');
	$insert.append('E:');
	$insert.append($('<input/>', {name: 'east', value: $td.data('east')}));
	$insert.append('<br>');
	$insert.append('S:');
	$insert.append($('<input/>', {name: 'south', value: $td.data('south')}));
	$insert.append('<br>');
	$insert.append('W:');
	$insert.append($('<input/>', {name: 'west', value: $td.data('west')}));
	$insert.append('<br>');
	$insert.append('NE:');
	$insert.append($('<input/>', {name: 'northeast', value: $td.data('northeast')}));
	$insert.append('<br>');
	$insert.append('SE:');
	$insert.append($('<input/>', {name: 'southeast', value: $td.data('southeast')}));
	$insert.append('<br>');
	$insert.append('SW:');
	$insert.append($('<input/>', {name: 'southwest', value: $td.data('southwest')}));
	$insert.append('<br>');
	$insert.append('NW:');
	$insert.append($('<input/>', {name: 'northwest', value: $td.data('northwest')}));
	$insert.append('<br>');
	$insert.append('Up:');
	$insert.append($('<input/>', {name: 'up', value: $td.data('up')}));
	$insert.append('<br>');
	$insert.append('Down:');
	$insert.append($('<input/>', {name: 'down', value: $td.data('down')}));
	$('#room-info').html($insert);
	$('#room-info').show();
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
  
$('body').on('click', '.add-column', function(e) { 
  $('.map tbody tr').each(function(i,e) {
  	$cell = $('<td/>');
    $cell.append('<div class="blip nw-blip"></div><div class="blip n-blip"></div><div class="blip ne-blip"></div><div class="blip e-blip"></div><div class="blip w-blip"></div><div class="blip se-blip"></div><div class="blip s-blip"></div><div class="blip sw-blip"></div>');
  	$(e).append($cell);
  	});
    
	if ($('.map').width() > 600)
		{
		$('.map').css({width: '100%'});
		}
  });

$('body').on('click', '.map td', function(e) { 
	/* $('.map').append($('<div/>', {"class": 'child'})); */
  $('.map td').removeClass('highlight');
  $(e.target).addClass('highlight');
  
  if ($(e.target).hasClass('room'))
  	{
    show_room($(e.target));
    }
  	
});

document.getElementById('map').addEventListener("wheel", event => {
    const delta = Math.sign(event.deltaY);
    if (delta == -1)
    	{
			$('.map').animate({ 'zoom': 2 }, {'queue': false});
      }
    else
    	{
      $('.map').animate({ 'zoom': 1 }, {'queue': false});
      }
});

$('body').on('contextmenu', '.map td', function(e) { 
	/* $('.map').append($('<div/>', {"class": 'child'})); */
  if ($(e.target).hasClass('room'))
  	{
    if ($('.map td.highlight').length > 0)
    	{
      $current = $('.map td.highlight');
      $target = $(e.target);
      
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
      // left or right?
      if ($current.index() == $target.index())
      	{
	      // north or south:
        if ($target.parent().index() > $current.parent().index())
        	{
          // south
          $current.attr('data-south', $target.attr('id'));
          $target.attr('data-north', $current.attr('id'));
          }
        else
        	{
          // north
          $current.attr('data-north', $target.attr('id'));
          $target.attr('data-south', $current.attr('id'));
          }
        }
      else if ($current.index() > $target.index())
      	{
        // west
        if ($target.parent().index() == $current.parent().index())
        	{
          // due west
          $current.attr('data-west', $target.attr('id'));
          $target.attr('data-east', $current.attr('id'));
          }
        else if ($target.parent().index() > $current.parent().index())
        	{
          // sw
          $current.attr('data-southwest', $target.attr('id'));
          $target.attr('data-northeast', $current.attr('id'));
          }
        else
        	{
          // nw
          $current.attr('data-northwest', $target.attr('id'));
          $target.attr('data-southeast', $current.attr('id'));
          }
        }
      else
        {
        // east
        if ($target.parent().index() == $current.parent().index())
        	{
          // due east
          $current.attr('data-east', $target.attr('id'));
          $target.attr('data-west', $current.attr('id'));
          }
        else if ($target.parent().index() > $current.parent().index())
        	{
          // se
          $current.attr('data-southeast', $target.attr('id'));
          $target.attr('data-northwest', $current.attr('id'));
          }
        else
        	{
          // ne
          $current.attr('data-northeast', $target.attr('id'));
          $target.attr('data-southwest', $current.attr('id'));
          } 
        }
      }
    /* $(e.target).removeClass('room'); */
  	return false;
    }

  $('.map td').removeClass('highlight');
  $(e.target).addClass('room');
  $(e.target).attr('id', $new_ids);
  $(e.target).append($new_ids);
  $(e.target).append($('<input/>', {type: 'hidden', name: 'new_rooms['+$new_ids+']'}));
  $new_ids++;
  return false;
});

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
    }
  // flip it?
});
</script>
@endsection