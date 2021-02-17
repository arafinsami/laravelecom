<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration {
  
    public function up() {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('qty');
            $table->integer('price');
            $table->ipAddress('userIp');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('carts');
    }
}
