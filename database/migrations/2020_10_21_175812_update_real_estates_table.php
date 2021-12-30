<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->string('title');
            $table->integer('kitchens');
            $table->integer('parkings');
            $table->boolean('temp')->nullable();
            $table->boolean('offerType')->nullable();
            $table->boolean('tax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('kitchens');
            $table->dropColumn('parkings');
            $table->dropColumn('temp');
            $table->dropColumn('offerType');
            $table->dropColumn('tax');
        });
    }
}
