<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $fillable = [
        'style_no',
        'art_no',
        'description',
        'qty',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function size_color()
    {
        return $this->hasMany(SizeColor::class);
    }
}
