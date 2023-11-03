<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry', function (Blueprint $table) {
            $table->increments('enquiry_id')->index();
            $table->integer('client_id')->index()->default('0');
            $table->string('enquiry_title',50)->default('');
            $table->string('contract_period',50)->default('');
            $table->string('place_of_work',50)->default('');
            $table->string('trial_period',50)->default('');
            $table->string('air_fare',50)->default('');
            $table->string('employment_visa',50)->default('');
            $table->string('food_status',50)->default('');
            $table->tinyinteger('transportation_status')->default('0');
            $table->tinyinteger('accomodation_status')->default('0');
            $table->tinyinteger('medical_staus')->default('0');
            $table->string('duty_hours',20)->default('');
            $table->string('overtime_hours',255)->default('');
            $table->tinyinteger('uniform_status')->default('0');
            $table->string('other_benefits',255)->default('');
            $table->string('other_condition',255)->default('');
            $table->string('attached_document1')->default('');
            $table->string('attached_document2')->default('');
            $table->string('attached_document3')->default('');
            $table->string('attached_document4')->default('');
            $table->string('attached_document5')->default('');
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
        Schema::dropIfExists('enquiry');
    }
}
