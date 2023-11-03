<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('job_id')->index();
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('client_id')->index()->default('0');
            $table->integer('job_main_category_id')->index()->default('0');
            $table->integer('job_sub_category_id')->index()->default('0');
            $table->integer('project_location')->index()->default('0');
            $table->integer('enquiy_project_location_id')->index()->default('0');
            $table->integer('basic_salary')->index()->default('0');
            $table->string('cola_allownces')->index()->default('');
            $table->string('food_allownce')->index()->default('');
            $table->string('transportation_allownce')->index()->default('');
            $table->string('accomodation_allownce')->index()->default('');
            $table->string('medical_allownce')->index()->default('');
            $table->string('overtime_allownce')->index()->default('');
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
        Schema::dropIfExists('jobs');
    }
}
