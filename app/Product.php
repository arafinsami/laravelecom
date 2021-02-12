<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    
    protected $fillable = [
        'categoryId',
        'brandId',
        'productName',
        'productSlug',
        'productCode',
        'productQuantity',
        'shortDescription',
        'longDescription',
        'price',
        'imageOne',
        'imageTwo',
        'imageThree',
        'status',
    ];

}
