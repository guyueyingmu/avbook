<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookCrawler404Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avbook_crawler_404', function(Blueprint $table)
		{
			$table->string('code_36', 12)->default('')->index('code_36');
			$table->string('intable_name', 128);
			$table->tinyinteger('checkdata')->nullable();
			$table->primary(['intable_name','code_36']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avbook_crawler_404');
	}

}
