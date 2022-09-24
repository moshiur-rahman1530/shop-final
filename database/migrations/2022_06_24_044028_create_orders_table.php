<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name','255');
            $table->string('email','30');
            $table->string('phone','20');
            $table->double('amount');
            $table->double('subTotal');
            $table->string('coupon');
            $table->string('payment_type');
            $table->text('address');
            $table->text('address2');
            $table->string('country');
            $table->string('state');
            $table->string('zip');
            $table->string('status','10');
            $table->string('transaction_id','255');
            $table->string('currency','20');
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
        Schema::dropIfExists('orders');
    }
}
