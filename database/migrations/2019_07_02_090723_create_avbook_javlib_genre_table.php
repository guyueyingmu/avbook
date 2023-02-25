<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvbookJavlibGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avbook_javlib_genre', function (Blueprint $table) {
            $table->string('genre_code', 11)->primary();
            $table->string('genre_dsce', 64)->nullable();
            $table->integer('code_10')->nullable();
            $table->integer('page_num')->nullable();
            $table->integer('old_page_num')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avbook_javlib_genre');
    }
}
