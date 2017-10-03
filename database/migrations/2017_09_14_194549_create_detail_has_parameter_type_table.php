<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailHasParameterTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_has_parameter_type', function(Blueprint $table){
            $table->increments('id');
            $table->integer('detail_id')->unsigned();
            $table->integer('parameter_type_id')->unsigned();

            $table->foreign('detail_id')
                ->references('id')
                ->on('details');
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
        Schema::dropIfExists('detail_has_parameter_type');
    }
}
