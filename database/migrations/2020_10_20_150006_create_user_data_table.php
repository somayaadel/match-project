<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id') ; 
            $table->string('phone') ; 
            $table->integer('gender') ; 
            $table->boolean('phone_confirmed')->default(0) ; 
            $table->string('phone_confirmation_code')->default(0) ; 
            $table->unsignedBigInteger('hight')->nullable() ; 
            $table->unsignedBigInteger('weight')->nullable() ; 
            $table->date('birth_date') ; 
            $table->string('profile_image')->nullable() ;
            $table->string('summary')->nullable() ;
            $table->string('resume')->nullable() ;

            $table->unsignedBigInteger('job_id')->nullable() ; 
            $table->unsignedBigInteger('religion_id')->nullable() ; 
            $table->unsignedBigInteger('city_id')->nullable() ;
            $table->unsignedBigInteger('package_id')->nullable() ; 
            $table->foreign('job_id')->references('id')->on('jobs'); 
            $table->foreign('religion_id')->references('id')->on('religions') ;
            $table->foreign('city_id')->references('id')->on('cities') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ;
            $table->foreign('package_id')->references('id')->on('packages') ;
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
        Schema::dropIfExists('user_data');
    }
}
