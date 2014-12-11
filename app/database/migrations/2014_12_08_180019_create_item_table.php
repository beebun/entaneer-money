<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item', function($table)
		{
			$table->increments('id');
			$table->integer('course');
			$table->integer('income_type');
			$table->integer('department');
			$table->integer('semester');
			$table->integer('year');
			$table->double('amount');
			$table->text('detail');
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
		Schema::drop('item');
	}

}
