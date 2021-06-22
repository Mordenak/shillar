@extends('layouts.admin')

@section('content')
	
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

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Room:</label>
			<div class="col-md-2">
				<input type="text" name="rooms_id" class="form-control room-lookup" placeholder="Lookup a room:" value="{{isset($shop) ? $shop->rooms_id : ''}}">
			</div>

			<label class="col-md-2 col-form-label text-md-right">Buys?</label>
			<div class="col-md-3">
				<div class="form-check">
					<input type="checkbox" name="buys_weapons" class="form-check-input" id="weapons" {{isset($shop) && $shop->buys_weapons ? 'checked' : ''}}>
					<label class="form-check-label" for="weapons">
						Weapons
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_armors" class="form-check-input" id="armor" {{isset($shop) && $shop->buys_armors ? 'checked' : ''}}>
					<label class="form-check-label" for="armor">
						Armor
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_accessories" class="form-check-input" id="accessories" {{isset($shop) && $shop->buys_accessories ? 'checked' : ''}}>
					<label class="form-check-label" for="accessories">
						Accessories
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_foods" class="form-check-input" id="foods" {{isset($shop) && $shop->buys_foods ? 'checked' : ''}}>
					<label class="form-check-label" for="foods">
						Foods
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_jewels" class="form-check-input" id="jewels" {{isset($shop) && $shop->buys_jewels ? 'checked' : ''}}>
					<label class="form-check-label" for="jewels">
						Jewels
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_dusts" class="form-check-input" id="dusts" {{isset($shop) && $shop->buys_dusts ? 'checked' : ''}}>
					<label class="form-check-label" for="dusts">
						Dusts
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_others" class="form-check-input" id="others" {{isset($shop) && $shop->buys_others ? 'checked' : ''}}>
					<label class="form-check-label" for="others">
						Others
					</label>
				</div>
			</div>
		</div>

		<!-- Items? -->
		<h3>Shop Items</h3>
		<a class="btn btn-secondary" onclick="addShopItem(this);">Add Shop Item</a>
		<br><br>

		<div class="shop-items">
			<div class="shop-forms">
			@if (isset($shop) && $shop->shop_items()->count() > 0)
				@foreach ($shop->shop_items() as $shop_item)
				<input type="hidden" name="shop_items[{{$shop_item->id}}][id]" value="{{$shop_item->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Item:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[{{$shop_item->id}}][item_id]" value="{{$shop_item->item()->id}}" class="form-control item-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Markup:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[{{$shop_item->id}}][markup]" value="{{$shop_item->markup}}" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Price:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[{{$shop_item->id}}][price]" value="{{$shop_item->price}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Item:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[0][item_id]" class="form-control item-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Markup:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[0][markup]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Price:</label>
					<div class="col-md-1">
						<input type="text" name="shop_items[0][price]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		@if (isset($shop))
		<input type="hidden" name="id" id="db-id" value="{{$shop->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($shop) ? 'Editing a Shop' : 'Creating a Shop' }}" baseroute="shop" dbid="{{ isset($shop) ? $shop->id : 0}}"></x-admin-nav>
</div>

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