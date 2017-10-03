<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function(Blueprint $table){
            $table->increments('id');
            $table->integer('detail_category_id')->unsigned();
            $table->string('name');
            $table->string('preview_img');
            $table->string('draw_img');
            $table->string('link_name')->unique();
            $table->timestamps();

            $table->foreign('detail_category_id')
                ->references('id')
                ->on('detail_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
