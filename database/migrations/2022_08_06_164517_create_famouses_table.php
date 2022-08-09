<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('country_id');
            $table->string('phone');
            $table->string('email');
            $table->integer('professional_license_number');
            $table->integer('is_famous');
            $table->integer('followers_number')->nullable();
            $table->integer('views_number')->nullable();
            $table->enum('follower_type', ['male', 'femail','children']);
            $table->unsignedBigInteger('famoustype_id');
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapchat')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('famoustype_id')->references('id')->on('famous_types')->onDelete('cascade');

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
        Schema::dropIfExists('famouses');
    }
}
