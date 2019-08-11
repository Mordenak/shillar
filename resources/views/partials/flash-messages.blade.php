@section('messages')
@if( Session::has("success") )
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
@endsection