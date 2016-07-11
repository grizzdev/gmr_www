<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventJobsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::create('event_jobs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 64);
			$table->text('description')->nullable();
			$table->integer('event_id')->unsigned();
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
	Schema::drop('event_jobs');
    }
}
