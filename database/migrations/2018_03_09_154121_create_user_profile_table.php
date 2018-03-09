<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $t) {
            $t->increments('id');
            $t->string('reference_code')->nullable();
            $t->string('first_name')->nullable();
            $t->string('last_name')->nullable();
            $t->string('location')->nullable();
            $t->string('sex')->nullable();
            $t->string('birthday')->nullable();
            $t->string('profile_picture')->nullable();
            $t->unsignedInteger('user_id');
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}