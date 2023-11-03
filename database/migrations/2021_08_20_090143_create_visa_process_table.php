<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_process', function (Blueprint $table) {
            $table->increments('visa_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('company_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('created_by')->index()->default('0');
            $table->text('remark');
            $table->string('vissa_profession')->default('');
            $table->integer('ev_no')->default('0');
            $table->integer('issue_date')->default('0');
            $table->integer('expiry_date')->default('0');
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
        Schema::dropIfExists('visa_process');
    }
}
