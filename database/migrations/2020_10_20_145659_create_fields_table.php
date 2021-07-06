<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name') ;
            $table->string('name_ar') ;
            $table->string('type') ;
            $table->json('items')->nullable() ; 
            $table->boolean('mandatory')->default(0) ; 
            $table->unsignedBigInteger('role_id') ; 
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade') ; 
            $table->unsignedBigInteger('application_id') ; 
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade') ; 
            $table->boolean('required')->default(0) ; 
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
        Schema::dropIfExists('fields');
    }
}
