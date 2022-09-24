<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('product_name');
          $table->string('product_cat');
          $table->string('product_img');
          $table->string('img_name')->default(null);
          $table->text('product_des');
          $table->integer('subcat_id')->nullable();
          $table->integer('brand_id')->nullable();
          $table->integer('unit_id');
          $table->boolean('status')->default(0);
          $table->enum('condition',['default','new','hot'])->default('default');
          $table->boolean('is_featured')->deault(0);
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
        Schema::dropIfExists('products');
    }
}
