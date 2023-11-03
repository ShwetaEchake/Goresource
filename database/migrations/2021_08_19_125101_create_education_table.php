<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->integer('education_id')->index()->default('0');
            $table->integer('candidate_id')->index()->default('0');
            $table->string('education_type',255)->default('');
            $table->string('school_university_name',255)->default('');
            $table->string('completed_year',255)->default('');
            $table->string('board_rate')->index()->default('');
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
        Schema::dropIfExists('education');
    }
}
