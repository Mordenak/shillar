<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
	<div class="col-md-1">
		<a href="/admin" class="btn btn-info admin-link" title="alt+w">Admin Home</a>
	</div>
	<div class="col-md-3 offset-md-1">
		<h3> {{ $title }}</h3>
	</div>
	@if ($dbid > 0)
	<div class="col-md-1">
		<a href="/{{ $baseroute }}/create" class="btn btn-success new-link" title="alt+n">New</a>
	</div>
	@endif
	<div class="col-md-1">
		<a href="/{{ $baseroute }}/all" class="btn btn-secondary cancel-link" title="alt+c">Cancel</a>
	</div>
	<div class="col-md-1">
		<input type="submit" value="Save" class="btn btn-primary" onclick="$('form.form-horizontal').submit();" title="alt+s">
	</div>
	@if ($dbid > 0)
	<div class="col-md-1 offset-md-3">
		<form method="post" action="/{{ $baseroute }}/delete" style="margin-block-end: 0;"> <!-- Weird style issue?? -->
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$dbid}}">
			<input type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>
	@endif
	{{ $slot }}
</div>