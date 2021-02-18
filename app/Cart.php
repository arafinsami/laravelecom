<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = [
        'productId',
        'qty',
        'price',
        'userIp'
    ];

    public function getProduct(){
        return $this->belongsTo(Product::class,'productId');
    }
}
