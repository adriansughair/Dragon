<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGalleryTableSetRealEstateIdNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropForeign(['real_estate_id']);
            $table->bigInteger('real_estate_id')->unsigned()->nullable()->change();

            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropForeign(['real_estate_id']);
            $table->dropColumn('real_estate_id');
        });
    }
}
