<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            $table->increments('experience_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->string('company_name',255)->default('');
            $table->string('location',255)->default('');
            $table->string('designation',255)->default('');
            $table->integer('from_date')->default('0');
            $table->integer('to_date')->default('0');
            $table->string('totayear')->default('');
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
        Schema::dropIfExists('experience');
    }
}
