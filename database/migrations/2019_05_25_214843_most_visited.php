<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MostVisited extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mostvisited', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->string('media')->default('media/1.png');
            $table->text('content');
            $table->BigInteger('view');
            $table->timestamp('last_view')->nullable();
            $table->BigInteger('vote')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comunity_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comunity_id')->references('id')->on('comunities')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mostvisited');
    }
}
