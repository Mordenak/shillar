<html>
	<head>
		<title>Shillar Admin Panel - @yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Page/Token refresh -->
    	<meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

		<!-- Base CSS -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<!-- jQuery -->
		<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

		<!-- jQuery ui -->
		<link rel="stylesheet" href="{{asset('jquery-ui-1.12.1/jquery-ui.min.css')}}">
		<script src="{{asset('jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>

		<!-- DataTables -->
		<link rel="stylesheet" href="{{asset('DataTables/datatables.min.css')}}">
		<script src="{{asset('DataTables/datatables.min.js')}}"></script>
		
		<!-- FontAwesome -->
		<link rel="stylesheet" href="{{asset('fontawesome-free-5.10.2-web/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome-free-5.10.2-web/css/solid.min.css')}}">
		<script src="{{asset('fontawesome-free-5.10.2-web/js/fontawesome.min.js')}}"></script>

		<style>
		body a
			{
			color: #55ff8b;
			}

		.link-label
			{
			color: #55ff8b;
			margin: 0;	
			}

		table.dataTable tbody tr
			{
			background-color: #333;
			}

		.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate
			{
			color: #fff;
			}

		.dataTables_wrapper .dataTables_paginate .paginate_button
			{
			color: #aaa !important;
			}

		.dt-container
			{
			padding-left: 2rem;
			padding-right: 2rem;
			}
		</style>
	</head>
	<body style="background-color: #222;color:white;">

		@if (auth()->user()->admin_level >= 1)
		@section('sidebar')
		@show


		<br><br><br>
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

		<div>
			@yield('content')
		</div>

		<script>
		$('#all-records').dataTable({pageLength: 50});

		document.addEventListener('keydown', function(e) {
			if (e.altKey)
				{
				if (e.key === 'ArrowRight')
					{
					$('.next-link')[0].click();
					}
				if (e.key === 'ArrowLeft')
					{
					$('.prev-link')[0].click();
					}
				if (e.key === 's')
					{
					$('form.form-horizontal').submit();
					}
				else if (e.key === 'c')
					{
					$('.cancel-link')[0].click();
					}
				else if (e.key === 'n')
					{
					$('.new-link')[0].click();
					}
				else if (e.key === 'w')
					{
					$('.admin-link')[0].click();
					}
				}
			});
		// autocompletes
		$('body').on('focusin', '.auto-lookup', function(e, i) {
			// determine lookup url:
			var $target = $(e.target);
			var url = null;
			if ($target.hasClass('zone-lookup'))
				{
				url = '/zone/lookup';
				}

			if ($target.hasClass('zone-area-lookup'))
				{
				url = '/zone_area/lookup';
				}

			if ($target.hasClass('room-lookup'))
				{
				url = '/room/lookup';
				}

			if ($target.hasClass('creature-lookup'))
				{
				url = '/creature/lookup';
				}

			if ($target.hasClass('item-lookup'))
				{
				url = '/item/lookup';
				}

			if ($target.hasClass('room-property-lookup'))
				{
				url = '/room_property/lookup';
				}

			if ($target.hasClass('character-lookup'))
				{
				url = '/character/lookup';
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