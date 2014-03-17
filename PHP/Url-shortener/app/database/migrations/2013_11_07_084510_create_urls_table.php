<?php

use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("urls", function($t) {
			$t->increments('id');
			$t->string('url');
			$t->string("shortened", 5);
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('urls');
	}

}