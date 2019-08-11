<html>
	<head>
		<title>App Name - @yield('title')</title>

		<style>
		a
			{
			color: #55ff8b;
			}
		</style>
	</head>
	<body style="background-color: #222;color:white;">
		@section('sidebar')
			This is the master sidebar.
		@show

		<div class="container">
			@yield('content')
		</div>

		<a href="/admin">Cancel</a>
	</body>
</html>