<html>
	<head>
		<title>Shillar - @yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- jQuery -->
		<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

		<!-- jQuery ui -->
		<link rel="stylesheet" href="{{asset('jquery-ui-1.12.1/jquery-ui.min.css')}}">
		<script src="{{asset('jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
		
		<!-- FontAwesome -->
		<link rel="stylesheet" href="{{asset('fontawesome-free-5.10.2-web/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome-free-5.10.2-web/css/solid.min.css')}}">
		<script src="{{asset('fontawesome-free-5.10.2-web/js/fontawesome.min.js')}}"></script>

		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		var $timers = {};
		</script>

		<style>
		body
			{
			background-color: #111;
			color: white;
			}

		form
			{
			margin-block-end: 0px;
			}

		label
			{
			text-decoration: underline;
			color: blue;
			}

		form label
			{
			color: #55ff8b;
			cursor: pointer;
			}

		form label.disabled
			{
			color: #CCC;
			text-decoration: none;
			}

		.game-container
			{
			display: grid;
			grid-template-areas:
				'menu main'
				'footer footer';
			grid-template-columns: 12.5rem auto;
			grid-gap: .25rem;
			}

		.game-container > div
			{
			border: 1px solid black;
			/*height: 100px;*/
			min-height: 100px;
			padding: .5rem;
			}

		.game-container .menu
			{
			grid-area: menu;
			min-height: 500px;
			/*text-align: center;*/
			overflow-x: scroll;
			}

		.game-container .menu header
			{
			font-weight: bold;
			border-bottom: 1px solid #ccc;
			}

		.game-container .menu ul
			{
			/*text-align: left;*/
			list-style: none;
			padding: 0;
			margin: 0;
			}

		.game-container .main
			{
			grid-area: main;
			}

		.game-container .footer
			{
			grid-area: footer;
			}

		.stat-bar
			{
			-webkit-appearance: none;
			appearance: none;
			border: 1px solid #bbb;
			height: .3rem;
			}

		.stat-bar::-webkit-progress-bar
			{
			background: transparent;
			}

		.stat-bar-health::-webkit-progress-value
			{
			/*background: #33d433;*/
			background: #d43333;
			}

		.stat-bar-health.__low::-webkit-progress-value
			{
			background: #d43333;
			}

		.stat-bar-mana::-webkit-progress-value
			{
			background: blue;
			}

		.stat-bar-fatigue::-webkit-progress-value
			{
			background: gray;
			}

		.all_out
			{
			color: yellow;
			}
		.single
			{
			color: #55ff8b;
			}
		.flee
			{
			color: red;
			}

		#combat-table td
			{
			padding: .5rem;
			}

		.chat-room
			{
			width: 100%;
			border: 1px solid white;
			}

		.chat-room td
			{
			border: 1px solid #999;
			padding: .1rem;
			}

		.chat-room td.fit-width
			{
			width: 1%;
			white-space: nowrap;
			}

		</style>
	</head>
	<body>
		<script>
			function randomize(hash)
				{
				var ret_hash = {};

				var arr = Object.keys(hash);
				var new_arr = shuffle(arr);
				
				for (i=0;i<new_arr.length;i++)
					{
					ret_hash[new_arr[i]] = hash[new_arr[i]];
					}

				return ret_hash;
				}

			function shuffle(array) 
				{
				var currentIndex = array.length, temporaryValue, randomIndex;

				// While there remain elements to shuffle...
				while (0 !== currentIndex) 
					{
					// Pick a remaining element...
					randomIndex = Math.floor(Math.random() * currentIndex);
					currentIndex -= 1;
					// And swap it with the current element.
					temporaryValue = array[currentIndex];
					array[currentIndex] = array[randomIndex];
					array[randomIndex] = temporaryValue;
					}

				return array;
				}

			function combat_shuffle(creature)
				{
				var $options = {
					all_out: 'All Out Attack',
					single: 'Single Attack',
					flee: 'Run Away'
					};

				var $new_options = randomize($options);

				for (var key in $new_options)
					{
					if (Math.random() > 0.5)
						{
						var $cell = $('<td/>', {"class": key});
						$cell.append($new_options[key]+'<br>');
						$cell.append($('<input/>', {type: 'submit', id: key, "class": 'submit-id', value: creature}));
						$('#combat-table tr').append($cell);
						}
					else
						{
						var $cell = $('<td/>', {"class": key});
						$cell.append($('<input/>', {type: 'submit', id: key, "class": 'submit-id', value: creature}));
						$cell.append('<br>'+$new_options[key]);
						$('#combat-table tr').append($cell);
						}
					}
				}
		</script>

		<div class="game-container">
			<div class="menu">
				@yield('menu')
			</div>

			<div class="main">
				@yield('main')
			</div>

			<div class="footer">
				@yield('footer')
			</div>
		</div>

		<script>
		$('body').on('submit', 'form.ajax', function(e, i) {
			e.preventDefault();

			var main_exceptions = [
				// '/teleport',
				];

			var menu_inserts = [
				'/equipment',
				'/food',
				'/show_stats',
				'/menu',
				'/settings',
				'/character/update_settings'
				];

			var footer_inserts = [
				'/chat/message',
				'/footer'
				];

			var formData = new FormData(e.target);

			if ($(document.activeElement).hasClass('submit-val'))
				{
				formData.append('submit', $(document.activeElement).val());
				}

			if ($(document.activeElement).hasClass('submit-id'))
				{
				formData.append('submit', $(document.activeElement).attr('id'));
				}

			$(e.target).find('input,select').attr('disabled', 'disabled');

			if (!main_exceptions.includes($(e.target).attr('action')) && 
				 !menu_inserts.includes($(e.target).attr('action')) &&
				 !footer_inserts.includes($(e.target).attr('action'))
				 )
				{
				if ($timers.combat)
					{
					console.log('clearing');
					clearTimeout($timers.combat);
					}
				}

			// Direct submit:
			// $combatTimer = false;

			$.ajax({
				type: 'POST',
				url: $(e.target).attr('action'),
				contentType: false,
				processData: false,
				data: formData,
				success: function(resp) {

					$('input:disabled,select:disabled').removeAttr('disabled');

					if (this['url'] == '/spells' || this['url'] == '/game/teleport')
						{
						$('.main').html(resp.main);
						$('.menu').html(resp.menu);
						return true;
						}

					// var replace = '.game-container';
					// console.log(this['url']);
					// if (main_inserts.includes(this['url']))
					if (!main_exceptions.includes(this['url']) && !menu_inserts.includes(this['url']) && !footer_inserts.includes(this['url']))
						{
						// replace = '.main';
						console.log('replace main');
						if (resp.main)
							{
							$('.main').html(resp.main);
							}
						else
							{
							$('.main').html(resp);
							}
						}
					if (menu_inserts.includes(this['url']))
						{
						// replace = '.menu';
						console.log('replace menu');
						$('.menu').html(resp);
						}
					if (footer_inserts.includes(this['url']))
						{
						console.log('replace footer');
						$('.footer').html(resp);
						}
					// some type of full page reload:
					// Probably a shit idea... REAL shit, whoops!
					// $('body').html(resp);
					}
				});
			});
		</script>
	</body>
</html>