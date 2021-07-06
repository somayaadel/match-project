<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->text('email');
            $table->text('phone');
            $table->string('time_zone');
            $table->boolean('member_email_verification');
            $table->boolean('member_profile_picture_admin_approve');
            $table->text('terms');
            $table->text('privacy_policy');
            $table->unsignedBigInteger('application_id');

            $table->foreign('application_id')->references('id')->on('applications');
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
        Schema::dropIfExists('general_settings');
    }
}
