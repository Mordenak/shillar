<html>
	<head>
		<title>App Name - @yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

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

		<div class="flash-message"></div>

		<div class="container">
			@yield('content')
		</div>

		<br><br>
		<a href="/admin">Cancel</a>

		<script>
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