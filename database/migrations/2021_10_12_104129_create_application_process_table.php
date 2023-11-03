<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_process', function (Blueprint $table) {
            $table->increments('candidate_status_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('client_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('created_date')->default('0');
            $table->string('application_activity',255)->default('');
            $table->string('application_status',255)->default('');
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
        Schema::dropIfExists('application_process');
    }
}
