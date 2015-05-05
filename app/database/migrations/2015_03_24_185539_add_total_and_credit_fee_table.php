<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalAndCreditFeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_total', function($table)
		{
			$table->increments('id');
			$table->double('cost_balance');
			$table->integer('department_id');
			$table->integer('semester');
			$table->integer('years');
			$table->timestamps();
		});

		Schema::create('course_money', function($table)
		{
			$table->increments('id');
			$table->double('cost_balance');
			$table->integer('course_id');
			$table->integer('semester');
			$table->integer('years');
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
		Schema::drop('department_total');
		Schema::drop('course_money');
	}

}
