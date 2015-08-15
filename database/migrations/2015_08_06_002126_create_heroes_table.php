<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('slug', 72);
            $table->text('overview')->nullable();
            $table->text('description')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['m', 'f'])->nullable();
            $table->string('address', 128)->nullable();
            $table->string('city', 32)->nullable();
            $table->string('state', 16)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('shirt_size', 3)->nullable();
            $table->string('hospital_name', 128)->nullable();
            $table->text('hospital_location')->nullable();
            $table->string('cancer_type', 128)->nullable();
            $table->string('facebook_url', 128)->nullable();
            $table->string('twitter_url', 128)->nullable();
            $table->string('youtube_url', 128)->nullable();
            $table->string('caringbridge_url', 128)->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('funded')->default(false);
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
        Schema::drop('heros');
    }
}
