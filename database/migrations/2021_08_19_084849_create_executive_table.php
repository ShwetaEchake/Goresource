<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive', function (Blueprint $table) {
            $table->integer('executive_id');
            $table->integer('user_id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('branch_name',255);
            $table->integer('role_id');
            $table->string('mobile_no',15);
            $table->string('email')->unique();
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
        Schema::dropIfExists('executive');
    }
}
