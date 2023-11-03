<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferQvcProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_qvc_process', function (Blueprint $table) {
            $table->increments('qvc_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('company_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('created_by')->index()->default('0');
            $table->text('remark');
            $table->integer('client_applied_date')->default('0');
            $table->integer('appointment_date')->default('0');
            $table->integer('medical_fit_date')->default('0');
            $table->integer('medical_unfit_date')->default('0');
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
        Schema::dropIfExists('offer_qvc_process');
    }
}
