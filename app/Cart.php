<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $fillable = [
		'token',
        'total',
        'count'
    ];

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'total');
    }
}
