<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInstutionToIdServicechartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicecharters', function (Blueprint $table) {
            $table->integer('scinstitution_id')->change();
            //$table->renameColumn('institution','scinstitution_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicecharters', function (Blueprint $table) {
            //
        });
    }
}
