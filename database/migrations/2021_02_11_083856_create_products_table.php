<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('categoryId');
            $table->integer('brandId');
            $table->string('productName');
            $table->string('productSlug');
            $table->string('productCode');
            $table->string('productQuantity');
            $table->text('shortDescription');
            $table->text('longDescription');
            $table->integer('price');
            $table->string('imageOne');
            $table->string('imageTwo');
            $table->string('imageThree');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
}
