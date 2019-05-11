<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookJavbusMagnetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avbook_javbus_magnet', function(Blueprint $table)
		{
			$table->string('magnet_xt', 64)->default('')->comment('magnet:?xt=urn:btih:');
			$table->string('gid', 16)->default('0')->index('gid');
			$table->string('censored_id', 64)->default('')->index('censored_id');
			$table->string('magnet_name', 1024)->nullable();
			$table->string('magnet_type', 32)->nullable();
			$table->string('magnet_date', 32)->nullable();
			$table->integer('have_hd')->nullable();
			$table->integer('have_sub')->nullable()->comment('1');
			$table->integer('have_down')->nullable()->index('have_down');
			$table->primary(['magnet_xt','gid']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avbook_javbus_magnet');
	}

}
