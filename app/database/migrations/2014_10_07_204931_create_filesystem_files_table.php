<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesystemFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filesystem_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('directory_id')->unsigned();
			$table->string('name', 255);
			$table->integer('size');
			$table->string('mime', 6)->nullable();
			$table->timestamps();

			$table->foreign('directory_id')->references('id')->on('filesystem_directory')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filesystem_files');
	}

}
