<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_location', function (Blueprint $table) {
            $table->increments('enquiy_project_location_id')->index();
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('location_id')->index()->default('0');;
            $table->integer('required_position')->index()->default('0');;
            $table->integer('job_id')->index();

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
        Schema::dropIfExists('project_location');
    }
}
