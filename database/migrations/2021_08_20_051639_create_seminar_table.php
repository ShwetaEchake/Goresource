<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar', function (Blueprint $table) {
            $table->increments('seminar_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->string('course_title',255)->default('');
            $table->string('training_center',255)->default('');
            $table->string('seminar_held',255)->default('');
            $table->integer('completion_date')->default('0');
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
        Schema::dropIfExists('seminar');
    }
}
