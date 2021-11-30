<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrealertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prealerts', function (Blueprint $table) {
            $table->id();
            $table->string('umi');
            $table->string('package_nm');
            $table->string('invoice_total');
            $table->string('track_nm');
            $table->string('courier');
            $table->string('shipper');
            $table->string('weight');
            $table->string('content');
            $table->string('promo')->nullable();
            $table->string('file');
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
        Schema::dropIfExists('prealerts');
    }
}
