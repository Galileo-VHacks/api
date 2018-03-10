<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $t) {
            $t->increments('id');
            $t->string('reference_code')->nullable();
            $t->string('name');
            $t->string('wallet');
            $t->string('email');
            $t->string('phone_number');
            $t->string('website');
            $t->string('type');
            $t->double('lat');
            $t->double('long');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
