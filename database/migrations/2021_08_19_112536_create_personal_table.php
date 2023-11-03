<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('candidate_id')->index();
            $table->integer('user_id')->index()->default('0');
            $table->string('name',50)->default('');
            $table->string('middle_name',50)->default('');
            $table->string('last_name',50)->default('');
            $table->string('father_name',50)->default('');
            $table->string('mother_name',50)->default('');
            $table->string('citizenship',50)->default('');
            $table->string('date_of_birth',50)->default('');
            $table->string('place_of_birth',50)->default('');
            $table->string('gender',255)->default('');
            $table->string('merital_status',50)->default('');
            $table->string('age',20)->default('');
            $table->string('height',20)->default('');
            $table->string('weight',20)->default('');
            $table->string('religion',20)->default('');
            $table->string('language',20)->default('');
            $table->string('other_skill',20)->default('');
            $table->string('computer_skill',20)->default('');
            $table->string('hobbies_sport',20)->default('');
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
        Schema::dropIfExists('personal');
    }
}
