<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32)->nullable();
            $table->string('address_1', 64);
            $table->string('address_2', 64)->nullable();
            $table->string('city', 32);
            $table->integer('state_id')->unsigned();
            $table->string('zip', 15);
            $table->integer('country_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_billing')->default(false);
            $table->boolean('is_shipping')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
