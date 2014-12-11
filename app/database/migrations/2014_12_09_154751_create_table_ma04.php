<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMa04 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('income_type', function($table)
		{
			$table->increments('id');
			$table->string('name');
		});
		
		Schema::create('constant', function($table)
		{
			$table->increments('id');
			$table->integer('course_id');
			$table->integer('department_id');
			$table->double('scch_value');
			$table->integer('student_amount');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('income_type');
		
		Schema::drop('constant');
	}

}
