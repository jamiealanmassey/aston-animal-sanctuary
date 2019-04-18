<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('type');
            $table->integer('breed');
            $table->integer('age_years');
            $table->integer('age_months');
            $table->string('description');
            $table->string('profile_img');
            $table->unsignedBigInteger('impressions')->default(0);
            $table->integer('availabiltiy')->default(0);
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
        Schema::dropIfExists('pets');
    }
}
