<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name',
        'var',
        'description'
    ];

    public function styles()
    {
        return $this->belongsToMany(ColorStyle::class);
    }
}
