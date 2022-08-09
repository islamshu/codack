<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamousSoialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famous_soials', function (Blueprint $table) {
            $table->id();
            $table->string('social_title');
            $table->string('social_url');
            $table->unsignedBigInteger('famous_id');
            $table->foreign('famous_id')->references('id')->on('famouses')->onDelete('cascade');
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
        Schema::dropIfExists('famous_soials');
    }
}
