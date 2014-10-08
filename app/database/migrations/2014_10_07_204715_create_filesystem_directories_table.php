<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesystemDirectoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filesystem_directories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('parent_id')->unsigned();
			$table->timestamps();

			$table->foreign('parent_id')->references('id')->on('filesystem_directories')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filesystem_directories');
	}

}
