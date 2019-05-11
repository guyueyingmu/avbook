<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookAvmooMovieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avbook_avmoo_movie', function(Blueprint $table)
		{
			$table->integer('code_10')->nullable();
			$table->string('code_36', 6)->default('0')->primary();
			$table->string('censored_id', 64)->default('')->index('censored_id')->comment('識別碼');
			$table->string('movie_title', 512)->nullable();
			$table->string('movie_pic_cover', 128)->nullable();
			$table->string('release_date', 32)->nullable()->default('0000-00-00')->comment('發行日期');
			$table->string('movie_length', 32)->nullable()->comment('長度');
			$table->string('Director', 12)->nullable()->comment('導演');
			$table->string('Studio', 12)->nullable()->comment('製作商');
			$table->string('Label', 12)->nullable()->comment('發行商');
			$table->string('Series', 256)->nullable()->comment('系列');
			$table->string('Genre', 256)->nullable()->index('Genre')->comment('類別');
			$table->string('JAV_Idols', 256)->nullable()->index('JAV_Idols')->comment('演員');
			$table->integer('sample_dmm')->nullable();
			$table->tinyinteger('have_mg')->nullable()->default(0);
			$table->tinyinteger('have_file')->nullable()->default(0);
			$table->tinyinteger('have_hd')->nullable()->default(0);
			$table->tinyinteger('have_sub')->nullable()->default(0);
			$table->tinyinteger('have_hdbtso')->nullable()->default(0);
			$table->tinyinteger('have_mgbtso')->nullable()->default(0);
			$table->tinyinteger('have_file2')->nullable()->default(0);
			$table->tinyinteger('favorite')->nullable()->default(0)->comment('收藏');
			$table->tinyinteger('wanted')->nullable()->default(0)->comment('想要');
			$table->tinyinteger('watched')->nullable()->default(0)->comment('看过');
			$table->tinyinteger('owned')->nullable()->default(0)->comment('已拥有');
			$table->tinyinteger('visited')->nullable()->comment('浏览过');
			$table->string('blogjav_img', 128)->nullable();
			$table->dateTime('magnet_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avbook_avmoo_movie');
	}

}
