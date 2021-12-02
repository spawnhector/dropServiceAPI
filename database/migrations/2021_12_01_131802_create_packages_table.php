<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('umi');
            $table->bigInteger('prealert_id')->unsigned();
            $table->foreign('prealert_id')->references('id')->on('prealerts')->onDelete('cascade');
            $table->string('track_number');
            $table->string('status');
            $table->string('condition');
            $table->string('pieces');
            $table->string('type');
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
        Schema::dropIfExists('packages');
    }
}
