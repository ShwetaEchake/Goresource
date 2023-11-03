<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview', function (Blueprint $table) {
            $table->increments('interview_id')->index();
            $table->integer('company_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('interview_date')->default('0');
            $table->integer('start_time')->default('0');
            $table->integer('end_time')->default('0');
            $table->string('interview_venu',255)->default('');
            $table->string('interview_city',255)->default('');
            $table->string('interview_state',255)->default('');
            $table->string('interview_country',255)->default('');
            $table->string('interview_zipcode',255)->default('');
            $table->string('interviewer_name',255)->default('');
            $table->string('interviewer_mobileno',20)->default('');
            $table->string('interviewer_email',20);
            $table->integer('created_by')->default('0');
            $table->integer('created_date')->default('0');
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
        Schema::dropIfExists('interview');
    }
}
