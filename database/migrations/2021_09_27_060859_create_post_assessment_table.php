<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_assessment', function (Blueprint $table) {
            $table->increments('post_assessment_id')->index();
            $table->string('assessment_type')->default('');
            $table->integer('candidate_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('job_id')->index()->default('0');
            $table->integer('assessment_by')->default('0');
            $table->integer('branch_id')->index()->default('0');
            $table->string('personality_appearence',255)->default('0');;
            $table->text('personality_remark');
            $table->string('knowledge',255)->default('');
            $table->text('nowledge_remark');
            $table->string('ledership',255)->default('');
            $table->text('leadership_remark');
            $table->string('communication',255)->default('');
            $table->text('communication_remark');
            $table->string('other_assessment',255)->default('');
            $table->text('other_assessment_remark');
            $table->string('degree_optain',255)->default('');
            $table->string('professional_licence_no',255)->default('');
            $table->string('technical_qualification',255)->default('');
            $table->string('key_skill',255)->default('');
            $table->string('trade_test',255)->default('');
            $table->string('languge_used',255)->default('');
            $table->string('local_work_experience',255)->default('');
            $table->string('local_experience_year');
            $table->string('overseas_expereicne',255);
            $table->string('overseaase_year',255)->default('');
            $table->string('overall_assessment',255)->default('');
            $table->string('overall_rating',255)->default('');
            $table->text('remark');
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
        Schema::dropIfExists('post_assessment');
    }
}
