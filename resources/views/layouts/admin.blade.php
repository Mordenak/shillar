<html>
	<head>
		<title>Shillar Admin Panel - @yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

		<!-- jquery ui -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

		<link href="{{ asset('css/app.css') }}" rel="stylesheet">

		<style>
		body a
			{
			color: #55ff8b;
			}

		table.dataTable tbody tr
			{
			background-color: #333;
			}
		</style>
	</head>
	<body style="background-color: #222;color:white;">

		@if (auth()->user()->admin_level >= 1)
		@section('sidebar')
			This is the master sidebar.
		@show

        
        @if (Session::has("success"))
        <div class="alert alert-success alert-block" role="alert">
            <button class="close" data-dismiss="alert"></button>
            {{ Session::get("success") }}
        </div>
        <script>
        window.scrollTo(0,0);
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 2000);
        </script>
        @endif
        

		<div class="flash-message"></div>

		<div class="container">
			@yield('content')
		</div>

		<p style="margin-left: 2rem;">
			<br><br>
			<a href="/admin">Admin home</a>
			<br><br>
			<a href="/home">Back to Game</a>
		</p>

		<script>
		// autocompletes
		$('body').on('focusin', '.auto-lookup', function(e, i) {
			// determine lookup url:
			var $target = $(e.target);
			var url = null;
			if ($target.hasClass('zone-lookup'))
				{
				url = '/zone/lookup';
				}

			if ($target.hasClass('room-lookup'))
				{
				url = '/room/lookup';
				}

			if ($target.hasClass('item-lookup'))
				{
				url = '/item/lookup';
				}

			if ($target.hasClass('room-property-lookup'))
				{
				url = '/room_property/lookup';
				}

			$(e.target).autocomplete({
				source: function(request, response) {
					console.log(request);
					$.ajax({
						url: url,
						dataType: 'json',
						data: {
							term: request.term,
							},
						success: response,
						timeout: 5000
						});
					},
				delay: 200,
				minLength: 1
				});
			if ($(e.target).val() != '')
				{
				$(e.target).autocomplete("search");
				}
			});

		$('body').on('focusin', '.room-lookup', function(e, i) {
			// add autocomplete:
			$(e.target).autocomplete({
				source: function(request, response) {
					console.log(request);
					$.ajax({
						url: '/room/lookup',
						dataType: 'json',
						data: {
							term: request.term,
							},
						success: response,
						timeout: 5000
						});
					},
				delay: 200,
				minLength: 1
				});
			if ($(e.target).val() != '')
				{
				$(e.target).autocomplete("search");
				}
			});

		// Combine the autocomplete things and use a data attrib for the types:
		$('body').on('focusin', '.item-lookup', function(e, i) {
			// add autocomplete:
			$(e.target).autocomplete({
				source: function(request, response) {
					console.log(request);
					$.ajax({
						url: '/item/lookup',
						dataType: 'json',
						data: {
							term: request.term,
							},
						success: response,
						timeout: 5000
						});
					},
				delay: 200,
				minLength: 1
				});
			if ($(e.target).val() != '')
				{
				$(e.target).autocomplete("search");
				}
			});

		$('body').on('focusin', '.room-property-lookup', function(e, i) {
			// add autocomplete:
			$(e.target).autocomplete({
				source: function(request, response) {
					console.log(request);
					$.ajax({
						url: '/room_property/lookup',
						dataType: 'json',
						data: {
							term: request.term,
							},
						success: response,
						timeout: 5000
						});
					},
				delay: 200,
				minLength: 1
				});
			if ($(e.target).val() != '')
				{
				$(e.target).autocomplete("search");
				}
			});


		$('body').on('submit', 'form.ajax', function(e, i) {
			e.preventDefault();

			var formData = new FormData(e.target);
			if ($(document.activeElement).hasClass('submit-val'))
				{
				formData.append('submit', $(document.activeElement).val());
				}

			// for (var pair of formData.entries())
			// 	{
			// 	console.log(pair[0] +':' + pair[1]);
			// 	}

			$.ajax({
				type: 'POST',
				url: $(e.target).attr('action'),
				contentType: false,
				processData: false,
				data: formData,
				success: function(resp) {
					$('.container').html(resp.content);
					if (resp.messages)
						{
						$('.flash-message').html(resp.messages);
						}
					}
				});
			});
		</script>
		@else
		You are not an Admin, <a href="/home">Go back</a>
		@endif
	</body>
</html>