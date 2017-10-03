<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSculptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sculpts', function(Blueprint $table){
            $table->increments('id');
            $table->string('showing_model');
            $table->integer('detail_id')->unsigned();

            $table->foreign('detail_id')
                ->references('id')
                ->on('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sculpts');
    }
}
