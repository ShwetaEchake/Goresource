<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport', function (Blueprint $table) {
            $table->increments('passport_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('passport_no')->default('0');
            $table->string('date_issue',255)->default('');
            $table->string('date_expire',255)->default('');
            $table->string('place_issue',255)->default('');
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
        Schema::dropIfExists('passport');
    }
}
