<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neworders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('cart_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->text('payment_token');
            $table->integer('payment_status_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('card_id')->unsigned()->nullable();
            $table->integer('billing_address_id')->unsigned();
            $table->integer('shipping_address_id')->unsigned();
            $table->json('meta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('neworders');
    }
}
