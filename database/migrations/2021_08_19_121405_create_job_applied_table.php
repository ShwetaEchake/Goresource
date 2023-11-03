<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applied', function (Blueprint $table) {
            $table->increments('applied_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('company_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->string('choice1',255)->default('');
            $table->string('choice2',255)->default('');
            $table->string('country_preference',255)->default('');
            $table->string('salary_expectation',255)->default('');
            $table->string('referred_by',255)->default('');
            $table->integer('branch_id')->index()->default('0');
            $table->integer('created_by')->index()->default('0');
            $table->integer('date_applied')->default('0');
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
        Schema::dropIfExists('job_applied');
    }
}
