<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('user')->unique();
			$table->string('password');
			$table->string('name');
			$table->integer('type');
			$table->timestamps();
			$table->rememberToken();
		});
		
		Schema::create('users_type', function($table)
		{
			$table->increments('id');
			$table->string('type');
			$table->string('detail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('users_type');
	}

}
