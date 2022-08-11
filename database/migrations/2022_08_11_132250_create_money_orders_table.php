<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_orders', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->integer('status')->default(2);
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
        Schema::dropIfExists('money_orders');
    }
}
