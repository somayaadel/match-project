<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow-ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->foreign('follower_id')->references('id')->on('users');
            $table->unsignedBigInteger('following_id');
            $table->foreign('following_id')->references('id')->on('users');
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
        Schema::dropIfExists('follow-ups');
    }
}
