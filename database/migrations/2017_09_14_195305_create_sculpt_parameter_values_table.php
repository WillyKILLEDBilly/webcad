<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSculptParameterValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sculpt_parameter_values', function(Blueprint $table){
            $table->increments('id');
            $table->double('value');
            $table->integer('sculpt_id')->unsigned();
            $table->integer('parameter_type_id')->unsigned();

            $table->foreign('sculpt_id')
                ->references('id')
                ->on('sculpts');
            $table->foreign('parameter_type_id')
                ->references('id')
                ->on('parameter_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sculpt_parameter_values');
    }
}
