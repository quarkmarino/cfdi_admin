<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessContributorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_contributors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('rfc', 13);
			$table->string('name', 128);
			$table->integer('users_id')->unsigned();
			$table->integer('key_id')->unsigned();
			$table->integer('cer_id')->unsigned();
			$table->integer('type')->default(0);
			$table->timestamps();
			$table->foreign('users_id')->references('id')->on('business_users')->onUpdate('cascade')
			$table->foreign('key_id')->references('id')->on('filesystem_files')->onUpdate('cascade')
			$table->foreign('cer_id')->references('id')->on('filesystem_files')->onUpdate('cascade')
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_contributors');
	}

}
