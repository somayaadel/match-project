<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique() ;
            $table->string('name_ar')->unique() ;
            $table->unsignedBigInteger('price') ;
            $table->string('logo')->nullable() ;
            $table->unsignedBigInteger('duration') ;
            $table->unsignedBigInteger('application_id') ;
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade') ;
            $table->unsignedBigInteger('role_id') ;
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade') ;
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
        Schema::dropIfExists('packages');
    }
}
