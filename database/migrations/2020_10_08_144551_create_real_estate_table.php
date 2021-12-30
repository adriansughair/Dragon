<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->integer('rooms');
            $table->integer('baths');
            $table->string('district');
            $table->text('description');
            $table->text('location');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('real_estate_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate');
    }
}
