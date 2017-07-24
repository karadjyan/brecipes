<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableIngRec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ing_rec', function (Blueprint $table) {
            $table->string('name',191)->after('ingredient_id')->comment('for edit form');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ing_rec', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
