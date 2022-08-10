<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade'); 
            $table->unsignedBigInteger('famous_id');
            $table->foreign('famous_id')->references('id')->on('famouses')->onDelete('cascade');
            $table->string('code');
            $table->string('discount_percentage');
            $table->string('benefit_percentage');
            $table->string('system_percentage');
            $table->string('famous_percentage');
            $table->integer('status')->default(1);


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
        Schema::dropIfExists('codes');
    }
}
