<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_views', function(Blueprint $table){
            $table->increments('id');
            $table->ipAddress('visitor');
            $table->integer('detail_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('detail_views');
    }
}
