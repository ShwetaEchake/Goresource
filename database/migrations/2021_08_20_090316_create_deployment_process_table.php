<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeploymentProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployment_process', function (Blueprint $table) {
            $table->increments('deployment_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('company_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('created_by')->index()->default('0');
            $table->text('remark');
            $table->integer('flight_date')->default('0');
            $table->integer('flight_no')->default('0');
            $table->string('destination',255)->default('');
            $table->string('departure',255)->default('');
            $table->string('arrival',255)->default('');
            $table->string('duration',255)->default('');
            $table->string('pnr_no',255)->default('');
            $table->string('attached_document1',255)->default('');
            $table->string('attached_document2',255)->default('');
            $table->string('attached_document3',255)->default('');
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
        Schema::dropIfExists('deployment_process');
    }
}
