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
			$table->string('password', 64);
			$table->string('name', 128);
			$table->integer('user_id')->unsigned();
			$table->integer('key_id')->nullable()->unsigned()->default(null);
			$table->integer('cer_id')->nullable()->unsigned()->default(null);
			$table->integer('type')->default(0);
			$table->integer('status')->default(0);
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('app_users')->onUpdate('cascade');
			$table->foreign('key_id')->references('id')->on('filesystem_files')->onUpdate('cascade');
			$table->foreign('cer_id')->references('id')->on('filesystem_files')->onUpdate('cascade');
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
