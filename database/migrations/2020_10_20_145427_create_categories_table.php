<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name') ;
            $table->string('name_ar') ;
            $table->text('image')->nullable() ;
            
            $table->unsignedBigInteger('application_id') ;
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade') ;


            $table->unsignedBigInteger('category_type_id') ;
            $table->foreign('category_type_id')->references('id')->on('category_types')->onDelete('cascade') ;

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
        Schema::dropIfExists('categories');
    }
}
