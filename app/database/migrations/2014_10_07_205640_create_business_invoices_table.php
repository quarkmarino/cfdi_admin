<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->binary('uuid');
			$table->integer('recipient_id')->unsigned();;
			$table->integer('issuer_id')->unsigned();;
			$table->integer('file_id')->unsigned();;
			$table->integer('pac_id')->unsigned();;
			$table->datetime('issuing_datetime');
			$table->datetime('certitication_datetime');
			$table->decimal('ammount', 9.3);
			$table->integer('effect');
			$table->timestamps();

			$table->foreign('recipient_id')->references('id')->on('business_contributors')->onUpdate('cascade')
			$table->foreign('issuer_id')->references('id')->on('business_contributors')->onUpdate('cascade')
			$table->foreign('pac_id')->references('id')->on('business_contributors')->onUpdate('cascade')
			$table->foreign('file_id')->references('id')->on('filesystem_files')->onUpdate('cascade')
			

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_invoices');
	}

}
