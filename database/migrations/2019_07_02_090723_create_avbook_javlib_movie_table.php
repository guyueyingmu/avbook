<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookJavlibMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avbook_javlib_movie', function (Blueprint $table) {
            $table->bigInteger('code_10')->nullable();
            $table->string('code_36', 12)->default('0')->primary();
            $table->string('censored_id', 64)->nullable()->default('')->index('censored_id')->comment('識別碼');
            $table->string('movie_title', 512)->nullable();
            $table->string('movie_pic_cover', 128)->nullable()->comment('替换 域名  https://us.netcdn.space/');
            $table->string('release_date', 16)->nullable()->default('0000-00-00')->comment('發行日期');
            $table->string('movie_length', 32)->nullable()->comment('長度');
            $table->string('Director', 12)->nullable()->comment('導演');
            $table->string('Studio', 12)->nullable()->comment('製作商');
            $table->string('Label', 12)->nullable()->comment('發行商');
            $table->string('Series', 256)->nullable()->comment('系列');
            $table->string('Genre', 256)->nullable()->comment('類別');
            $table->string('JAV_Idols', 256)->nullable()->comment('演員');
            $table->string('sample_dmm', 8192)->nullable();
            $table->float('score', 4)->nullable();
            $table->integer('userswanted')->nullable();
            $table->integer('userswatched')->nullable();
            $table->integer('usersowned')->nullable();
            $table->boolean('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avbook_javlib_movie');
    }
}
