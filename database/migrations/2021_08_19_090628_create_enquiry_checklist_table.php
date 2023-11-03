<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_checklist', function (Blueprint $table) {
            $table->increments('checklist_id')->index();
            $table->string('enquiry',255)->default('');
            $table->tinyinteger('status')->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('created_date')->default('0');
            $table->integer('updated_date')->default('0');
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
        Schema::dropIfExists('enquiry_checklist');
    }
}
