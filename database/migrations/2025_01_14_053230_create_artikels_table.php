<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->text("headlineUtamaArtikel")->nullable();
            $table->text("highlight1")->nullable();
            $table->text("paragraf1")->nullable();
            $table->text("paragraf2")->nullable();
            $table->text("highlight2")->nullable();
            $table->text("paragraf3")->nullable();
            $table->text("paragraf4")->nullable();
            $table->text("image1")->nullable();
            $table->text("image2")->nullable();
            $table->text("image3")->nullable();
            $table->text("image4")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('artikels');
    }
}
