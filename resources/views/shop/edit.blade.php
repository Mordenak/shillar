@extends('layouts.admin')

@section('content')

@if (isset($shop))
Editing a shop:
@else
Creating a shop:
@endif
	
<div>
	<form action="/shop/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($shop) ? $shop->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($shop) ? $shop->description : ''}}" class="form-control">
			</div>
		</div>

		<!-- Items? -->
		<h3>Shop Items</h3>

		<div class="shop-items">
			<div class="shop-forms">
			@if ($shop->shop_items()->count() > 0)
				@foreach ($shop->shop_items() as $shop_item)
				<input type="hidden" name="shop_items[{{$shop_item->id}}][id]" value="{{$shop_item->id}}">
				<div class="row">
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<select name="shop_items[{{$shop_item->id}}][item_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($items as $item)
							@if ($shop_item->item())
							<option value="{{$item->id}}" {{$item->id == $shop_item->item()->id ? 'selected' : ''}}>({{$item->id}}) {{$item->name}}</option>
							@else
							<option value="{{$item->id}}">({{$item->id}}) {{$item->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Price:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[{{$shop_item->id}}][price]" value="{{$shop_item->price}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="row">
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<select name="shop_items[0][item_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($items as $item)
							<option value="{{$item->id}}">({{$item->id}}) {{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Price:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[0][price]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addShopItem(this);">Add Shop Item</a>
		<br><br>


		@if (isset($shop))
		<input type="hidden" name="id" id="db-id" value="{{$shop->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/shop/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<a href="/npc/all">Back</a>
<br><br>

<script>
function addShopItem($btn)
	{
	var $tmp = $('.shop-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/shop_items\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/shop_items\[\d*\]/, 'shop_items['+new_id+']');
		$(this).attr('name', name);
		});

	$('.shop-forms').append($tmp);
	$('.shop-forms').last().find('input[name="id"]').remove();
	}
</script>
@endsection