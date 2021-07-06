<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id') ;
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade') ;
            $table->unsignedBigInteger('user_id') ;

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ;
            $table->unsignedBigInteger('payment_method_id') ;
            $table->foreign('payment_method_id')->references('id')->on('payment_method')->onDelete('cascade') ;
            $table->unsignedBigInteger('package_id') ;
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade') ;
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
        Schema::dropIfExists('earnings');
    }
}
