<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pet_id');
            $table->foreign('pet_id')->references('id')->on('pets');
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
        Schema::dropIfExists('featured_relation');
    }
}
