<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 16);
            $table->enum('type', ['fixed', 'percentage', 'shipping'])->default('fixed');
            $table->decimal('amount', 5, 2);
            $table->integer('uses')->unsigned();
            $table->integer('used')->unsigned();
            $table->decimal('minimum_amount', 5, 2)->nullable();
            $table->boolean('before_tax')->default(false);
            $table->json('products_json')->nullable();
            $table->json('categories_json')->nullable();
            $table->json('users_json')->nullable();
            $table->date('expires_at')->nullable();
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
        Schema::drop('coupons');
    }
}
