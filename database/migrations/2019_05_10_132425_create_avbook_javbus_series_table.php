<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookJavbusSeriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avbook_javbus_series', function(Blueprint $table)
		{
			$table->string('code_36', 10)->default('')->primary();
			$table->string('series_name', 256)->nullable();
			$table->integer('code_10')->unsigned()->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avbook_javbus_series');
	}

}
