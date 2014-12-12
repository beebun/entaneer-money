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
			$table->integer('course');
			$table->integer('department_c');
			$table->integer('semester');
			$table->integer('year');
			$table->double('scch_value');
			$table->integer('student_amount');
			$table->primary('course','department_c','semester','year');
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
