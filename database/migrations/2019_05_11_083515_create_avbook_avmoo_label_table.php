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
        Schema::create('avbook_avmoo_label', function (Blueprint $table) {
            $table->string('code_36', 5)->default('')->primary();
            $table->string('label_name', 256)->nullable();
            $table->integer('code_10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avbook_avmoo_label');
    }
};
