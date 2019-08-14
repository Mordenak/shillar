<html>
	<head>
		<title>App Name - @yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>

		<style>
		body
			{
			background-color: #111;
			color: white;
			}

		form label
			{
			color: #55ff8b;
			cursor: pointer;
			}

		.game-container
			{
			display: grid;
			grid-template-areas:
				'menu main'
				'footer footer';
			grid-template-columns: 20% auto;
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
			text-align: center;
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

		form
			{
			margin-block-end: 0px;
			}

		label
			{
			text-decoration: underline;
			color: blue;
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
			background: #d43333;s
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
		</style>
	</head>
	<body>

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
			// console.log('main ajax submit fire');
			e.preventDefault();
			var formData = new FormData(e.target);
			// console.log($(document.activeElement));
			if ($(document.activeElement).hasClass('submit-val'))
				{
				formData.append('submit', $(document.activeElement).val());
				}

			$(document.activeElement).attr('disabled', 'disabled');

			for (var pair of formData.entries())
				{
				// console.log(pair[0] +':' + pair[1]);
				}

			$.ajax({
				type: 'POST',
				url: $(e.target).attr('action'),
				contentType: false,
				processData: false,
				data: formData,
				success: function(resp) {
					var main_inserts = [
						'/train',
						'/train_stat',
						'/rest'
						];
					var menu_inserts = [
						'/equipment',
						'/items'
						];
					var replace = '.game-container';
					if (main_inserts.includes(this['url']))
						{
						replace = '.main';
						}
					if (menu_inserts.includes(this['url']))
						{
						replace = '.menu';
						}

					if (this['url'] == '/game' || this['url'] == '/move' || this['url'] == '/combat' || this['url'] == '/item_pickup')
						{
						console.log('what');
						$('.menu').html(resp.menu);
						$('.main').html(resp.main);
						$('.footer').html(resp.footer);
						}
					else
						{
						$(replace).html(resp);
						}
					}
				});
			// console.log('done?');
			});
		</script>
	</body>
</html>