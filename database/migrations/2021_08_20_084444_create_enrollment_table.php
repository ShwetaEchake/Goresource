<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->increments('enrollment_id')->index();
            $table->integer('assessment_id')->index()->default('0');
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('interview_id')->index()->default('0');
            $table->integer('created_by')->index()->default('0');
            $table->integer('branch_id')->index()->default('0');
            $table->integer('enrollment_date')->default('0');
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
        Schema::dropIfExists('enrollment');
    }
}
