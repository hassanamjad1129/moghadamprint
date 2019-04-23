<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneybagReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneybag_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('user_id');
            $table->enum('operation',['increase','decrease'])->default('increase');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneybag_reports');
    }
}
