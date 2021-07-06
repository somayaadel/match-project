<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id') ; 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ; 
            $table->unsignedBigInteger('field_id') ; 
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade') ; 
            $table->string('value') ; 
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
        Schema::dropIfExists('field_user_data');
    }
}
