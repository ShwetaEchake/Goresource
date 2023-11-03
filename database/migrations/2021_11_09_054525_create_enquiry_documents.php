<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_documents', function (Blueprint $table) {
            $table->increments('enquiry_document_id')->index();
            $table->integer('enquiry_id')->index();
            $table->string('folder_path',255)->default('');
            $table->string('enquiry_document_title')->default('');
            $table->string('enquiry_document_path')->default('');
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
        Schema::dropIfExists('enquiry_documents');
    }
}
