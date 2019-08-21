<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItems extends Model
{
	protected $fillable = ['shops_id', 'items_id', 'price', 'markup'];
}
