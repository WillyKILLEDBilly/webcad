<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailHasTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_has_tag', function(Blueprint $table){
            $table->integer('tag_id')->unsigned();
            $table->integer('detail_id')->unsigned();

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags');
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
        Schema::dropIfExists('detail_has_tag');
    }
}
