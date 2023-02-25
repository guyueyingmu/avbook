<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookJavbusMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avbook_javbus_movie', function (Blueprint $table) {
            $table->string('censored_id', 64)->default('')->primary()->comment('識別碼');
            $table->string('avmoo_code_36', 6)->nullable()->default('')->index('avmoo_code_36');
            $table->string('movie_pic_cover', 128)->nullable()->comment('https://pics.javbus.info/cover/5trd_b.jpg');
            $table->string('movie_title', 512)->nullable();
            $table->string('release_date', 32)->nullable()->comment('發行日期');
            $table->string('gid', 12)->default('0')->index('gid');
            $table->string('movie_length', 32)->nullable()->comment('長度分鐘');
            $table->string('Director', 12)->nullable()->comment('導演');
            $table->string('Studio', 12)->nullable()->comment('製作商');
            $table->string('Label', 12)->nullable()->comment('發行商');
            $table->string('Series', 256)->nullable()->comment('系列');
            $table->string('Genre', 256)->nullable()->comment('類別');
            $table->string('JAV_Idols', 256)->nullable()->comment('演員');
            $table->string('Similar', 128)->nullable()->comment('Similar Videos');
            $table->integer('have_hd')->nullable();
            $table->integer('have_sub')->nullable();
            $table->integer('have_magnet')->nullable();
            $table->string('Label_code', 5)->nullable();
            $table->string('Series_code', 5)->nullable();
            $table->string('sample_dmm', 128)->nullable()->default('0')->comment('https://pics.dmm.co.jp');
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
        Schema::drop('avbook_javbus_movie');
    }
}
