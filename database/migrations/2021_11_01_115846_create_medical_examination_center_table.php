<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalExaminationCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_examination_center', function (Blueprint $table) {
            $table->increments('medical_examination_center_id')->index();
            $table->integer('medical_examination_center_code')->default('0');
            $table->string('medical_examination_center_name')->default('');
            $table->string('medical_examination_center_city')->default('');
            $table->string('medical_examination_center_state')->default('');
            $table->string('medical_examination_center_country')->default('');
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
        Schema::dropIfExists('medical_examination_center');
    }
}
