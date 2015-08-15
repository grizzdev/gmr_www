<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 128);
            $table->string('sku', 156);
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('price', 5, 2);
            $table->decimal('sale_price', 5, 2);
            $table->decimal('contribution_amount', 5, 2)->nullable();
            $table->integer('file_id')->unsigned()->nullable();
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
        Schema::drop('products');
    }
}
