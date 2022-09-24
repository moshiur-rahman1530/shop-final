<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('user_id');
          $table->string('product_id');
          $table->string('product_name');
          $table->string('product_price');
          $table->string('product_color');
          $table->string('product_size');
          $table->string('product_cat');
          $table->string('product_subcat');
          $table->string('image');
          $table->string('product_brand')->nullable();
          $table->string('product_unit');
          $table->string('discount');
          $table->string('ip');
          $table->string('qtn');
          $table->timestamp('created_at')->useCurrent();
          $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
