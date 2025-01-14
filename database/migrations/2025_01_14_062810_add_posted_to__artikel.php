<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostedToArtikel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->integer('owner_id')->nullable()->after('category_id');
            $table->enum('type', ['singular', 'series'])->default('singular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            //
        });
    }
}
