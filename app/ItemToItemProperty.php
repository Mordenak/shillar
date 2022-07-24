<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemToItemProperty extends Model
{
    use HasFactory;

    protected $fillable = ['items_id', 'item_properties_id', 'data'];

    public function item()
        {
        return $this->belongsTo('App\Item');
        }

    public function property()
        {
        return $this->belongsTo('App\ItemProperty', 'item_properties_id');
        }

    public function get_data()
        {
        // Somehow return data properly for everything?
        // Should there be a common method for this?
        }

    public function show_data()
        {
        return true;
        }

    public function decode()
        {
        return json_decode($this->data, true);
        }
}
