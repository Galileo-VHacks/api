<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $t) {
            $t->increments('id');
            $t->string('reference_code')->nullable();
            $t->string('type');
            $t->unsignedInteger('user_id');
            $t->unsignedInteger('partner_id')->nullable(); //TODO: Make it a FK with partners
            $t->timestamps();

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
        Schema::dropIfExists('activities');
    }
}
