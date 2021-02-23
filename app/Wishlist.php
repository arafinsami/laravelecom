<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {

    protected $fillable = [
        'userId', 'productId',
    ];

    public function getProduct(){
        return $this->belongsTo(Product::class,'productId');
    }
}
