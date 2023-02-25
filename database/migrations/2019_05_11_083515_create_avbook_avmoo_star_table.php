<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avbook_avmoo_star', function (Blueprint $table) {
            $table->string('code_36', 5)->default('')->primary();
            $table->string('star_name', 128)->nullable();
            $table->string('star_birthday', 64)->nullable();
            $table->integer('star_age')->nullable()->default(0);
            $table->string('star_cupsize', 8)->nullable();
            $table->integer('star_height')->nullable();
            $table->integer('star_bust')->nullable();
            $table->integer('star_waist')->nullable();
            $table->integer('star_hip')->nullable();
            $table->string('hometown', 128)->nullable();
            $table->string('hobby', 512)->nullable()->comment('https://jp.netcdn.space/mono/actjpgs/');
            $table->string('star_pic', 64)->nullable()->comment('https://jp.netcdn.space/mono/actjpgs/');
            $table->integer('favorite')->nullable()->default(0);
            $table->integer('file_num')->nullable();
            $table->integer('code_10')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avbook_avmoo_star');
    }
};
