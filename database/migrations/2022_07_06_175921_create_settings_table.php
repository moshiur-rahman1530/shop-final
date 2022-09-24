<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title_first_letter');
            $table->string('title_remain');
            $table->longText('description');
            $table->text('short_des');
            $table->string('logo');
            $table->string('photo');
            $table->string('address1');
            $table->string('address2');
            $table->string('phone');
            $table->string('email');
            $table->string('icon1');
            $table->string('feature1');
            $table->string('icon2');
            $table->string('feature2');
            $table->string('icon3');
            $table->string('feature3');
            $table->string('icon4');
            $table->string('feature4');
            $table->string('footer1');
            $table->string('footer2');
            $table->string('footer3');
            $table->string('vendor1');
            $table->string('vendor2');
            $table->string('vendor3');
            $table->string('vendor4');
            $table->string('vendor5');
            $table->string('vendor6');
            $table->string('vendor7');
            $table->string('vendor8');
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
        Schema::dropIfExists('settings');
    }
}
