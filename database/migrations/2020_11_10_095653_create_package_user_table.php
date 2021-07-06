<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id') ;
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade') ;
            $table->unsignedBigInteger('user_id') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ;
            $table->string('start_date');
            $table->string('end_date');

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
        Schema::dropIfExists('package_user');
    }
}
