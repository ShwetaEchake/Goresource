<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_documents', function (Blueprint $table) {
            $table->id('document_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('company_id')->index()->default('0');
            $table->string('document_title',50)->default('');
            $table->string('document_path',255)->default('');
            $table->string('date_submited',255)->default('');
            $table->integer('date_updated')->default('0');
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
        Schema::dropIfExists('candidate_documents');
    }
}
