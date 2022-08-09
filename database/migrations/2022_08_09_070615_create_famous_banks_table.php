<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamousBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famous_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('account_nubmer');
            $table->string('account_name');
            $table->string('bank_name_temp')->nullable();
            $table->string('account_nubmer_temp')->nullable();
            $table->string('account_name_temp')->nullable();
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
        Schema::dropIfExists('famous_banks');
    }
}
