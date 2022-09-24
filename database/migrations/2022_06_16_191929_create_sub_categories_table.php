<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->integer('cat_id');
          $table->text('description');
          $table->string('img');
          $table->string('img_name')->default(null);
          $table->boolean('status')->default(0);
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
        Schema::dropIfExists('sub_categories');
    }
}
