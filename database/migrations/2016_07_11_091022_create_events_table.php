<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::create('events', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 128);
			$table->string('slug', 128);
			$table->text('description')->nullable();
			$table->string('city', 32);
			$table->integer('state_id')->unsigned();
			$table->string('zip', 10);
			$table->integer('lead_id')->unsigned();
			$table->timestamp('start_at');
			$table->timestamp('end_at');
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
	Schema::drop('events');
    }
}
