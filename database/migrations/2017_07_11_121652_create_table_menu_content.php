<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenuContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('m_id')->unsigned();
            $table->foreign('m_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('r_id')->unsigned();
            $table->foreign('r_id')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_content');
    }
}
